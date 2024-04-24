<?php

namespace App\Imports;

use App\Models\Kategori;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class katImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Check if the 'nama_kategori' key exists and is not null
            if (isset($row['nama_kategori']) && $row['nama_kategori'] !== null) {
                Kategori::create([
                    'nama_kategori' => $row['nama_kategori'],
                ]);
            }
        }
    }
}
