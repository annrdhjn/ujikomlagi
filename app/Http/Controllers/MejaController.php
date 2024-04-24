<?php

namespace App\Http\Controllers;

use App\Exports\mejaExport;
use Exception;
use PDOException;
use App\Models\Meja;
use App\Http\Requests\StoreMejaRequest;
use App\Http\Requests\UpdateMejaRequest;
use App\Imports\mejaImport;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MejaController extends Controller
{
    public function index()
    {
        try{
            $data['meja'] = Meja::get();
            // dd($data);
            return view('meja.index')->with($data);
        }
            catch (QueryException | Exception | PDOException $error) {
            $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    public function exportData(){
        $date = date('Y-m-d');
        return Excel::download(new mejaExport, $date.'_meja.xlsx');
    }

    public function store(StoreMejaRequest $request)
    {
        Meja::create($request->all());
        return redirect('meja')->with('success', 'Data produk berhasil di tambahkan!');
    }

    public function importData(Request $request)
    {
        Excel::import(new mejaImport, $request->import);
        return redirect()->back()->with('success', 'Import data berhasil');
    }

    public function update(StoreMejaRequest $request, string $id)
    {
        $meja = Meja::find($id)->update($request->all());
        return redirect('meja')->with('success', 'Update data berhasil');
    }

    public function destroy($id)
    {
        Meja::find($id)->delete();
        return redirect('meja')->with('success','Data jenis berhasil dihapus!');
    }
}
