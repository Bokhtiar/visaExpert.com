<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\PaymentLog;
use App\Models\Road;
use App\Models\Service;
use Barryvdh\DomPDF\Facade\PDF as Pdf;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CustomerInvoiceController extends Controller
{
    public function create(Customer $customer): View
    {
        $customerList = Customer::where('parent_customer_id', $customer->id)->get();   
        $this->authorize('create-invoice', CustomerInvoiceController::class);
        $paymentStatus = PaymentStatus::collection();

        $services = Service::all();
        $roads = Road::all();
        $payables  = PaymentLog::where('customer_id',$customer->id)->get();

        return view('backend.customer.invoice.form', compact('paymentStatus', 'customerList', 'customer', 'services', 'roads', 'payables'));
    }

    public function store(Request $request): RedirectResponse
    {
  
        try {
            $this->authorize('create-invoice', CustomerInvoiceController::class);
            $validatedData = $request->validate([
                'form_id' => 'required|exists:visa_forms,id',
                'customer_id' => 'required|exists:customers,id',
                'invoice_number' => 'nullable|string',
                'status' => 'required|string',
                'items.*' => 'required|string',
                'qty.*' => 'required|string',
                'amount.*' => 'required|numeric',
                'total_amount' => 'nullable|numeric',
                'road_id' => 'nullable|numeric',
                'discount' => 'nullable : numeric'
            ]);

            $invoice = Invoice::create($validatedData);
            //dd($validatedData['qty'][0]);
            foreach ($validatedData['items'] as $key => $itemName) {
                // dd($validatedData['qty'][$key]);
                $item = new InvoiceItem();
                $item->invoice_id = $invoice->id;
                $item->item = $itemName;
                $item->qty =$validatedData['qty'][$key];
                $item->amount = $validatedData['amount'][$key];
                $item->save();
            }

            $invoice->update(['total_amount' => $invoice->items()->sum('amount')]);

            /** payment log */
            PaymentLog::create([
                'invoice_id' => $invoice->id,   
                'customer_id' => $request->customer_id,
                'pay' => $request->pay,
                'due' => $request->due
            ]);

            logActivity(
                (Auth::user()->name . ' created an invoice.'),
                $invoice->id,
                'created',
                'invoices'
            );

            return redirect()->route('admin.customers.index')->with('success', 'Invoice created successfully.');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
       
    }

    public function show(Invoice $invoice)
    {
        $this->authorize('create-invoice', CustomerInvoiceController::class);
        $invoice->load('customer');
        $roads = Road::all();
        $payables  = PaymentLog::where('customer_id', $invoice->customer_id)->get();

        return view('backend.customer.invoice.details', compact('invoice', 'roads', 'payables'));
    }

    public function edit(Invoice $invoice): View
    {
       // dd($invoice);
        $customerList = Customer::where('parent_customer_id', $invoice->customer_id)->get();  
        $this->authorize('edit-invoice', CustomerInvoiceController::class);
        $paymentStatus = PaymentStatus::collection();

        $roads = Road::all();
        $payables  = PaymentLog::where('customer_id', $invoice->customer_id)->where('invoice_id', $invoice->id)->get();

        return view('backend.customer.invoice.form', compact('invoice', 'customerList', 'paymentStatus','roads', 'payables'));
    }

    public function update(Request $request, Invoice $invoice): RedirectResponse
    {
    
        $this->authorize('edit-invoice', CustomerInvoiceController::class);
        $validatedData = $request->validate([
            'status' => 'required|string',
            'road_id' => 'nullable|numeric',
            'discount' => 'nullable : numeric'
        ]);

        $invoice->update($validatedData);

        /** payment log */
        PaymentLog::create([
            'invoice_id' => $invoice->id,
            'customer_id' => $request->customer_id,
            'pay' => $request->pay,
            'due' => $request->due
        ]);

        logActivity(
            (Auth::user()->name.' updated an invoice.'),
            $invoice->id,
            'updated',
            'invoices'
        );

        return redirect()->route('admin.customers.index')->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice): RedirectResponse
    {
        try {
            $this->authorize('delete-invoice', CustomerInvoiceController::class);
            $invoice->delete();

            logActivity(
                (Auth::user()->name.' deleted an invoice.'),
                $invoice->id,
                'deleted',
                'invoices'
            );

            return back()->with('success', 'Invoice deleted successfully.');

        } catch (Exception $exception) {

            return back()->with('error', $exception->getMessage());
        }
    }

    public function download(Invoice $invoice): Response
    {
        $this->authorize('download-invoice', CustomerInvoiceController::class);
        $pdf = Pdf::loadView('backend.customer.invoice.pdf', compact('invoice'))
            ->setOption([
                'defaultFont' => 'sans-serif',
                'defaultMediaType' => 'print',
            ]);

        logActivity(
            (Auth::user()->name.' downloaded an invoice.'),
            $invoice->id,
            'downloaded',
            'invoices'
        );

        return $pdf->download('invoice.pdf');
    }
}
