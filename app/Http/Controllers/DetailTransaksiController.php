<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Models\DetailTransaksi;
use App\Http\Requests\StoreDetailTransaksiRequest;
use App\Http\Requests\UpdateDetailTransaksiRequest;
use App\Models\Menu;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class DetailTransaksiController extends Controller
{
    public function index()
    {
        // $data['detail_transaksi'] = DetailTransaksi::with(['menu'])->get();
        $data['detail_transaksi'] = DetailTransaksi::with(['transaksi'])->get();
        $data['transaksi'] = Transaksi::get();
        return view('laporan.index')->with($data);

    }

    public function exportData(){
        $date = date('Y-m-d');
        return Excel::download(new LaporanExport, $date.'_laporan.xlsx');
    }

    public function generatepdf()
    {
        $detail_transaksi = DetailTransaksi::all();
        $pdf = Pdf::loadView('laporan.data', compact('detail_transaksi'));
        return $pdf->download('laporan.pdf');
    }

    public function store(StoreDetailTransaksiRequest $request)
    {
        //
    }

    public function update(StoreDetailTransaksiRequest $request, DetailTransaksi $detailTransaksi)
    {
        //
    }

    public function destroy(DetailTransaksi $detailTransaksi)
    {
        //
    }
}
