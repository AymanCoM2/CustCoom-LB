<?php

use App\Http\Controllers\DocumentsController;
use App\Models\EditorOnceTimeDocs;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportingController;
use App\Http\Controllers\LocalStorageController;
use App\Models\DissapprovedFile;
use App\Models\Documents;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

/**
 * This is the Uitlity File For Utility Links 
 * Like importing Excel Sheets and Files and Stuff like that 
 */

//----------------------------------- // * OK << EXCEL 
Route::get('/import-customers', [ImportingController::class, 'importCustomersExcel'])->name('get-import-customers');
Route::post('/import-customers', [ImportingController::class, 'storeExcelImport'])->name('post-import-customers');

// ----------------------------------- // * Ok  << PDF 
Route::get('/user-drive/{cardCode}', [DocumentsController::class, 'localGoogleDrive'])->name('customer-drive');
Route::get('/user-drive-standalone/{cardCode}', [DocumentsController::class, 'standAloneLocalGoogleDrive'])->name('customer-drive-standalone');
Route::post('/delete-document', [DocumentsController::class, 'deleteCustomerDocument'])->name('delete-docu');
Route::post('/restore-document', [DocumentsController::class, 'restoreDocument'])->name('restore-docu');
Route::post('/delete-before-approval', [DocumentsController::class, 'deleteBeforeApprove'])->name('delete-before-approval');
Route::post('/dash/handle-upload', [LocalStorageController::class, 'handleUploadForm'])->name('handle-upload-form');
Route::get('dash/get-archive-files/{cardCode}', [LocalStorageController::class, 'getArchivedFiles'])->name('show-archive');


Route::get('/approve-pdf-file/{pdf}', function (Request $request) {
    $documentId  = $request->pdf;
    $approvedDoc = Documents::where('id', $documentId)->first();
    $approvedDoc->isApproved = true;
    $approvedDoc->save();
    Toastr::success('File is Approved');
    return back();
})->name('approve-pdf');

Route::get('/disapprove-pdf-file/{pdf}', function (Request $request) {
    $documentId  = $request->pdf;
    $disApprovedDoc = Documents::where('id', $documentId)->first();
    $disapprovedFile  = new DissapprovedFile();
    $disapprovedFile->uploader_id = $disApprovedDoc->uploaded_id;
    $disapprovedFile->filePathName = $disApprovedDoc->path;
    $disapprovedFile->save();
    $disApprovedDoc->forceDelete();

    $notifyDoc  = new EditorOnceTimeDocs() ; 
    $notifyDoc->editor_id = $disapprovedFile->uploader_id ; 
    $notifyDoc->file_name = $disapprovedFile->filePathName; 
    $notifyDoc->save() ; /// Here you Saved it For an Editor to notify Him 
    // THEN delete Data about it  ; 


    Toastr::info('File is Dis-Approved');
    return back();
})->name('disapprove-pdf');
