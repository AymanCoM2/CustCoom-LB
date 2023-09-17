<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;

/**
 * Customer Data Routes , Whether Getting them locally Or From Drive
 */

// ------------ // ^ Ok >> Showing the Iframe Pages "Local && Drive"
Route::get('/dash/customer-data/drive/{cardCode}', [CustomersController::class, 'showCustomerDataFrameDrive'])->name('get-customer-data-drive');
Route::get('/dash/customer-data/local/{cardCode}', [CustomersController::class, 'showCustomerDataFrameLocal'])->name('get-customer-data-local');

//TODO form handler  >> Whether SuperUser Or Ordinary One 
Route::get('/dash/customer-data-form/{cardCode}', [CustomersController::class, 'showCustomerDataForm'])->name('get-customer-form');
Route::get('/dash/customer-data-form-g/{cardCode}', [CustomersController::class, 'showCustomerDataFormG'])->name('get-customer-form-g');
Route::get('/dash/customer-data-form-g-what-if/{cardCode}', [CustomersController::class, 'showCustomerDataFormGWhatIf'])->name('get-customer-form-g-what-if');

// ------------- // * Updating Data and Whether immediately approved or Not 
Route::post('/dash/update-customer-data',  [CustomersController::class, 'handleCustomersForm'])->name('handle-update-form');
