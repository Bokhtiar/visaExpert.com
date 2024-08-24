<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dashboard
        $moduleAdminDashboard = Module::updateOrCreate(['name' => 'Admin Dashboard']);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminDashboard->id,
            'name' => 'Access Dashboard',
            'slug' => 'admin.dashboard',
        ]);

        // Customers
        $moduleCustomer = Module::updateOrCreate(['name' => 'Customers']);
        Permission::updateOrCreate([
            'module_id' => $moduleCustomer->id,
            'name' => 'Access List',
            'slug' => 'admin.customers.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleCustomer->id,
            'name' => 'Create Customer',
            'slug' => 'admin.customers.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleCustomer->id,
            'name' => 'Edit Customer',
            'slug' => 'admin.customers.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleCustomer->id,
            'name' => 'Delete Customer',
            'slug' => 'admin.customers.destroy',
        ]);

        // Customers Invoice
        $moduleCustomerInvoice = Module::updateOrCreate(['name' => 'Customer Invoice']);
        Permission::updateOrCreate([
            'module_id' => $moduleCustomerInvoice->id,
            'name' => 'Create Invoice',
            'slug' => 'admin.customers-invoices.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleCustomerInvoice->id,
            'name' => 'Update Invoice',
            'slug' => 'admin.customers-invoices.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleCustomerInvoice->id,
            'name' => 'Delete Invoice',
            'slug' => 'admin.customers-invoices.destroy',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleCustomerInvoice->id,
            'name' => 'Download Invoice',
            'slug' => 'admin.customers-invoices.download',
        ]);

        // Visa Types
        $moduleVisaTypes = Module::updateOrCreate(['name' => 'Visa Types']);
        Permission::updateOrCreate([
            'module_id' => $moduleVisaTypes->id,
            'name' => 'View List',
            'slug' => 'admin.visa-types.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleVisaTypes->id,
            'name' => 'Create Type',
            'slug' => 'admin.visa-types.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleVisaTypes->id,
            'name' => 'Update Type',
            'slug' => 'admin.visa-types.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleVisaTypes->id,
            'name' => 'Delete Type',
            'slug' => 'admin.visa-types.destroy',
        ]);

        // Service Configuration
        $moduleServiceConfiguration = Module::updateOrCreate(['name' => 'Service Configuration']);
        Permission::updateOrCreate([
            'module_id' => $moduleServiceConfiguration->id,
            'name' => 'View List',
            'slug' => 'admin.services.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleServiceConfiguration->id,
            'name' => 'Create Type',
            'slug' => 'admin.services.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleServiceConfiguration->id,
            'name' => 'Update Type',
            'slug' => 'admin.services.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleServiceConfiguration->id,
            'name' => 'Delete Type',
            'slug' => 'admin.services.destroy',
        ]);

        // Tour Package Configuration
        $moduleTourPackageConfiguration = Module::updateOrCreate(['name' => 'Tour Package Configuration']);
        Permission::updateOrCreate([
            'module_id' => $moduleTourPackageConfiguration->id,
            'name' => 'View List',
            'slug' => 'admin.tour-packages.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleTourPackageConfiguration->id,
            'name' => 'Create Package',
            'slug' => 'admin.tour-packages.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleTourPackageConfiguration->id,
            'name' => 'Update Package',
            'slug' => 'admin.tour-packages.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleTourPackageConfiguration->id,
            'name' => 'Delete Package',
            'slug' => 'admin.tour-packages.destroy',
        ]);

        // Role management
        $moduleAppRole = Module::updateOrCreate(['name' => 'Role Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Access Roles',
            'slug' => 'admin.roles.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Create Role',
            'slug' => 'admin.roles.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Edit Role',
            'slug' => 'admin.roles.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Delete Role',
            'slug' => 'admin.roles.destroy',
        ]);

        // User management
        $moduleAppUser = Module::updateOrCreate(['name' => 'User Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Access Users',
            'slug' => 'admin.users.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Create User',
            'slug' => 'admin.users.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Edit User',
            'slug' => 'admin.users.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Delete User',
            'slug' => 'admin.users.destroy',
        ]);

        // Daily Office Expenses
        $moduleDailyOfficeExpenses = Module::updateOrCreate(['name' => 'Daily Office Expenses']);
        Permission::updateOrCreate([
            'module_id' => $moduleDailyOfficeExpenses->id,
            'name' => 'Access List',
            'slug' => 'admin.daily-office-expenses.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleDailyOfficeExpenses->id,
            'name' => 'Create Expense',
            'slug' => 'admin.daily-office-expenses.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleDailyOfficeExpenses->id,
            'name' => 'Edit Expense',
            'slug' => 'admin.daily-office-expenses.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleDailyOfficeExpenses->id,
            'name' => 'Delete Expense',
            'slug' => 'admin.daily-office-expenses.destroy',
        ]);

        // Staff Duty & Salary
        $moduleStaffDutySalary = Module::updateOrCreate(['name' => 'Staff Duty & Salary']);
        Permission::updateOrCreate([
            'module_id' => $moduleStaffDutySalary->id,
            'name' => 'Access List',
            'slug' => 'admin.staff-duty-salaries.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleStaffDutySalary->id,
            'name' => 'Create Expense',
            'slug' => 'admin.staff-duty-salaries.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleStaffDutySalary->id,
            'name' => 'Edit Expense',
            'slug' => 'admin.staff-duty-salaries.edit',
        ]);

        // Activity Logs
        $moduleActivityLogs = Module::updateOrCreate(['name' => 'Activity Logs']);
        Permission::updateOrCreate([
            'module_id' => $moduleActivityLogs->id,
            'name' => 'Access Activity Logs',
            'slug' => 'admin.activity-logs',
        ]);

        // Profile
        $moduleAppProfile = Module::updateOrCreate(['name' => 'Profile']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProfile->id,
            'name' => 'Update Profile',
            'slug' => 'admin.profile.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProfile->id,
            'name' => 'Update Password',
            'slug' => 'admin.profile.password',
        ]);
    }
}
