<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

// ==============================
Route::get('/bbb', function () {
    return view('pages.insert-customer');
})->name('bbb-get');
// ==============================
Route::post('/bbb', function (Request $request) {
    $sap_Query = " 
    SELECT * FROM LB_CustomerData WHERE CardCode='" . $request->newCode . "'";

    $serverName = "10.10.10.100";
    $databaseName = "LB";
    $uid = "ayman";
    $pwd = "admin@1234";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        "TrustServerCertificate" => true,
    ];
    $conn = new PDO("sqlsrv:server = $serverName; Database = $databaseName;", $uid, $pwd, $options);
    $stmt = $conn->query($sap_Query);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row; // Append each row to the $data array
    }

    dd($data);
})->name('bbb-post');
// ==============================
