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


Route::get('/edit-notifications', function () {
    return view('editornotify.fields');
})->name('notify-edit');

Route::get('/file-notifications', function () {
    return view('editornotify.files');
})->name('notify-file');



Route::post('/mark-as-read', function (Request $request) {
    // Type Of It [ File Or Field ]
    // Id Of It 
    # And Delete it From the Table Of the DB  ; 
});
