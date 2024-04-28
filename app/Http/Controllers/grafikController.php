<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pelanggan;
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
    
        return view('grafik')->with($data);

    }
    
}
