<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TestingRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [
                'text' => 'string',
                'number' => 'numeric',
                'bool' => 'boolean',
                'datetime' => 'date',
                'select' => 'string',
                'file' => 'file',
                'textarea' => 'string',
            ];
        }

        return [
            'text' => 'string',
            'number' => 'numeric',
            'bool' => 'boolean',
            'datetime' => 'date',
            'select' => 'string',
            'file' => 'file',
            'textarea' => 'string',
        ];
    }


    public function messages()
    {
      return [
            'text.required' => 'El campo texto es obligatorio.',
            'number.required' => 'El campo número es obligatorio.',
            'bool.required' => 'El campo booleano es obligatorio.',
            'datetime.required' => 'El campo fecha y hora es obligatorio.',
            'select.required' => 'El campo select es obligatorio.',
            'file.required' => 'El campo archivo es obligatorio.',
            'textarea.required' => 'El campo textarea es obligatorio.',
      ];
    }
}