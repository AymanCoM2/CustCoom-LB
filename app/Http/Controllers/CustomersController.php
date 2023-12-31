<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormGroupingRequest;
use App\Models\CardCode;
use App\Models\ComLog;
use App\Models\Customers;
use App\Models\EditHistory;
use App\Models\TempDisapprove;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class CustomersController extends Controller
{
    public function customersTableGet()
    {
        return view('pages.customers-table');
    }

    public function customersTablePost(Request $request)
    {
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

        FROM LB.DBO.[2022DueMaster] T0
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

        FROM (LB.DBO.OCRD T0 LEFT JOIN LB.DBO.OCRG C1 ON T0.GroupCode = C1.GroupCode)
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
        FROM R";

        if ($request->ajax()) {
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

            $firstElement = $data[0];
            $allKeys = [];
            $tdContent = "";
            foreach ($firstElement as $key => $value) {
                array_push($allKeys, $key);
                $tdContent .= "<td>$key</td>";
            }
            $allCodes  = []; // ALL OUT CODES 
            foreach ($data as $index => $singleData) {
                array_push($allCodes, $singleData['CardCode']); //! important
            }
            $custTableCodes = DB::table('customers')->pluck('CardCode')->toArray(); // ALL IN CODES
            DB::table('card_codes')->delete();
            $tableName = 'card_codes';
            $resetAutoIncrementSql = "ALTER TABLE {$tableName} AUTO_INCREMENT = 1";
            DB::statement($resetAutoIncrementSql);
            foreach ($allCodes as $code) {
                if (!in_array($code, $custTableCodes)) {
                    $cc = new CardCode();
                    $cc->cc = $code;
                    $cc->save();
                }
            }
            return response()->json(['data' => $data, 'first' => $firstElement, 'keys' => $allKeys, 'row' => $tdContent]);
        }
    }

    public static function getSingleCustomerData($querySingleCode)
    {
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

        FROM LB.DBO.[2022DueMaster] T0
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


        FROM (LB.DBO.OCRD T0 LEFT JOIN LB.DBO.OCRG C1 ON T0.GroupCode = C1.GroupCode)
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
        FROM R";
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

        foreach ($data as $datium) {
            foreach ($datium as $key => $value) {
                if ($value == $querySingleCode) {
                    return $datium;
                }
            }
        } // End Of forEach
        return "Not Found";
    }

    public function showCustomerDataForm($cardCode)
    {
        $customerSapData  = (array) self::getSingleCustomerData($cardCode);
        $customerMySqlData  = Customers::where('CardCode', $cardCode)->first();
        if (!$customerMySqlData) {
            $newMySqlCustomer  = new Customers();
            $newMySqlCustomer->CardCode = $cardCode;
            $newMySqlCustomer->save();
            $customerMySqlData = $newMySqlCustomer;
        }
        return view('pages.customer-form-view', compact(['customerSapData', 'customerMySqlData', 'cardCode']));
    }

    public function showCustomerDataFormG($cardCode)
    {
        $posY = 0;
        $customerSapData  = (array) self::getSingleCustomerData($cardCode);
        $customerMySqlData  = Customers::where('CardCode', $cardCode)->first();
        if (!$customerMySqlData) {
            $newMySqlCustomer  = new Customers();
            $newMySqlCustomer->CardCode = $cardCode;
            $newMySqlCustomer->save();
            $customerMySqlData = $newMySqlCustomer;
            session()->flash('init', 'This User Record is Initiated For the First Time , All Data Are From Sap Only');
        }
        return view('pages.customer-form-view-g', compact(['customerSapData', 'customerMySqlData', 'cardCode', 'posY']));
    }

    public function showCustomerDataFormGApproMode($cardCode)
    {
        $posY = 0;
        $customerSapData  = (array) self::getSingleCustomerData($cardCode);
        $customerMySqlData  = Customers::where('CardCode', $cardCode)->first();
        if (!$customerMySqlData) {
            $newMySqlCustomer  = new Customers();
            $newMySqlCustomer->CardCode = $cardCode;
            $newMySqlCustomer->save();
            $customerMySqlData = $newMySqlCustomer;
            session()->flash('init', 'This User Record is Initiated For the First Time , All Data Are From Sap Only');
        }
        return view('pages.appro-mode', compact(['customerSapData', 'customerMySqlData', 'cardCode', 'posY']));
    }

    public function showCustomerDataFormGWhatIf($cardCode)
    {
        $customerSapData  = self::getSingleCustomerData($cardCode);
        $customerMySqlData  = Customers::where('CardCode', $cardCode)->first();
        if (!$customerMySqlData) {
            $newMySqlCustomer  = new Customers();
            $newMySqlCustomer->CardCode = $cardCode;
            $newMySqlCustomer->save();
            $customerMySqlData = $newMySqlCustomer;
            session()->flash('init', 'This User Record is Initiated For the First Time , All Data Are From Sap Only');
        }
        return view('pages.what-if-form', compact(['customerSapData', 'customerMySqlData', 'cardCode']));
    }

    public function showCustomerDataFrameDrive($cardCode)
    {
        $driveURL = "https://drive.google.com/a/2coom.COM/embeddedfolderview?id=1NkuNjvYAU7OhDc5nkI0a9CxTKQRvEPlz&amp;usp=sharing#grid";
        $localUrl  = "http://127.0.0.1:8000/storage/pdfs/customer_123/FWXJpxCpGlN6TPKxm12AE1jb3KemJiRJHahC2QRA.pdf";
        $url  = $driveURL;
        return view('pages.customer-frame-view-drive', compact(['cardCode', 'url']));
    }

    public function showCustomerDataFrameLocal($cardCode)
    {
        return view('pages.customer-frame-view-local', compact(['cardCode']));
    }

    public function handleCustomersForm(FormGroupingRequest $request)
    {
        $filteredFields = array_filter($request->all());
        foreach ($filteredFields as $key => $value) {
            if ($key == 'id' || $key == '_token' || $key == 'CardCode') {
                // DO NOTTHING  ; 
            } else {
                $oneLog  = new ComLog();
                $oneLog->user_id  = request()->user()->id;
                $oneLog->userCardCode = $filteredFields['CardCode'];
                $oneLog->field_name = $key;
                $oneLog->entered_value = $value;
                $oneLog->save();
            }
        }
        if ($request->user()->isSuperUser == 1) {
            $updatedCustomer  = Customers::where('id', $request->id)->first();
            $updatedCustomer->update($request->all()); // ^ This is the Update 
            $updatedCustomer->save();
            if (!isset($request->CommercialRegister)) {
                $updatedCustomer->CommercialRegister = null;
            }
            if (!isset($request->OrderBond)) {
                $updatedCustomer->OrderBond = null;
            }
            if (!isset($request->CommLicense)) {
                $updatedCustomer->CommLicense = null;
            }
            // "CommercialRegister":"السجل التجارى",
            if ($request->CommercialRegister == "غير موجود" ||  $request->CommercialRegister == null) {
                $updatedCustomer->CRExpiryDate = null;
                $updatedCustomer->CrCnMatch = null;
                $updatedCustomer->ObCrMatch = null;
                $updatedCustomer->OrgLegalStatue = null;
                $updatedCustomer->save();
            }
            // "OrderBond":"سند الامر",
            if ($request->OrderBond == "غير موجود" ||  $request->OrderBond  == null || $updatedCustomer->CustomerType == "نقدى") {
                $updatedCustomer->ValueOrderException = null;
                $updatedCustomer->CreationDateOrderOrException = null;
                $updatedCustomer->ObCrMatch = null;
                $updatedCustomer->ObSupporterIdImg = null;
                $updatedCustomer->ObFrstSeeIdImg = null;
                $updatedCustomer->ObScndSeeIdImg = null;
                $updatedCustomer->NationalAddrFirstSupOb = null;
                $updatedCustomer->ExpiryDateGuarantorPromissoryNote = null;
                $updatedCustomer->ExpirationDateFirstWitness = null;
                $updatedCustomer->ExpiryDateSecondWitness = null;
                $updatedCustomer->ExpiryDateNationalAddressReserveGuarantor = null;
                $updatedCustomer->save();
            }
            $updatedCustomer->save();
            return back();
        } else {
            $oldModelObject  = Customers::where('id', $request->id)->first(); // To compare each field 
            $filtered = array_filter($request->all());
            foreach ($oldModelObject->toArray() as $key => $value) {
                if (isset($filtered[$key]) && $key != 'id') {
                    if ($oldModelObject[$key] === $filtered[$key]) {
                    } else {
                        $editHistory  = EditHistory::where('cardCode', $oldModelObject['CardCode'])
                            ->where('fieldName', $key)->first();
                        if ($editHistory) {
                            $editHistory->cardCode = $oldModelObject['CardCode'];
                            $editHistory->editor_id  = $request->user()->id;
                            $editHistory->fieldName  = $key;
                            $editHistory->oldValue  = $oldModelObject[$key];
                            $editHistory->newValue = $filtered[$key];
                            $editHistory->isApproved  = false;
                            $editHistory->save();
                            $tmp = TempDisapprove::where('cardCode', $editHistory->cardCode)
                                ->where('fieldName', $editHistory->fieldName)
                                ->first();
                            if ($tmp) {
                                $tmp->delete();
                            }
                        } else {
                            $editLog  = new EditHistory();
                            $oldValue = $oldModelObject[$key];
                            $newValue = $filtered[$key];
                            $editLog->cardCode = $oldModelObject['CardCode'];
                            $editLog->editor_id  = $request->user()->id;
                            $editLog->fieldName  = $key;
                            $editLog->oldValue  = $oldValue;
                            $editLog->newValue = $newValue;
                            $editLog->isApproved  = false;
                            $editLog->save();
                            $tmp = TempDisapprove::where('cardCode', $editLog->cardCode)
                                ->where('fieldName', $editLog->fieldName)
                                ->first();
                            if ($tmp) {
                                $tmp->delete();
                            }
                        }
                    }
                }
            }
            // Delete any Field Name Of Id , No Need For it 
            return back();
        }
    }
}
