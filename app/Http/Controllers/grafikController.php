<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Menu;
use App\Models\Pelanggan;
use App\Models\Pemesanan;
use App\Models\Stok;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class grafikController extends Controller
{
    public function index(){
        $menu = Menu::get();
        $data['count_menu'] = $menu ->count();

        $pelanggan = Pelanggan::get();
        $data['count_pelanggan'] = $pelanggan ->count();

        $transaksi = Transaksi::get();
        $data['count_transaksi'] = $transaksi ->count();

        $data['pelanggan'] = Pelanggan::limit(5)->orderBy('created_at', 'desc')->get();
        $data['detail_transaksi'] = DetailTransaksi::limit(5)->orderBy('created_at', 'desc')->get();
        $data['stok'] = Stok::limit(5)->orderBy('jumlah', 'asc')->get();

        $data['transaksi'] = DetailTransaksi::limit(3)->orderBy('created_at', 'desc')->get();
        
        $transaksi = Transaksi::get();
        $data['pendapatan'] = $transaksi->sum('total_harga');


    
        return view('grafik')->with($data);

    }

    public function grafik(Request $request)
    {
        // Ambil tanggal dari inputan form
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');

        // Query untuk mendapatkan data transaksi berdasarkan tanggal
        $transaksi = detailTransaksi::whereBetween('tanggal', [$tanggalMulai, $tanggalSelesai])->get();

        // Inisialisasi array untuk data grafik
        $labels = [];
        $data = [];

        // Loop melalui data transaksi
        foreach ($transaksi as $item) {
            // Misalnya, kita akan menggunakan tanggal transaksi sebagai label
            $labels[] = $item->created_at->format('Y-m-d');
            // Jumlah transaksi akan digunakan sebagai data
            $data[] = $item->jumlah_transaksi;
        }

        // Kemudian, kirimkan data ini ke view
        return view('grafik')->with(compact('labels', 'data'));
    }
    
}
