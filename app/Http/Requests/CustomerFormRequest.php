<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "CustomerType" => "",
            "CustomerName" => "required",
            "OrgLegalStatue" => "",
            "OpenAccountPropose" => "",
            "CommercialRegister" => "",
            "CRExpiryDate" => "",
            "CrCnMatch" => "",
            "TaxCard" => "",
            "CommLicense" => "",
            "ExpirydateCommlicense" => "",
            "OrderBond" => "",
            "ValueOrderException" => "",
            "CreationDateOrderOrException" => "",
            "ObCrMatch" => "",
            "OwnerImg" => "",
            "OwnerIDExpiryDate" => "",
            "ExpiryDateGuarantorPromissoryNote" => "",
            "ObFrstSeeIdImg" => "",
            "ExpirationDateFirstWitness" => "",
            "ObScndSeeIdImg" => "",
            "ExpiryDateSecondWitness" => "",
            "NationalAddrOrgImg" => "",
            "ExpiryDateNationalAddress" => "",
            "NationalAddrFirstSupOb" => "",
            "ExpiryDateNationalAddressReserveGuarantor" => "",
            "CustomerLocation" => "",
            "Branches" => "",
            "ValueBondOrExceptionBranches" => "",
            "Notes" => "",
        ];
    }
}
// "id" => "176"
// "CardCode" => "B0001"
