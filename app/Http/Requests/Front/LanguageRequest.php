<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LanguageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'language' => 'required|string',
            'path' => 'required|string',
        ];
    }


    public function messages()
    {
      return [
        'language.required' => 'El idioma es obligatorio',
        'language.string' => 'El idioma debe ser una cadena de texto',
        'path.required' => 'La ruta es obligatoria',
        'path.string' => 'La ruta debe ser una cadena de texto',
      ];
    }
}