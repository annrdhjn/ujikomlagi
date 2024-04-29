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
    
}
