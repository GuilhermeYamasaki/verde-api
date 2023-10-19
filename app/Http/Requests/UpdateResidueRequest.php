<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResidueRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => "required|string",
            "type" => "required|string",
            "category" => "required|string",
            "technology" => "required|string",
            "class" => "required|string",
            "unit_measurement" => "required|string",
            "weight" => "required|numeric",
        ];
    }

    public function attributes(): array
    {
        return [
            "name" => "Nome Comum do Resíduo",
            "type" => "Tipo de Resíduo",
            "category" => "Categoria",
            "technology" => "Tecnologia de Tratamento",
            "class" => "Classe",
            "unit_measurement" => "Unidade de Medida",
            "weight" => "Peso",
        ];
    }

    public function messages(): array
    {
        return [
            "required" => "Campo obrigatório",
            "string" => "Campo do tipo texto",
            "numeric" => "Campo do tipo numérico",
        ];
    }
}
