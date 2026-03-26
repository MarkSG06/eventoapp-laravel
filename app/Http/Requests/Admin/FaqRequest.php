<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FaqRequest extends FormRequest
{

		protected function prepareForValidation()
    {

    }
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
        'locale' => 'array',
        'locale.*.question' => 'nullable|string|max:255',
        'locale.*.answer' => 'nullable|string',
      ];
    }

    public function messages()
    {
      return [
        'locale.*.question.max' => 'La pregunta no puede exceder los 255 caracteres.',
      ];
    }
}