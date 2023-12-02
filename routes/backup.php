<?php

use App\Http\Controllers\BackUpController;
use App\Models\CardCode;
use App\Models\ComLog;
use App\Models\Customers;
use App\Models\Documents;
use App\Models\EditGrave;
use App\Models\EditHistory;
use App\Models\TempDisapprove;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


Route::get('/backup-excel', [BackUpController::class, 'getBackupView'])->name('backup-excel');
Route::post('/backup-excel', [BackUpController::class, 'exportAllDataHandler'])->name('backup-post');
