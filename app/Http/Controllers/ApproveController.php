<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\EditGrave;
use App\Models\EditHistory;
use App\Models\EditorOnceTimeNOtification;
use App\Models\TempDisapprove;
use Illuminate\Http\Request;

class ApproveController extends Controller
{
    public function approveField(Request $request)
    {
        // approveField() is Now for Disapproval NOT for Approval 
        $verticalPosition  = $request->scrollY;
        $tmpDisapprove  = new TempDisapprove();
        $approvedLog  = EditHistory::where('id', $request->approveFieldId)->first();
        $editGrave = new EditGrave();
        $editGrave->cardCode  = $tmpDisapprove->cardCode =  $approvedLog->cardCode;
        $editGrave->editor_id = $tmpDisapprove->editor_id =   $approvedLog->editor_id;
        $editGrave->fieldName = $tmpDisapprove->fieldName =   $approvedLog->fieldName;
        $editGrave->oldValue  = $tmpDisapprove->oldValue =  $approvedLog->oldValue;
        $editGrave->newValue  = $tmpDisapprove->newValue =  $approvedLog->newValue;
        $editGrave->save();
        // Save in the Notification For the files ALso ....
        // How to Handle it Being One Time ?? 
        $notifyEditor  = new EditorOnceTimeNOtification();
        $notifyEditor->editor_id  = $editGrave->editor_id;
        $notifyEditor->field_name  = $approvedLog->fieldName;
        $notifyEditor->field_old_value  = $approvedLog->oldValue == null ? "" :$approvedLog->oldValue;
        $notifyEditor->field_new_value  = $approvedLog->newValue == null ? "" :$approvedLog->newValue;
        $notifyEditor->state  = false;  // !TODO Check the Approve_all Controller ?  
        $notifyEditor->save();
        // This is a Once Time Notification and Needs To be Deleted ;
        // * DONE 

        $tmpDisapprove->save();
        $approvedLog->delete();
        return back()->with(['posY' => $verticalPosition]);
    }

    public function approveAll(Request $request)
    {
        $customerCodeAll   =  $request->allApproveCustomerCode;
        $customer    = Customers::where('CardCode', $customerCodeAll)->first();
        $allEdits  = EditHistory::where('cardCode', $customerCodeAll)->get();
        foreach ($allEdits as $edit) {
            $fieldKeyForModel = $edit->fieldName;
            $customer[$fieldKeyForModel] = $edit->newValue;
            $customer->save();
            $edit->isApproved = true;
            $edit->save();
        }

        if ($customer->CommercialRegister == "غير موجود" || $customer->CommercialRegister == null) {
            $customer->CRExpiryDate = null;
            $customer->CrCnMatch = null;
            $customer->ObCrMatch = null;
            $customer->OrgLegalStatue = null;
            $customer->save();
        }

        if ($customer->OrderBond == "غير موجود" || $customer->OrderBond == null) {
            $customer->ValueOrderException = null;
            $customer->CreationDateOrderOrException = null;
            $customer->ObCrMatch = null;
            $customer->ObSupporterIdImg = null;
            $customer->ObFrstSeeIdImg = null;
            $customer->ObScndSeeIdImg = null;
            $customer->NationalAddrFirstSupOb = null;

            $customer->ExpiryDateGuarantorPromissoryNote = null;
            $customer->ExpirationDateFirstWitness = null;
            $customer->ExpiryDateSecondWitness = null;
            $customer->ExpiryDateNationalAddressReserveGuarantor = null;
            $customer->save();
        }

        if ($customer->CommLicense == "غير موجود" ||  $customer->CommLicense == null) {
            $customer->ExpirydateCommlicense = null;
        }

        //------------------------------
        if ($customer->OwnerImg == "غير موجود" ||  $customer->OwnerImg == null) {
            $customer->OwnerIDExpiryDate = null;
            $customer->save();
        }
        if ($customer->ObSupporterIdImg == "غير موجود" ||  $customer->ObSupporterIdImg == null) {
            $customer->ExpiryDateGuarantorPromissoryNote = null;
            $customer->save();
        }
        if ($customer->ObFrstSeeIdImg == "غير موجود" ||  $customer->ObFrstSeeIdImg == null) {
            $customer->ExpirationDateFirstWitness = null;
            $customer->save();
        }
        if ($customer->ObScndSeeIdImg == "غير موجود" ||  $customer->ObScndSeeIdImg == null) {
            $customer->ExpiryDateSecondWitness = null;
            $customer->save();
        }
        //--------------------------------

        //------------------------------
        if ($customer->NationalAddrOrgImg == "غير موجود" ||  $customer->NationalAddrOrgImg == null) {
            $customer->ExpiryDateNationalAddress = null;
            $customer->save();
        }
        if ($customer->NationalAddrFirstSupOb == "غير موجود" ||  $customer->NationalAddrFirstSupOb == null) {
            $customer->ExpiryDateNationalAddressReserveGuarantor = null;
            $customer->save();
        }

        //--------------------------------

        return back();
    }
}
