<?php

namespace App\Imports;

use App\Models\Absensi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AbsenImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Check if the 'nama_jenis' key exists and is not null
            if (isset($row['nama_karyawan']) && $row['nama_karyawan'] !== null) {
                Absensi::create([
                    'nama_karyawan' => $row['nama_karyawan'],
                    'tgl_masuk' => $row['tgl_masuk'],
                    'waktu_masuk' => $row['waktu_masuk'],
                    'status' => $row['status'],
                    'waktu_keluar' => $row['waktu_keluar'],
                ]);
            }
        }
    }
}
