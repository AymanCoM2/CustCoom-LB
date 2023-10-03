<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FormGroupingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "CustomerName" => "required_if:OrgLegalStatue,مؤسسة,CommercialRegister,موجود",
            "CustomerType" => 'required',
            "OpenAccountPropose" => "required",
            "CommercialRegister" => "required",
            "TaxCard" => "required",
            "OrderBond" => "required_if:CustomerType,آجل,اجل مستثني",
            "OwnerImg" => "required",
            "CommLicense" => "required",
            "NationalAddrOrgImg" => "required",
            // GG 
            // "OwnerIDExpiryDate" => 'nullable',
            // "required_if:anotherfield,value"
            // GG 
            "ObSupporterIdImg" =>  "required_if:OrderBond,موجود",
            "ObFrstSeeIdImg" => "required_if:OrderBond,موجود",
            "ObScndSeeIdImg" => "required_if:OrderBond,موجود",
            // "ExpiryDateGuarantorPromissoryNote" =>  "required_if:ObSupporterIdImg,موجود",
            // "ExpirationDateFirstWitness" => "required_if:ObFrstSeeIdImg,موجود",
            // "ExpiryDateSecondWitness" => "required_if:ObScndSeeIdImg,موجود",
            // GG 
            // "ExpiryDateNationalAddress" => "required_if:NationalAddrOrgImg,موجود",
            // "ExpiryDateNationalAddressReserveGuarantor" => "required_if:NationalAddrFirstSupOb,موجود",
            "NationalAddrFirstSupOb" => "required_if:OrderBond,موجود",
            // GG
            "ValueOrderException" => "required_if:OrderBond,موجود,مستثنى",
            "CreationDateOrderOrException" => "required_if:OrderBond,موجود,مستثنى",
            "ObCrMatch" => "required_if:OrderBond,موجود,مستثنى",
            // GG 
            "ExpirydateCommlicense" => "required_if:CommLicense,موجود",
            // GG 
            "CRExpiryDate" => "required_if:CommercialRegister,موجود",
            "CrCnMatch" => "required_if:CommercialRegister,موجود",
            // "TaxCard" => "required_if:CommercialRegister,موجود", // TODO ?? There is One Above
            "OrgLegalStatue" => "required_if:CommercialRegister,موجود"
        ];
    }

    public function messages()
    {
        return [
            'required' => ":attribute مطلوب",
            'required_if' => ':attribute مطلوب في حالة وجود :other '
        ];
    }

    public function attributes(): array
    {
        return [
            "CustomerName" => trans("CustomerName", [], 'ar'),
            "CustomerType" => trans("CustomerType", [], 'ar'),
            "OpenAccountPropose" => trans("OpenAccountPropose", [], 'ar'),
            "CommercialRegister" => trans("CommercialRegister", [], 'ar'),
            "CommLicense" => trans("CommLicense", [], 'ar'),
            "TaxCard" => trans("TaxCard", [], 'ar'),
            "OrderBond" => trans("OrderBond", [], 'ar'),
            "OwnerImg" => trans("OwnerImg", [], 'ar'),
            "NationalAddrOrgImg" => trans("NationalAddrOrgImg", [], 'ar'),

            "ObSupporterIdImg" =>  trans("ObSupporterIdImg", [], 'ar'),
            "ObFrstSeeIdImg" => trans("ObFrstSeeIdImg", [], 'ar'),
            "ObScndSeeIdImg" => trans("ObScndSeeIdImg", [], 'ar'),

            "OwnerIDExpiryDate" => trans("OwnerIDExpiryDate", [], 'ar'),
            "ExpiryDateGuarantorPromissoryNote" => trans("ExpiryDateGuarantorPromissoryNote", [], 'ar'),
            "ExpirationDateFirstWitness" => trans("ExpirationDateFirstWitness", [], 'ar'),
            "ExpiryDateSecondWitness" => trans("ExpiryDateSecondWitness", [], 'ar'),
            // "ExpiryDateNationalAddress" => trans("ExpiryDateNationalAddress", [], 'ar'),
            "ExpiryDateNationalAddressReserveGuarantor" => trans("ExpiryDateNationalAddressReserveGuarantor", [], 'ar'),
            "ValueOrderException" => trans("ValueOrderException", [], 'ar'),
            "CreationDateOrderOrException" => trans("CreationDateOrderOrException", [], 'ar'),
            "ObCrMatch" => trans("ObCrMatch", [], 'ar'),
            "ExpirydateCommlicense" => trans("ExpirydateCommlicense", [], 'ar'),
            "CRExpiryDate" => trans("CRExpiryDate", [], 'ar'),
            "CrCnMatch" => trans("CrCnMatch", [], 'ar'),
            "OrgLegalStatue" => trans("OrgLegalStatue", [], 'ar'),
        ];
    }
}
