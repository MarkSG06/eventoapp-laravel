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
        // 'fiscal_name' => '|min:3|max:64',
        // 'nif' => '|min:3|max:64',
        // 'tax_amount' => '|min:3|max:64',
        // 'total_before_tax' => '|min:3|max:64',
        // 'total_tax' => '|min:3|max:64',
        // 'total_after_tax' => '|min:3|max:64',
        // 'datetime' => '|min:3|max:64',
        // 'ticket_number' => '|min:3|max:64',
      ];
    }

    public function messages()
    {
      return [
        // 'fiscal_name' => 'El nombre es obligatorio',
        // 'nif' => 'El nif es obligatorio',
        // 'tax_amount' => 'El tax amount es obligatorio',
        // 'total_before_tax' => 'El total before tax es obligatorio',
        // 'total_tax' => 'El total tax es obligatorio',
        // 'total_after_tax' => 'El total after tax es obligatorio',
        // 'datetime' => 'El datetime es obligatorio',
        // 'ticket_number' => 'El ticket number es obligatorio',
      ];
    }
}