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
    //  'R0001'  << After From R to get the DATA from 
    // the Sap to Filter For One User 
    $osInfo = php_uname();
    $firstWord = strtok($osInfo, ' ');

    if (strcasecmp($firstWord, 'Windows') === 0) {
        $data = DB::connection('sqlsrv')->select($sap_Query);
    } else {
        $serverName = "10.10.10.100";
        $databaseName = "LB";
        $uid = "ayman";
        $pwd = "admin@1234";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::SQLSRV_ATTR_FETCHES_NUMERIC_TYPE => true,
            "TrustServerCertificate" => true,
        ];
        $conn = new PDO("sqlsrv:server = $serverName; Database = $databaseName;", $uid, $pwd, $options);
        $stmt = $conn->query($sap_Query);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row; // Append each row to the $data array
        }
    }

    dd($data);
})->name('bbb-post');
// ==============================
