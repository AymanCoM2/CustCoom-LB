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
    --CREATE VIEW CustData AS 
    WITH 
    CustDue AS
    (SELECT 
    MAX(T0.GroupName) 'GroupName',
    T0.CCode,
    MAX(T0.CardName) 'CardName',
    SUM(T0.[Due Amount]) 'Due Amount',
    MAX(T0.[Due Period]) 'Due Period',
    MAX(T0.[Balance]) 'Balance',
    MAX(T0.CreditLinE) 'CreditLinE'

    FROM TM.DBO.[2022DueMaster] T0
    WHERE T0.[Due Period] >= 60
    GROUP BY T0.CCode),

    R AS
    (SELECT C1.GroupName, T0.CardCode, T0.CardName, T0.LicTradNum ,  CAST(T0.CreateDate AS date) 'CreateDate', C0.PymntGroup,
    ISNULL(T0.CreditLine,0) 'CreditLine', ISNULL(T0.Balance,0) 'Balance',
    ISNULL(T1.[Due Amount],0) 'Due Amount', ISNULL(T1.[Due Period],0) 'Due Period',
    CASE 
    WHEN ISNULL(T1.[Due Amount],0) > 0 THEN ISNULL(T0.CreditLine,0)-ISNULL(T0.Balance,0)
    ELSE T0.CreditLine
    END AS 'Avaliable CreditLine' , T0.Free_Text, T0.GroupNum


    FROM (TM.DBO.OCRD T0 LEFT JOIN TM.DBO.OCRG C1 ON T0.GroupCode = C1.GroupCode)
    LEFT JOIN CustDue T1 ON T1.CCode = T0.CardCode
    LEFT JOIN OCTG C0 ON T0.GroupNum = C0.GroupNum

    WHERE T0.CardType = 'C'AND T0.CARDCODE <> 'Z0000' and T0.CARDCODE <> 'C0000')

    SELECT *,
    CASE WHEN R.[Avaliable CreditLine] < 0 THEN N'متجاوز الحد الائتماني'
    ELSE  N'غير متجاوز الحد الائتماني'
    END AS 'Creditline State',

    CASE WHEN R.[Due Amount] > 0 THEN CONCAT(N'متجاوز الفترة الائتمانية بمبلغ ', FORMAT(R.[Due Amount],'N2'))
        ELSE N'غير متجاوز الفترة الائتمانية'
        END AS 'DueAmount State'
    FROM R
    WHERE R.CardCode='" . $request->newCode . "'";
    //  'R0001'  << After From R to get the DATA from 
    // the Sap to Filter For One User 
    $osInfo = php_uname();
    $firstWord = strtok($osInfo, ' ');

    if (strcasecmp($firstWord, 'Windows') === 0) {
        $data = DB::connection('sqlsrv')->select($sap_Query);
    } else {
        $serverName = "10.10.10.100";
        $databaseName = "TM";
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
