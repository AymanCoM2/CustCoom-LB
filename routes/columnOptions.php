<?php

use App\Http\Controllers\ColumnController;
use Illuminate\Support\Facades\Route;
use App\Models\ColumnOption;
use Illuminate\Http\Request;

// Those Routes are For Changing Column Types , and 
// Changing their Related Radio Buttons [ AKA : Types , Options ]
// ======================================= // * Ok "to Change the Type For Data"
Route::get('/get-col-types', [ColumnController::class, 'columnTypesGet'])->name('col-types-get');
Route::post('/post-col-types', [ColumnController::class, 'columnTypesPost'])->name('col-types-post');

// ======================================= // * Ok "to add the options For Check"
Route::get('/get-add-ddl', [ColumnController::class, 'columnDDLGet'])->name('col-ddl-get');
Route::post('/post-add-ddl', [ColumnController::class, 'columnDDLPost'])->name('col-ddl-post');


// ==============================
Route::post('/delete-ddl-option', function (Request $request) {
    $toBeDeletedDDL = ColumnOption::query();

    if (is_null($request->ssl)) {
        $toBeDeletedDDL->whereNull('colName');
    } else {
        $toBeDeletedDDL->where('colName', $request->ssl);
    }

    if (is_null($request->ddl)) {
        $toBeDeletedDDL->whereNull('colOption');
    } else {
        $toBeDeletedDDL->where('colOption', $request->ddl);
    }

    $toBeDeletedDD = $toBeDeletedDDL->first();

    if ($toBeDeletedDD) {
        $toBeDeletedDD->delete();
    }

    return response()->json(['message' => 'Option deleted successfully']);
})->name('delete-the-option');
