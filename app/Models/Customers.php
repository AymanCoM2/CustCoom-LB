<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $fillable = [
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
        'StatusIdentitySecondWitness',
        'GovernmentTaxIdentifier',
        'ExpiryDateNationalAddress',
        'ExpiryDateNationalAddressReserveGuarantor',
        'DateCreated',
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
        'NationalAddrFirstSupOb',
    ];

    protected $hidden  = [
        'created_at', 'updated_at'
    ];
}
