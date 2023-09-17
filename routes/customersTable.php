<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;

//----------------------------------- // * ok 
// ! NOTE : The Below Three Routes Controlled By same Controller Function 
Route::get('/home', [CustomersController::class, 'customersTableGet'])->name('home'); 
Route::get('/', [CustomersController::class, 'customersTableGet'])->name('dash-home');
Route::get('/dash/all-customers', [CustomersController::class, 'customersTableGet'])->name('get-all-customers'); 
Route::post('/dash/all-customers', [CustomersController::class, 'customersTablePost'])->name('post-all-customers'); // ^ Ajax Call 
//-----------------------------------// * Ok 