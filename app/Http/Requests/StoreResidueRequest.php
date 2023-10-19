<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResidueRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "spreadsheet" => "required|file|mimes:xlsx",
        ];
    }

    public function attributes(): array
    {
        return [
            "spreadsheet" => "Planilha",
        ];
    }

    public function messages(): array
    {
        return [
            "required" => "Campo obrigatório",
            "file" => "Campo tem que ser arquivo",
            "mimes" => "Aceita extensão de arquivo apenas .xlsx",
        ];
    }
}
