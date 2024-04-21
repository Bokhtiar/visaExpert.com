<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
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
        $this->authorize('create-invoice', CustomerInvoiceController::class);
        $paymentStatus = PaymentStatus::collection();

        $services = Service::all();

        return view('backend.customer.invoice.form', compact('paymentStatus', 'customer', 'services'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create-invoice', CustomerInvoiceController::class);
        $validatedData = $request->validate([
            'form_id' => 'required|exists:visa_forms,id',
            'customer_id' => 'required|exists:customers,id',
            'invoice_number' => 'nullable|string',
            'status' => 'required|string',
            'items.*' => 'required|string',
            'amount.*' => 'required|numeric',
            'total_amount' => 'nullable|numeric',
        ]);

        $invoice = Invoice::create($validatedData);

        foreach ($validatedData['items'] as $key => $itemName) {
            $item = new InvoiceItem();
            $item->invoice_id = $invoice->id;
            $item->item = $itemName;
            $item->amount = $validatedData['amount'][$key];
            $item->save();
        }

        $invoice->update(['total_amount' => $invoice->items()->sum('amount')]);

        logActivity(
            (Auth::user()->name.' created an invoice.'),
            $invoice->id,
            'created',
            'invoices'
        );

        return redirect()->route('admin.customers.index')->with('success', 'Invoice created successfully.');
    }

    public function show(Invoice $invoice): View
    {
        $this->authorize('create-invoice', CustomerInvoiceController::class);
        $invoice->load('customer');

        return view('backend.customer.invoice.details', compact('invoice'));
    }

    public function edit(Invoice $invoice): View
    {
        $this->authorize('edit-invoice', CustomerInvoiceController::class);
        $paymentStatus = PaymentStatus::collection();

        return view('backend.customer.invoice.form', compact('invoice', 'paymentStatus'));
    }

    public function update(Request $request, Invoice $invoice): RedirectResponse
    {
        $this->authorize('edit-invoice', CustomerInvoiceController::class);
        $validatedData = $request->validate([
            'status' => 'required|string',
        ]);

        $invoice->update($validatedData);

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
