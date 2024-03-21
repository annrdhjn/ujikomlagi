<?php

namespace App\Imports;

use App\Models\Pelanggan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PelangganImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
    // foreach ($rows as $row) {
        // Debug statements
        // dd($row);
    //     Pelanggan::create([
    //         'nama' => $row['nama'],
    //         'email' => $row['email'],
    //         'no_tlp' => $row['no_tlp'],
    //         'alamat' => $row['alamat'],
    //     ]);
    // }
    }

    // public function headingRow(): int{
    //     return 4;
    // }
}
