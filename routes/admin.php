<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CustomerInvoiceController;
use App\Http\Controllers\Admin\DailyOfficeExpenseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\Admin\LinkController;
use App\Http\Controllers\Admin\NotepedController;
use App\Http\Controllers\Admin\PermissionUserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReciveController;
use App\Http\Controllers\Admin\RoadController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\StaffDutySalaryController;
use App\Http\Controllers\Admin\TourPackageController;
use App\Http\Controllers\Admin\TransferController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VisaTypeController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;

// Dashboard Routes
Route::get('dashboard', DashboardController::class)->name('dashboard');

// Customer Routes
Route::group(['as' => 'customers.', 'prefix' => 'customers', 'controller' => CustomerController::class], function () {
    Route::get('/', 'index')->name('index');
    
    /** offline customer create*/
    Route::get('offline', 'offline_customer_create')->name('offline');
    /** add-more customer */
    Route::get('add-more/{id}', 'add_more')->name('add-more');
    /** customer crud */ 
    Route::get('/{customer}', 'show')->name('show');
    Route::put('/{customer}', 'update')->name('update');
    Route::delete('/{customer}', 'destroy')->name('destroy');
    Route::patch('/{customer}/update-visa-status', 'updateVisaStatus')->name('updateVisaStatus');
    Route::patch('/{customer}/forms/{form}/documents/{document}/update-status', 'updateDocumentStatus')->name('updateDocumentStatus');
    Route::get('/print/pdf/{docs}', 'print')->name('print.pdf');

    // documents - upload
    Route::get('/documents-upload/{id}', 'documentuploadadmin')->name('documents-upload');
    Route::post('/single/document/store', 'singleDocumentStore')->name('single.document.store');
    Route::put('/single/document/update/{id}', 'singleDocumentUpdate')->name('single.document.update');
    
    // customer
    Route::get('/search-active/{id}', 'search_active')->name('search-active');


});

// Customers Invoice Routes
Route::group(['as' => 'customers-invoices.', 'prefix' => 'customers/invoice/', 'controller' => CustomerInvoiceController::class], function () {
    Route::get('/create/{customer}', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{invoice}', 'show')->name('show');
    Route::get('/edit/{invoice}', 'edit')->name('edit');
    Route::patch('/update/{invoice}', 'update')->name('update');
    Route::delete('/delete/{invoice}', 'destroy')->name('destroy');
    Route::get('/download/{invoice}', 'download')->name('download');

});
// Visa Types
Route::resource('visa-types', VisaTypeController::class)->except('show');
//Road
Route::resource('road', RoadController::class)->except('show');
//transfer
Route::resource('transfer', TransferController::class);
//reciver
Route::get('recive/index', [ReciveController::class, 'index'])->name('recive.index');
Route::get('recive/approved/{id}', [ReciveController::class, 'approved'])->name('recive.approved');
Route::get('recive/rejected/{id}', [ReciveController::class, 'rejected'])->name('recive.rejected');
//statement
Route::get('statement/index', [ReciveController::class, 'statement'])->name('statement.index');
// notepad
Route::resource('notepad', NotepedController::class);

Route::resource('link', LinkController::class)->except('show');

// Services Route
Route::resource('services', ServiceController::class)->except('show');

// Tour Package Route
Route::resource('tour-packages', TourPackageController::class)->except(['create', 'show']);

// User Management
Route::resource('roles', RoleController::class)->except(['show']);
Route::resource('users', UserController::class);
Route::resource('permission-user', PermissionUserController::class);

// Daily Office Expense
Route::resource('daily-office-expenses', DailyOfficeExpenseController::class)->except(['create', 'show']);

// Staff Duty & Salary Routes
Route::get('staff-duty-salaries', [StaffDutySalaryController::class, 'index'])->name('staff-duty-salaries.index');
Route::post('staff-duty-salaries/store', [StaffDutySalaryController::class, 'store'])->name('staff-duty-salaries.store');
Route::get('staff-duty-salaries/edit/{staff_duty_salary}', [StaffDutySalaryController::class, 'edit'])->name('staff-duty-salaries.edit');
Route::put('staff-duty-salaries/update/{staff_duty_salary}', [StaffDutySalaryController::class, 'update'])->name('staff-duty-salaries.update');

// Activity Logs Routes
Route::get('activity-logs', ActivityLogController::class)->name('activity-logs');

// Profile
Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
Route::put('password', [ProfileController::class, 'updatePassword'])->name('password.update');




/** attendance */
Route::get('attendance', [AttendanceController::class, 'index']);
Route::get('attendance/punch-in', [AttendanceController::class, 'punchIn']);
Route::get('attendance/punch-out', [AttendanceController::class, 'punchOut']);
Route::post('attendance/find-cancel/{id}', [AttendanceController::class, 'fineCancel']);
Route::post('attendance/filter', [AttendanceController::class, 'filter']);
Route::post('attendance/fine-cancel-filter/{id}/{month}/{user}/{year}', [AttendanceController::class, 'fineCancelFilter']);

/** holiday */
Route::resource('holiday', HolidayController::class);
Route::post('holiday/filter', [HolidayController::class, 'holiday_filter'])->name('holiday.filter');

/** leave */
Route::resource('leave', LeaveController::class);
Route::post('leave/filter', [HolidayController::class, 'leave_filter'])->name('leave.filter');