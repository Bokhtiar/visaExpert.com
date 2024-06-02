<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\DailyOfficeExpense;
use App\Models\Invoice;
use App\Models\Service;
use App\Models\VisaForm;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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

        return view('backend.dashboard', $data);
    }
}
