<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::get('reports', [ReportController::class, 'index'])->name('reports-home');
Route::get('reports-2', [ReportController::class, 'sample2'])->name('reports-home-2');
