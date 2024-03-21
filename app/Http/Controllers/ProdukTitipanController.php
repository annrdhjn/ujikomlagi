<?php

namespace App\Http\Controllers;

use App\Exports\ProdukExport;
use App\Models\ProdukTitipan;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreProdukTitipanRequest;
use App\Http\Requests\UpdateProdukTitipanRequest;


class ProdukTitipanController extends Controller
{
    public function index()
    {
        $data['produk'] = ProdukTitipan::get();
        return view('produk.index')->with($data);

    }

    public function exportData(){
        $date = date('Y-m-d');
        return Excel::download(new ProdukExport, $date.'_produk.xlsx');
    }

    public function store(StoreProdukTitipanRequest $request)
    {
        ProdukTitipan::create($request->all());
        return redirect('produk')->with('success', 'Data produk berhasil di tambahkan!');
    }

    public function update(UpdateProdukTitipanRequest $request, string $id)
    {
        $produkTitipan = ProdukTitipan::find($id)->update($request->all());
        return redirect('produk')->with('success', 'Update data berhasil');
    }

    public function destroy($id)
    {
        ProdukTitipan::find($id)->delete();
        return redirect('produk')->with('success','Data berhasil dihapus!');
    }
}
