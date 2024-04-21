<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::controller(FrontendController::class)->group(function () {

    // Visa Application Forms
    Route::get('/', 'index')->name('home');
    Route::get('search-result', 'searchCustomerForm')->middleware('validateSearchParameter')->name('search-form');
    // Visa Type Required Documents
    Route::get('get-required-documents/{visaType}', [FrontendController::class, 'getRequiredDocuments']);
});

// Customer Routes
Route::controller(CustomerController::class)->group(function () {
    Route::post('application-forms/store', 'storeForm')->name('application.forms.store');
    
    Route::post('application-forms/store-offline', 'storeForm')->name('application.forms.store-offline');
    
    Route::post('resubmit/form', 'resubmitForm')->name('resubmit.form');
    Route::get('my-invoice/{encodedInvoice}', 'invoiceDetails')->name('my-invoice.view');
});

Route::get('fd/migrate', function () {
    Artisan::call('migrate --force');
    dd(Artisan::output());
});
require __DIR__ . '/auth.php';
