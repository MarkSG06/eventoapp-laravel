<?php

namespace App\Http\Requests\Admin;

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
        // 'name' => 'required|min:3|max:64',
        // 'label' => 'required|min:3|max:64',
        // 'active' => 'required|boolean',
      ];
    }

    public function messages()
    {
      return [
        // 'name' => 'El nombre es obligatorio',
        // 'label' => 'El label es obligatorio',
        // 'active' => 'El active es obligatorio',
      ];
    }
}