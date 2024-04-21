<?php

namespace App;

class Permissions
{
    const ACCESS_ADMIN_DASHBOARD = 'admin.dashboard';

    /* Customers */
    const VIEW_CUSTOMER = 'admin.customers.index';

    const CREATE_CUSTOMER = 'admin.customers.create';

    const EDIT_CUSTOMER = 'admin.customers.edit';

    const DELETE_CUSTOMER = 'admin.customers.destroy';

    /* Customer Invoices */
    const CREATE_CUSTOMER_INVOICE = 'admin.customers-invoices.create';

    const EDIT_CUSTOMER_INVOICE = 'admin.customers-invoices.edit';

    const DELETE_CUSTOMER_INVOICE = 'admin.customers-invoices.destroy';

    const DOWNLOAD_CUSTOMER_INVOICE = 'admin.customers-invoices.download';

    /* Visa Types */
    const VIEW_VISA_TYPE = 'admin.visa-types.index';

    const CREATE_VISA_TYPE = 'admin.visa-types.create';

    const EDIT_VISA_TYPE = 'admin.visa-types.edit';

    const DELETE_VISA_TYPE = 'admin.visa-types.destroy';

    /* Services */
    const VIEW_SERVICE = 'admin.services.index';

    const CREATE_SERVICE = 'admin.services.create';

    const EDIT_SERVICE = 'admin.services.edit';

    const DELETE_SERVICE = 'admin.services.destroy';

    /* Tour Packages */
    const VIEW_TOUR_PACKAGE = 'admin.tour-packages.index';

    const CREATE_TOUR_PACKAGE = 'admin.tour-packages.create';

    const EDIT_TOUR_PACKAGE = 'admin.tour-packages.update';

    const DELETE_TOUR_PACKAGE = 'admin.tour-packages.destroy';

    /* Roles */
    const VIEW_ROLE = 'admin.roles.index';

    const CREATE_ROLE = 'admin.roles.create';

    const EDIT_ROLE = 'admin.roles.edit';

    const DELETE_ROLE = 'admin.roles.destroy';

    /* Users */
    const VIEW_USER = 'admin.users.index';

    const CREATE_USER = 'admin.users.create';

    const EDIT_USER = 'admin.users.edit';

    const DELETE_USER = 'admin.users.destroy';

    /* Daily Office Expenses */
    const VIEW_DAILY_OFFICE_EXPENSE = 'admin.daily-office-expenses.index';

    const CREATE_DAILY_OFFICE_EXPENSE = 'admin.daily-office-expenses.create';

    const EDIT_DAILY_OFFICE_EXPENSE = 'admin.daily-office-expenses.edit';

    const DELETE_DAILY_OFFICE_EXPENSE = 'admin.daily-office-expenses.destroy';

    /* Staff Duty & Salary */
    const VIEW_STAFF_DUTY_SALARY = 'admin.staff-duty-salaries.index';

    const CREATE_STAFF_DUTY_SALARY = 'admin.staff-duty-salaries.create';

    const EDIT_STAFF_DUTY_SALARY = 'admin.staff-duty-salaries.edit';

    /* Activity Logs */
    const ACCESS_ACTIVITY_LOGS = 'admin.activity-logs';

    /* Update Profile */
    const UPDATE_PROFILE = 'admin.profile.update';

    const UPDATE_PASSWORD = 'admin.profile.password';
}
