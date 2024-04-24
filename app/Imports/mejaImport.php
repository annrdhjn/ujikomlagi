<?php

namespace App\Imports;

use App\Models\Meja;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class mejaImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Check if the 'nama_jenis' key exists and is not null
            if (isset($row['no_meja']) && $row['no_meja'] !== null) {
                Meja::create([
                    'no_meja' => $row['no_meja'],
                    'kapasitas' => $row['kapasitas'],
                    'status' => $row['status'],
                ]);
            }
        }
    }
}
