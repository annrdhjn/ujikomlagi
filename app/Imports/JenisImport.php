<?php

namespace App\Imports;

use App\Models\Jenis;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class jenisImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Check if the 'nama_jenis' key exists and is not null
            if (isset($row['nama_jenis']) && $row['nama_jenis'] !== null) {
                Jenis::create([
                    'nama_jenis' => $row['nama_jenis'],
                ]);
            }
        }
    }
}
