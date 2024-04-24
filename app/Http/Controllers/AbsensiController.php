<?php

namespace App\Http\Controllers;

use Exception;
use PDOException;
use App\Models\Absensi;
use App\Exports\AbsenExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\QueryException;
use App\Http\Requests\StoreAbsensiRequest;
use App\Http\Requests\UpdateAbsensiRequest;
use App\Imports\AbsenImport;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        try{
            $data['absensi'] = Absensi::get();
            return view('absensi.index')->with($data);
        }
            catch (QueryException | Exception | PDOException $error) {
            $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    public function exportData(){
        $date = date('Y-m-d');
        return Excel::download(new AbsenExport, $date.'_absenKaryawan.xlsx');
    }
    
        public function importData(Request $request)
    {
        Excel::import(new AbsenImport, $request->import);
        return redirect()->back()->with('success', 'Import data berhasil');
    }

    public function store(StoreAbsensiRequest $request)
    {
        Absensi::create($request->all());
        return redirect('absensi')->with('success', 'Data berhasil di tambahkan!');
    }

    public function update(StoreAbsensiRequest $request, string $id)
    {
        $absensi = Absensi::find($id)->update($request->all());
        return redirect('absensi')->with('success', 'Update data berhasil');
    }

    public function destroy($id)
    {
        Absensi::find($id)->delete();
        return redirect('absensi')->with('success','Data berhasil dihapus!');
    }
}
