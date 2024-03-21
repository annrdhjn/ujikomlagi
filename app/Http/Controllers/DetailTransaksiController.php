<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Http\Requests\StoreDetailTransaksiRequest;
use App\Http\Requests\UpdateDetailTransaksiRequest;
use App\Models\Menu;
use App\Models\Transaksi;

class DetailTransaksiController extends Controller
{
    public function index()
    {
        // $data['detail_transaksi'] = DetailTransaksi::with(['menu'])->get();
        $data['detail_transaksi'] = DetailTransaksi::with(['transaksi'])->get();
        $data['transaksi'] = Transaksi::get();
        return view('faktur.index')->with($data);
    }

    public function store(StoreDetailTransaksiRequest $request)
    {
        //
    }

    public function update(UpdateDetailTransaksiRequest $request, DetailTransaksi $detailTransaksi)
    {
        //
    }

    public function destroy(DetailTransaksi $detailTransaksi)
    {
        //
    }
}
