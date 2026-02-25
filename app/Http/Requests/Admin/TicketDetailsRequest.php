<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TicketDetailsRequest extends FormRequest
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
        'ticket_id' => 'required|min:3|max:64',
        'name' => 'required|min:3|max:64',
        'description' => 'required|min:3|max:64'
        'quantity' => 'required|min:3|max:64',
        'unit_price' => 'required|min:3|max:64',
        'total' => 'required|min:3|max:64',
      ];
    }

    public function messages()
    {
      return [
        'ticket_id.required' => 'El ticket id es obligatorio',
        'name.required' => 'El nombre es obligatorio',
        'description.required' => 'La descripción es obligatoria',
        'quantity.required' => 'La cantidad es obligatoria',
        'unit_price.required' => 'El precio unitario es obligatorio',
        'total.required' => 'El total es obligatorio',
      ];
    }
}