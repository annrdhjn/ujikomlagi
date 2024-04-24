<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePelangganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama' => 'required',
            'email' => 'required',
            'no_tlp' => 'required',
            'alamat' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama belum diisi',
            'email.required' => 'Email belum diisi',
            'no_tlp.required' => 'Nomor telepon belum diisi',
            'alamat.required' => 'Alamat belum diisi'

        ];
    }
}
