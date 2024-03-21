<?php

namespace App\Http\Controllers;

use Exception;
use PDOException;
use App\Models\Jenis;
use App\Models\Kategori;
use App\Exports\JenisExport;
use App\Imports\JenisImport;
use Illuminate\Database\QueryException;
use App\Http\Requests\StoreJenisRequest;
use App\Http\Requests\UpdateJenisRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class JenisController extends Controller
{
    public function index()
    {
        try{
            $data['jenis'] = Jenis::get();
            // dd($data);
            return view('jenis.index')->with($data);
        }
            catch (QueryException | Exception | PDOException $error) {
            $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    public function exportData(){
        $date = date('Y-m-d');
        return Excel::download(new JenisExport, $date.'_jenis.xlsx');
    }

    public function importData(Request $request)
    {
        Excel::import(new jenisImport, $request->import);
        return redirect()->back()->with('success', 'Import data jenis berhasil');
    }

    public function store(StoreJenisRequest $request)
    {
        Jenis::create($request->all());
        return redirect('jenis')->with('success', 'Data produk berhasil di tambahkan!');
    }

    public function update(UpdateJenisRequest $request, string $id)
    {
        $jenis = Jenis::find($id)->update($request->all());
        return redirect('jenis')->with('success', 'Update data berhasil');
    }

    public function destroy($id)
    {
        Jenis::find($id)->delete();
        return redirect('jenis')->with('success','Data jenis berhasil dihapus!');
    }
}
