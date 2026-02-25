<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TicketRequest extends FormRequest
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
        'fiscal_name' => 'required|min:3|max:64',
        'nif' => 'required|min:3|max:64',
        'tax_amount' => 'required|min:3|max:64',
        'total_before_tax' => 'required|min:3|max:64',
        'total_tax' => 'required|min:3|max:64',
        'total_after_tax' => 'required|min:3|max:64',
        'datetime' => 'required|min:3|max:64',
        'ticket_number' => 'required|min:3|max:64',
      ];
    }

    public function messages()
    {
      return [
        'fiscal_name.required' => 'El nombre es obligatorio',
        'nif.required' => 'El nif es obligatorio',
        'tax_amount.required' => 'El tax amount es obligatorio',
        'total_before_tax.required' => 'El total before tax es obligatorio',
        'total_tax.required' => 'El total tax es obligatorio',
        'total_after_tax.required' => 'El total after tax es obligatorio',
        'datetime.required' => 'El datetime es obligatorio',
        'ticket_number.required' => 'El ticket number es obligatorio',
      ];
    }
}