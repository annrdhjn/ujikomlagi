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
        foreach ($rows as $row) {
            // Check if the 'nama_jenis' key exists and is not null
            if (isset($row['nama']) && $row['nama'] !== null) {
                Pelanggan::create([
                    'nama' => $row['nama'],
                    'email' => $row['email'],
                    'no_tlp' => $row['no_tlp'],
                    'alamat' => $row['alamat'],
                ]);
            }
        }
    }
}
