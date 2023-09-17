<?php

use App\Models\ColumnOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// This is a Route to Get all DDL options (Radio Buttons )
// and Return Them Using Ajax 
Route::get('/aja-get-col-options/{colN}', function (Request $request) {
    $cN = $request->colN;
    $relatedOptions  = ColumnOption::where('colName', $cN)->get();
    $realOptions   = [];
    foreach ($relatedOptions->toArray() as $index => $value) {
        array_push($realOptions, $value['colOption']);
    }
    return response()->json([
        'data' => $realOptions
    ]);
});
