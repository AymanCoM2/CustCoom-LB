<?php

use App\Models\CardCode;
use App\Models\EditHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

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
})->middleware('lev1')->name('new-codes-get');



Route::get('/load-what-if-data', function (Request $request) {
    $cardCode = $request->cardCode;
    $lastEditHistory = EditHistory::where('cardCode', $cardCode)->get();
    return response()->json(['result' => json_encode($lastEditHistory)]);
})->name('load-what-if-data');



// Route::get('/change' , function (){
    
//     // DB Name Only Changed Once For this Request ;
//     dump(DB::connection()->getDatabaseName());
//     Config::set('database.connections.mysql.database','sap-proj-TM');
// }) ; 



// Route::get('/change-after' , function (){
//     // Config::set('database.connections.mysql.database','sap-proj-TM');
//     // dump(session()->get('dbName'));
//     dump(DB::connection()->getDatabaseName());
// }) ; 