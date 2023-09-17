<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PdfUploadReuqest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pdfFiles' => 'required',
            'pdfFiles.*' => 'file|mimes:pdf,png,jpg,jpeg',
        ];
    }
}
