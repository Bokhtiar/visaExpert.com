<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Customer;
use App\Models\DailyOfficeExpense;
use App\Models\Invoice;
use App\Models\Service;
use App\Models\VisaForm;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $this->authorize('access', DashboardController::class);

        //$data['total_earnings'] = Invoice::where('status', PaymentStatus::PAID->toString())->sum('total_amount');
        $data['total_earnings'] = Invoice::sum('total_amount');
        $data['total_forms'] = VisaForm::all()->count();
        $data['total_customers'] = Customer::query()->count();
        $data['total_services'] = Service::all()->count();
        $data['total_spending'] = DailyOfficeExpense::sum('amount');

        $data['monthly_client'] = Customer::whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->count();
        $data['monthly_bills'] = DailyOfficeExpense::whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('amount');
        $data['current_month_collected_bill'] = PaymentLog::whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('pay');
        $data['current_month_due_bill'] = PaymentLog::whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('pay'); 
        $data['monthly_discount'] = Invoice::whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('discount');

        // attendance
        $date = now()->format('Y-m-d');
        $data['attendance'] = Attendance::where('user_id', Auth::id())->where('date', $date)->first();




        // bar chart
        $monthlyCustomers = Customer::select(
            DB::raw('MONTH(created_at) as month'), 
            DB::raw('COUNT(id) as count')
        )
        ->whereYear('created_at', Carbon::now()->year)
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month');

    // Fill in any missing months with zero counts
    $bar_monthly_customer_data = [];
    for ($month = 1; $month <= 12; $month++) {
        $data['labels'][] = Carbon::create()->month($month)->format('F'); // Month name (January, February, etc.)
        $data['data'][] = $monthlyCustomers->get($month, 0); // Get the count for the month, or 0 if no data
    }
 
        return view('backend.dashboard', $data );
    }
}
