<?php

namespace App\Imports;

use App\Models\Stok;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StokImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Check if the 'nama_jenis' key exists and is not null
            if (isset($row['menu_id']) && $row['menu_id'] !== null) {
                Stok::create([
                    'menu_id' => $row['menu_id'],
                    'jumlah' => $row['jumlah'],
                ]);
            }
        }
    }
}
