<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CustomerInvoiceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Models\DailyOfficeExpense;
use App\Models\Role;
use App\Models\Service;
use App\Models\StaffDutySalary;
use App\Models\TourPackage;
use App\Models\User;
use App\Models\VisaType;
use App\Policies\ActivityLogPolicy;
use App\Policies\CustomerInvoicePolicy;
use App\Policies\CustomerPolicy;
use App\Policies\DailyOfficeExpensePolicy;
use App\Policies\DashboardPolicy;
use App\Policies\ProfilePolicy;
use App\Policies\RolePolicy;
use App\Policies\ServicePolicy;
use App\Policies\StaffDutySalaryPolicy;
use App\Policies\TourPackagePolicy;
use App\Policies\UserPolicy;
use App\Policies\VisaTypePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        DashboardController::class => DashboardPolicy::class,
        CustomerController::class => CustomerPolicy::class,
        CustomerInvoiceController::class => CustomerInvoicePolicy::class,
        VisaType::class => VisaTypePolicy::class,
        Service::class => ServicePolicy::class,
        TourPackage::class => TourPackagePolicy::class,
        Role::class => RolePolicy::class,
        User::class => UserPolicy::class,
        DailyOfficeExpense::class => DailyOfficeExpensePolicy::class,
        StaffDutySalary::class => StaffDutySalaryPolicy::class,
        ActivityLogController::class => ActivityLogPolicy::class,
        ProfileController::class => ProfilePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
