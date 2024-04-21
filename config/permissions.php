<?php

use App\Permissions;

return [

    /* Customers */
    'canViewCustomer' => Permissions::VIEW_CUSTOMER,
    'canCreateCustomer' => Permissions::CREATE_CUSTOMER,
    'canEditCustomer' => Permissions::EDIT_CUSTOMER,
    'canDeleteCustomer' => Permissions::DELETE_CUSTOMER,

    /* Customer Invoice */
    'canCreateCustomerInvoice' => Permissions::CREATE_CUSTOMER_INVOICE,
    'canEditCustomerInvoice' => Permissions::EDIT_CUSTOMER_INVOICE,
    'canDeleteCustomerInvoice' => Permissions::DELETE_CUSTOMER_INVOICE,
    'canDownloadCustomerInvoice' => Permissions::DOWNLOAD_CUSTOMER_INVOICE,

    /* Visa Types */
    'canViewVisaType' => Permissions::VIEW_VISA_TYPE,
    'canCreateVisaType' => Permissions::CREATE_VISA_TYPE,
    'canEditVisaType' => Permissions::EDIT_VISA_TYPE,
    'canDeleteVisaType' => Permissions::DELETE_VISA_TYPE,

    /* Service Configuration */
    'canViewService' => Permissions::VIEW_SERVICE,
    'canCreateService' => Permissions::CREATE_SERVICE,
    'canEditService' => Permissions::EDIT_SERVICE,
    'canDeleteService' => Permissions::DELETE_SERVICE,

    /* Tour Package Configuration */
    'canViewTourPackage' => Permissions::VIEW_TOUR_PACKAGE,
    'canCreateTourPackage' => Permissions::CREATE_TOUR_PACKAGE,
    'canEditTourPackage' => Permissions::EDIT_TOUR_PACKAGE,
    'canDeleteTourPackage' => Permissions::DELETE_TOUR_PACKAGE,

    /* Role Management */
    'canViewRole' => Permissions::VIEW_ROLE,
    'canCreateRole' => Permissions::CREATE_ROLE,
    'canEditRole' => Permissions::EDIT_ROLE,
    'canDeleteRole' => Permissions::DELETE_ROLE,

    /* User Management */
    'canViewUser' => Permissions::VIEW_USER,
    'canCreateUser' => Permissions::CREATE_USER,
    'canEditUser' => Permissions::EDIT_USER,
    'canDeleteUser' => Permissions::DELETE_USER,

    /* Daily Office Expenses */
    'canViewDailyOfficeExpense' => Permissions::VIEW_DAILY_OFFICE_EXPENSE,
    'canCreateDailyOfficeExpense' => Permissions::CREATE_DAILY_OFFICE_EXPENSE,
    'canEditDailyOfficeExpense' => Permissions::EDIT_DAILY_OFFICE_EXPENSE,
    'canDeleteDailyOfficeExpense' => Permissions::DELETE_DAILY_OFFICE_EXPENSE,

    /* Staff Duty & Salary */
    'canViewStaffDutySalary' => Permissions::VIEW_STAFF_DUTY_SALARY,
    'canCreateStaffDutySalary' => Permissions::CREATE_STAFF_DUTY_SALARY,
    'canEditStaffDutySalary' => Permissions::EDIT_STAFF_DUTY_SALARY,

    /* Activity Logs */
    'canAccessActivityLogs' => Permissions::ACCESS_ACTIVITY_LOGS,

    /* Profile */
    'canUpdateProfile' => Permissions::UPDATE_PROFILE,
    'canUpdatePassword' => Permissions::UPDATE_PASSWORD,
];
