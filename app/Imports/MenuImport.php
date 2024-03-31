<?php

namespace App\Imports;

use App\Models\Menu;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MenuImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Check if the 'nama_jenis' key exists and is not null
            if (isset($row['nama_menu']) && $row['nama_menu'] !== null) {
                Menu::create([
                    'nama_menu' => $row['nama_menu'],
                    'jenis_id' => $row['jenis_id'],
                    'harga' => $row['harga'],
                    'image' => $row['image'],
                    'deskripsi' => $row['deskripsi'],
                ]);
            }
        }
    }
}
