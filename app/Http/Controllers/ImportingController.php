<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Http\Requests\ExcelRequest;
use Brian2694\Toastr\Facades\Toastr;

class ImportingController extends Controller
{
    public function importCustomersExcel()
    {
        return view('pages.import-customers');
    } // OK 

    public function storeExcelImport(ExcelRequest $request)
    {
        $collections = (new FastExcel)->import($request->excelFile);
        $data = [];
        foreach ($collections as $collection) {
            foreach ($collection as $key => $value) {
            }
            array_push($data, [
                //remiving the Dummy Column
                'CardCode' => $collection['رمز شريك الأعمال'],
                'CustomerName' => $collection['اسم المالك'],
                'CRExpiryDate' => $collection["تاريخ انتهاء السجل التجارى"],
                'ExpirydateCommlicense' => $collection["تاريخ انتهاء رخصة النشاط التجارى"],
                'ValueOrderException' => $collection["قيمة سند الامر او الاستثناء"],
                'CreationDateOrderOrException' => $collection["تاريخ انشاء سند الامر او الاستثناء"],
                'OwnerIDExpiryDate' => $collection["تاريخ انتهاء هوية المالك"],
                'ExpiryDateGuarantorPromissoryNote' => $collection["تاريخ انتهاء صورة عن هوية الضامن الاحتياطي في السند لأمر"],
                'ExpirationDateFirstWitness' => $collection[" تاريخ انتهاء هوية الشاهد الاول في السند الامر"],
                'ExpiryDateSecondWitness' => $collection[" تاريخ انتهاء هوية الشاهد الثانى في السند الامر"],
                // 'StatusIdentitySecondWitness' => $collection[" حالة هوية الشاهد الثانى في السند الامر"],
                // 'GovernmentTaxIdentifier' => $collection["معرف الضريبة الحكومية"],
                'ExpiryDateNationalAddress' => $collection["تاريخ انتهاء العنوان الوطنى للمؤسسة"],
                'ExpiryDateNationalAddressReserveGuarantor' => $collection["تاريخ انتهاء العنوان الوطني للضامن الاحتياطي في سند الامر"],
                // 'DateCreated' => $collection["تاريخ الإنشاء"],
                'CustomerLocation' => $collection["لوكيشن العميل"],
                'Notes' => $collection["الملاحظات"],
                'Branches' =>  $collection["الفروع"],
                'ValueBondOrExceptionBranches' => $collection["قيمة السند او الاستثناء الاجمالية للفروع"],

                // Now Comes the Data For the RADIO Button  : 
                'CustomerType' => $collection["نوع العميل"],
                'OrgLegalStatue' => $collection["الكيان القانونى"],
                'OpenAccountPropose' => $collection["طلب فتح حساب مصدق"],
                'CommercialRegister' => $collection["السجل التجارى"],
                'CrCnMatch' => $collection["مطابقة اسم العميل بالاسم بالسجل التجارى"],
                'TaxCard' => $collection["البطاقة الضريبية"],
                'CommLicense' => $collection["رخصة النشاط التجارى"],
                'OrderBond' => $collection["سند الامر"],
                'ObCrMatch' => $collection["مطابقة رقم السجل التجارى بسند الامر"],
                'OwnerImg' => $collection[" صورة عن هوية المالك"],
                'ObSupporterIdImg' => $collection[" صورة عن هوية الضامن الاحتياطي في السند لأمر"],
                'ObFrstSeeIdImg' => $collection[" صورة عن هوية الشاهد الاول في السند الامر"],
                'ObScndSeeIdImg' => $collection[" صورة عن هوية الشاهد الثانى في السند الامر"],
                'NationalAddrOrgImg' => $collection[" صورة عن العنوان الوطني للمؤسسة"],
                'NationalAddrFirstSupOb' => $collection[" صورة عن العنوان الوطني للضامن الاحتياطي في سند الامر"],
            ]);
        }
        DB::table('customers')->insert($data);
        Toastr::success('File successfully Uploaded.');
        session()->flash('message', 'File successfully Uploaded.');
        return back();
    }
}
