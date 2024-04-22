<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProdukTitipanController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware'=>['cekLoginUser:1']], function(){
Route::get('/', [HomeController::class, 'index']);
Route::resource('/kategori', KategoriController::class);  
Route::resource('/jenis', JenisController::class);
Route::resource('/menu', MenuController::class);
Route::resource('/stok', StokController::class);  
});

Route::group(['middleware'=>['cekLoginUser:2']], function(){
    Route::resource('/pelanggan', PelangganController::class);
    Route::resource('/pemesanan', PemesananController::class);
    Route::resource('/meja', MejaController::class);
    Route::resource('/transaksi', TransaksiController::class);
    // Route::resource('/produk', ProdukTitipanController::class);
    Route::get('/nota/{nofaktur}', [TransaksiController::class, 'faktur']);
    });

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/cek', [LoginController::class, 'cekLogin'])->name('cekLogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// export excel
Route::get('export/jenis', [JenisController::class, 'exportData'])->name('export-jenis');
Route::get('export/menu', [MenuController::class, 'exportData'])->name('export-menu');
Route::get('export/stok', [StokController::class, 'exportData'])->name('export-stok');
Route::get('export/pelanggan', [PelangganController::class, 'exportData'])->name('export-pelanggan');
Route::get('export/produk', [ProdukTitipanController::class, 'exportData'])->name('export-produk');


// Import excel
Route::post('jenis/import', [JenisController::class, 'importData'])->name('import-jenis');
Route::post('menu/import', [MenuController::class, 'importData'])->name('import-menu');
Route::post('stok/import', [StokController::class, 'importData'])->name('import-stok');
Route::post('pelanggan/import', [StokController::class, 'importData'])->name('import-pelanggan');


// Import excel
Route::get('export/jenis/pdf', [JenisController::class, 'generatepdf'])->name('export-jenis-pdf');
Route::get('export/menu/pdf', [MenuController::class, 'generatepdf'])->name('export-menu-pdf');