<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Customer;
use App\Models\DailyOfficeExpense;
use App\Models\Invoice;
use App\Models\PaymentLog;
use App\Models\Service;
use App\Models\VisaForm;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $this->authorize('access', DashboardController::class);

        // Other data retrieval logic
        $dashboardData = [];
        $dashboardData['total_earnings'] = Invoice::sum('total_amount');
        $dashboardData['total_forms'] = VisaForm::count();
        $dashboardData['total_customers'] = Customer::count();
        $dashboardData['total_services'] = Service::count();
        $dashboardData['total_spending'] = DailyOfficeExpense::sum('amount');
        $dashboardData['monthly_client'] = Customer::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        $dashboardData['monthly_bills'] = DailyOfficeExpense::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');
        $dashboardData['current_month_collected_bill'] = PaymentLog::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('pay');
        $dashboardData['current_month_due_bill'] = PaymentLog::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('due'); // 'due' instead of 'pay'
        $dashboardData['monthly_discount'] = Invoice::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('discount');

        // Attendance
        $date = now()->format('Y-m-d');
        $dashboardData['attendance'] = Attendance::where('user_id', Auth::id())->where('date', $date)->first();

        // Bar chart data
        $monthlyCustomers = Customer::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(id) as count')
        )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $barChartData = [
            'labels' => [],
            'data' => []
        ];
        for ($month = 1; $month <= 12; $month++) {
            $barChartData['labels'][] = Carbon::create()->month($month)->format('F');
            $barChartData['data'][] = $monthlyCustomers->get($month, 0);
        }
        /** var char code there monthly how much customer onboard  - previce month  = total number show on bar chart*/
        // Fetch monthly customer counts, using December as the base for January
        $monthlyCustomerCounts = Customer::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(id) as count')
        )
        ->whereYear('created_at', Carbon::now()->year)
        ->orWhere(function ($query) {
            // Include December of last year as the base month
            $query->whereMonth('created_at', 12)
            ->whereYear('created_at', Carbon::now()->subYear()->year);
        })
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $newCustomerChartData = [
            'monthLabels' => [],
            'newCustomerData' => []
        ];

        // Track the previous month’s customer count, starting with December’s
        $previousMonthCount = $monthlyCustomerCounts->get(12, 0); // December count of the previous year

        for ($month = 1; $month <= 12; $month++) {
            $newCustomerChartData['monthLabels'][] = Carbon::create()->month($month)->format('F');

            // Calculate new customers added compared to the previous month
            $currentMonthCount = $monthlyCustomerCounts->get($month, 0);
            $newCustomersThisMonth = $currentMonthCount - $previousMonthCount;
            $newCustomerChartData['newCustomerData'][] = $newCustomersThisMonth;

            // Update previous count for the next iteration
            $previousMonthCount = $currentMonthCount;
        }



        return view('backend.dashboard', compact('dashboardData', 'barChartData', 'newCustomerChartData'));
    } 

}
