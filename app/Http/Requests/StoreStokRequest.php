<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStokRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'menu_id' => 'required',
            'jumlah' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'menu_id.required' => 'Menu belum diisi',
            'jumlah.required' => 'Jumlah belum diisi',

        ];
    }
}
