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

        // attendance
        $date = now()->format('Y-m-d');
        $data['attendance'] = Attendance::where('user_id', Auth::id())->where('date', $date)->first();

        return view('backend.dashboard', $data );
    }
}
