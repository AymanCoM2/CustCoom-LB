<?php

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

Auth::routes();
Route::group(['middleware' => ['auth']], __DIR__ . '/utility.php'); // * Ok 
Route::group(['middleware' => ['auth']], __DIR__ . '/approve.php'); // * Ok 
// Approve will be for the SuperUser Only 
Route::group(['middleware' => ['auth']], __DIR__ . '/customersTable.php');
Route::group(['middleware' => ['auth']], __DIR__ . '/customerData.php');
Route::group(['middleware' => ['auth']], __DIR__ . '/columnOptions.php');
Route::group(['middleware' => ['auth']], __DIR__ . '/ajax-routes.php');
Route::group(['middleware' => ['auth']], __DIR__ . '/what-if-approve.php');
Route::group(['middleware' => ['auth']], __DIR__ . '/singleCustCode.php');
Route::group(['middleware' => ['auth']], __DIR__ . '/importingRadios.php');
Route::group(['middleware' => ['auth']], __DIR__ . '/reports.php');
Route::group(['middleware' => ['auth']], __DIR__ . '/backup.php');
Route::group(['middleware' => ['auth']], __DIR__ . '/editorNotifications.php');

Route::get('/new-codes', function (Request $request) {
    $searchTerm = $request->query('search');
    $query = CardCode::query();
    if ($searchTerm) {
        $query->search($searchTerm);
    }
    $allNewCardCodes = $query->paginate(60);
    // Append the search term to the pagination links
    $allNewCardCodes->appends(['search' => $searchTerm]);
    return view('pages.new-codes', compact('allNewCardCodes'));
})->name('new-codes-get');


Route::get('/load-what-if-data', function (Request $request) {
    $cardCode = $request->cardCode;
    $lastEditHistory = EditHistory::where('cardCode', $cardCode)->get();
    return response()->json(['result' => json_encode($lastEditHistory)]);
})->name('load-what-if-data');


Route::get('/load-customers-files', function () {
    Documents::truncate();
    $files = Storage::allFiles('pdf');
    // This Lists Of Files in the Storage Folder
    foreach ($files as $file) {
        $userDocument  = new Documents();
        // -------------------------------------------
        $string = $file;
        $partsForMimeType = explode(".", $string);
        $fileExtension = end($partsForMimeType);
        if ($fileExtension == 'pdf') {
            $userDocument->mimeType  = 'pdf';
        } else {
            $userDocument->mimeType  =  'img';
        }
        // ------------------------------
        $partsForCardCode = explode('/', $string);
        $cardCode =  $partsForCardCode[1];  // * CardCode For Customer 
        $customer  = Customers::where('CardCode', $cardCode)->first();
        if (!$customer) {
            $newMySqlCustomer  = new Customers();
            $newMySqlCustomer->CardCode = $cardCode;
            $newMySqlCustomer->save();
            $customer = $newMySqlCustomer;
        }
        $userDocument->customer_id  = $customer->id;
        $userDocument->isApproved  = 1;
        $userDocument->path = $file;  // ^ Path = $file 
        $userDocument->save();
    }
});
