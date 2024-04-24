<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAbsensiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_karyawan' => 'required',
            'tgl_masuk' => 'required',
            'waktu_masuk' => 'required',
            'status' => 'required',
            'waktu_keluar' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama belum diisi',
            'tgl_masuk.required' => 'Tanggal masuk belum diisi',
            'waktu_masuk.required' => 'Waktu masuk belum diisi',
            'status.required' => 'Status belum diisi',
            'waktu_keluar.required' => 'Waktu keluar belum diisi'

        ];
    }
}
