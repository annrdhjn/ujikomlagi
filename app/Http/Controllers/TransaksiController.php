<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Models\DetailTransaksi;
use App\Models\Jenis;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use PDOException;

class TransaksiController extends Controller
{
    public function index()
    {
        // $data ['transaksi'] = Transaksi::get();
        // return view('pemesanan.index')->with($data);
    }

    public function store(StoreTransaksiRequest $request)
    {
        try {
            DB::beginTransaction();

            $last_id = Transaksi::where('tanggal', date('Y-m-d'))->orderBy('created_at', 'desc')->select('id')->first();
            $notrans = $last_id == null ? date('Ymd').'0001' : date('Ymd').sprintf('%04d', substr($last_id->id, 8, 4)+1);
            // dd($notrans);
            $insertTransaksi = Transaksi::create([
                'id' => $notrans,
                'tanggal' => date('Y-m-d'),
                'total_harga' => $request -> total,
                'metode_pembayaran' => 'cash',
                'keterangan' => ''
            ]);

            if (!$insertTransaksi->exists) return 'error';

            foreach ($request->orderedList as $detail) {
                // $menu = menu::find($detail['id']);
                // $menu->stok->jumlah = $menu->stok->jumlah - $detail['qty'];
                // $menu->stok->save();
                $insertDetailTransaksi = DetailTransaksi::create([
                    'transaksi_id' => $notrans,
                    'menu_id' => $detail['id'],
                    'jumlah' => $detail['qty'],
                    'subtotal' => $detail['harga'] * $detail['qty'],
                ]);
            }


            DB::commit();
            return response()->json(['status' => true, 'message' => 'Pemesanan Berhasil!', 'notrans' => $notrans]);
        } catch (Exception | QueryException | PDOException $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Pemesanan Gagal!', 'error' => $e ->getMessage()]);
        }
    }

    public function faktur($nofaktur)
    {
        try {
            // dd($nofaktur);
            $data['transaksi'] = Transaksi::where('id', $nofaktur)
                ->with(['detailTransaksi' => function ($query) {
                    $query->with('menu');
                }])->first();
    
            // dd($data['transaksi']); 
    
            return view('faktur.index')->with(($data));
        } catch (Exception | QueryException | PDOException $e) {
            return response()->json(['status' => false, 'message' => 'Pemesanan Gagal!']);
        }
        // } catch (ModelNotFoundException $e) 
        // {
        //     return response()->json(['status' => false, 'message' => 'Transaction not found.']);
        // } catch (\Exception $e) {
        //     return response()->json(['status' => false, 'message' => 'Error: ' . $e->getMessage()]);
        // }
    }
    
    

    public function update(StoreTransaksiRequest $request, Transaksi $transaksi)
    {
        // Your update method code here
    }

    public function destroy(Transaksi $transaksi)
    {
        // Your destroy method code here
    }
}
