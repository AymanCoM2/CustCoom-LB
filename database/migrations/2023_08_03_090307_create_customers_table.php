<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('CardCode')->nullable();
            //  "رمز شريك الأعمال" > CardCode
            $table->string('CustomerName')->nullable();
            // "اسم المالك" > "CustomerName"
            $table->string('CRExpiryDate')->nullable();
            // "تاريخ انتهاء السجل التجارى"  > "CRExpiryDate"
            $table->string('ExpirydateCommlicense')->nullable();
            // "تاريخ انتهاء رخصة النشاط التجارى"  > "ExpirydateCommlicense"
            $table->string('ValueOrderException')->nullable();
            // "قيمة سند الامر او الاستثناء"  > "ValueOrderException"
            $table->string('CreationDateOrderOrException')->nullable();
            // "تاريخ انشاء سند الامر او الاستثناء"  > " CreationDateOrderOrException"
            $table->string('OwnerIDExpiryDate')->nullable();
            // "تاريخ انتهاء هوية المالك"  > "OwnerIDExpiryDate"
            $table->string('ExpiryDateGuarantorPromissoryNote')->nullable();
            // "تاريخ انتهاء صورة عن هوية الضامن الاحتياطي في السند لأمر"  > // "ExpiryDateGuarantorPromissoryNote"
            $table->string('ExpirationDateFirstWitness')->nullable();
            // " تاريخ انتهاء هوية الشاهد الاول في السند الامر"  > // "ExpirationDateFirstWitness"
            $table->string('ExpiryDateSecondWitness')->nullable();
            // " تاريخ انتهاء هوية الشاهد الثانى في السند الامر" >/ "ExpiryDateSecondWitness".
            // $table->string('StatusIdentitySecondWitness')->nullable();
            // "حالة هوية الشاهد الثانى في السند الامر"  > // "StatusIdentitySecondWitness"
            // $table->string('GovernmentTaxIdentifier')->nullable();
            // "معرف الضريبة الحكومية"  > "GovernmentTaxIdentifier"
            $table->string('ExpiryDateNationalAddress')->nullable();
            // "تاريخ انتهاء العنوان الوطنى للمؤسسة"  >  "ExpiryDateNationalAddress"
            $table->string('ExpiryDateNationalAddressReserveGuarantor')->nullable();
            // "تاريخ انتهاء العنوان الوطني للضامن الاحتياطي في سند الامر" > "ExpiryDateNationalAddressReserveGuarantor"
            // $table->string('DateCreated')->nullable();
            // "تاريخ الإنشاء"  > "DateCreated"
            $table->string('CustomerLocation')->nullable();
            // "لوكيشن العميل"  > "CustomerLocation"
            $table->string('Notes')->nullable();
            // "الملاحظات"  > "Notes"
            $table->string('Branches')->nullable();
            // "الفروع"  > "Branches"
            $table->string('ValueBondOrExceptionBranches')->nullable();
            // "قيمة السند او الاستثناء الاجمالية للفروع"  > "ValueBondOrExceptionBranches"

            $table->string('COM')->nullable();
            // THIS IS to tell the Type Of the Company For the Customer  ; 
            /**
             *   ! NOW THE RADIO BUTTON FIELDS : 
             */

            $table->string('CustomerType')->nullable();
            //  => $collection["نوع العميل"],
            $table->string('OrgLegalStatue')->nullable();
            //  => $collection["الكيان القانونى"],
            $table->string('OpenAccountPropose')->nullable();
            //  => $collection["طلب فتح حساب مصدق"],
            $table->string('CommercialRegister')->nullable();
            //  => $collection["السجل التجارى"],
            $table->string('CrCnMatch')->nullable();
            //  => $collection["مطابقة اسم العميل بالاسم بالسجل التجارى"],
            $table->string('TaxCard')->nullable();
            //  => $collection["البطاقة الضريبية"],
            $table->string('CommLicense')->nullable();
            //  => $collection["رخصة النشاط التجارى"],
            $table->string('OrderBond')->nullable();
            //  => $collection["سند الامر"],
            $table->string('ObCrMatch')->nullable();
            //  => $collection["مطابقة رقم السجل التجارى بسند الامر"],
            $table->string('OwnerImg')->nullable();
            //  => $collection[" صورة عن هوية المالك"],
            $table->string('ObSupporterIdImg')->nullable();
            //  => $collection[" صورة عن هوية الضامن الاحتياطي في السند لأمر"],
            $table->string('ObFrstSeeIdImg')->nullable();
            //  => $collection[" صورة عن هوية الشاهد الاول في السند الامر"],
            $table->string('ObScndSeeIdImg')->nullable();
            //  => $collection[" صورة عن هوية الشاهد الثانى في السند الامر"],
            $table->string('NationalAddrOrgImg')->nullable();
            //  => $collection[" صورة عن العنوان الوطني للمؤسسة"],
            $table->string('NationalAddrFirstSupOb')->nullable();
            //  => $collection[" صورة عن العنوان الوطني للضامن الاحتياطي في سند الامر"]
            $table->timestamps();
            // Making Fiedl Type For th
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
