<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_menu' => 'required',
            'harga' => 'required',
            'image' => 'required',
            'deskripsi' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nama_menu.required' => 'Data nama menu belum diisi',
            'harga.required' => 'Data harga belum diisi',
            'deskripsi.required' => 'Data deskripsi belum diisi'
        ];
    }
}
