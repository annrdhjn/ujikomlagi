<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Http\Requests\StorePemesananRequest;
use App\Http\Requests\UpdatePemesananRequest;
use App\Models\Jenis;

class PemesananController extends Controller
{
    public function index()
    {
        $data['pemesanan'] = Pemesanan::orderBy('created_at', 'DESC')->get();
        $jenis = Jenis::all();
        // dd($data['jenis']);

        return view('pemesanan.index', compact('data', 'jenis'));
    }

    public function store(StorePemesananRequest $request)
    {
        $data['pemesanan'] = Pemesanan::orderBy('created_at', 'DESC')->get();
        $jenis = Jenis::all();
        // dd($data['jenis']);

        return view('pemesanan.index', compact('data', 'jenis'));    
    }

    public function update(StorePemesananRequest $request, Pemesanan $pemesanan)
    {
        $pemesanan->update($request->all());

        return redirect('pemesanan')->with('success', 'update data berhasil');
    }

    public function destroy(Pemesanan $pemesanan)
    {
        //
    }
}
