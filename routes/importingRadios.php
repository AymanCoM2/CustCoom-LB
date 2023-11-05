<?php

use App\Http\Requests\ExcelRequest;
use App\Models\ColumnOption;
use App\Models\ColumnType;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

Route::get('/options', function () {
    return view('pages.import-options');
})->name('options-get');

Route::post('/options', function (ExcelRequest $request) {
    $colNamesArra  = [
        'CardCode',
        'CustomerName',
        'CRExpiryDate',
        'ExpirydateCommlicense',
        'ValueOrderException',
        'CreationDateOrderOrException',
        'OwnerIDExpiryDate',
        'ExpiryDateGuarantorPromissoryNote',
        'ExpirationDateFirstWitness',
        'ExpiryDateSecondWitness',
        // 'StatusIdentitySecondWitness',
        // 'GovernmentTaxIdentifier',
        'ExpiryDateNationalAddress',
        'ExpiryDateNationalAddressReserveGuarantor',
        // 'DateCreated',
        'CustomerLocation',
        'Notes',
        'Branches',
        'ValueBondOrExceptionBranches',
        'CustomerType',
        'OrgLegalStatue',
        'OpenAccountPropose',
        'CommercialRegister',
        'CrCnMatch',
        'TaxCard',
        'CommLicense',
        'OrderBond',
        'ObCrMatch',
        'OwnerImg',
        'ObSupporterIdImg',
        'ObFrstSeeIdImg',
        'ObScndSeeIdImg',
        'NationalAddrOrgImg',
        'NationalAddrFirstSupOb'
    ];

    $secondData =  [];

    foreach ($colNamesArra as $key => $value) {
        array_push($secondData, [
            'colName' =>  $value,
        ]);
    }
    DB::table('column_types')->truncate(); // In Case More than One import 
    ColumnOption::truncate(); // Also Remove the Old Options 
    DB::table('column_types')->insert($secondData);

    $collections = (new FastExcel)->import($request->excelFile);
    $keys = array_keys($collections[0]);
    $eng_keys  = [
        "CustomerType",
        "OrgLegalStatue",
        "OpenAccountPropose",
        "CommercialRegister",
        'CrCnMatch', // ADDED this New option Here For the Arrayt Combinatin 
        "TaxCard",
        "CommLicense",
        "OrderBond",
        "OwnerImg",
        "ObCrMatch",
        "ObSupporterIdImg",
        "ObFrstSeeIdImg",
        "ObScndSeeIdImg",
        "NationalAddrOrgImg",
        "NationalAddrFirstSupOb"
    ];

    $finalCollection  = [];
    foreach ($keys as $key => $value) {
        $finalCollection[$value] = [];
    }

    foreach ($collections as $singleCollection) {
        foreach ($keys as $k => $v) {
            if ($singleCollection[$v]) {
                array_push($finalCollection[$v], $singleCollection[$v]);
            }
        }
    }
    $finalVersionOfOptions  = array_combine($eng_keys, $finalCollection);
    foreach ($finalVersionOfOptions as $colName => $Options) {
        $editedColumn  = ColumnType::where('colName', $colName)->first();
        $editedColumn->colType = 'ddl';
        $editedColumn->save();
        foreach ($Options as $index => $option) {
            $op = new ColumnOption();
            $op->colName  = $colName;
            $op->colOption  = $option;
            $op->save();
        }
    }
    Toastr::success('Options are Added !');
    return back();
})->name('options');
