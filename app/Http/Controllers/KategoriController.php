<?php

namespace App\Http\Controllers;

use App\Exports\KatExport;
use App\Models\Kategori;
use App\Http\Requests\StorekategoriRequest;
use App\Http\Requests\UpdatekategoriRequest;
use App\Imports\katImport;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDOException;

class KategoriController extends Controller
{
    public function index()
    {
        $data['kategori'] = Kategori::get();
        return view('kategori.index')->with($data);
    }

    public function exportData(){
        $date = date('Y-m-d');
        return Excel::download(new KatExport, $date.'_kategori.xlsx');
    }

    public function importData(Request $request)
    {
        Excel::import(new katImport, $request->import);
        return redirect()->back()->with('success', 'Import data kategori berhasil');
    }

    public function store(StoreKategoriRequest $request)
    {
        $validatedData = $request->validated();

    $kategori = Kategori::create($validatedData);

    if (!$kategori) {
        session()->flash('error', 'Data belum dimasukkan.');
        return redirect()->back();
    }

    return redirect('kategori')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(StoreKategoriRequest $request, Kategori $kategori)
    {
        $kategori -> update($request->all());
        return redirect('kategori')->with('success', 'Update data berhasil');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect('kategori')->with('success','Data berhasil dihapus!');
    }
}
