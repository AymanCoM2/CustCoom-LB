<?php

use App\Http\Controllers\WhatifController;
use Illuminate\Support\Facades\Route;


Route::get('what-if/{cardCode}', [WhatifController::class, 'whatIfApproved'])
    ->name('what-if');
