<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Requests\StorekategoriRequest;
use App\Http\Requests\UpdatekategoriRequest;
use Exception;
use Illuminate\Database\QueryException;
use PDOException;

class KategoriController extends Controller
{
    public function index()
    {
        $data['kategori'] = Kategori::get();
        return view('kategori.index')->with($data);
    }


    public function store(StoreKategoriRequest $request)
    {
        Kategori::create($request->all());
        return redirect('kategori')->with('success', 'Data berhasil di tambahkan!');
    }

    public function update(UpdateKategoriRequest $request, Kategori $kategori)
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
