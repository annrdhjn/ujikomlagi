<?php

namespace App\Http\Controllers;

use Exception;
use PDOException;
use App\Models\Pelanggan;
use App\Exports\PelangganExport;
use Illuminate\Database\QueryException;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;
use App\Imports\PelangganImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PelangganController extends Controller
{
    public function index()
    {
        try{
            $data['pelanggan'] = Pelanggan::get();
            return view('pelanggan.index')->with($data);
        }
            catch (QueryException | Exception | PDOException $error) {
            $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    public function exportData(){
        $date = date('Y-m-d');
        return Excel::download(new PelangganExport, $date.'_pelanggan.xlsx');
    }

    // public function importData(Request $request)
    // {
    //     Excel::import(new PelangganImport, $request->import);
    //     return redirect()->back()->with('success', 'Import data Pelanggan berhasil');
    // }

    public function store(StorePelangganRequest $request)
    {
        Pelanggan::create($request->all());
        return redirect('pelanggan')->with('success', 'Data produk berhasil di tambahkan!');
    }

    public function update(UpdatePelangganRequest $request, string $id)
    {
        $pelanggan = Pelanggan::find($id)->update($request->all());
        return redirect('pelanggan')->with('success', 'Update data berhasil');
    }

    public function destroy($id)
    {
        Pelanggan::find($id)->delete();
        return redirect('pelanggan')->with('success','Data berhasil dihapus!');
    }
}
