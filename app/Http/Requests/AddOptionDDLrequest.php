<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddOptionDDLrequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'theDDLOption' => 'required'
        ];
    }
}
