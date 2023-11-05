<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\EditGrave;
use App\Models\EditHistory;
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
        return back();
    }
}
