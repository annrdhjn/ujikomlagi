<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Menu;
use App\Exports\StokExport;
use App\Http\Requests\StoreStokRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Http\Requests\UpdateStokRequest;
use Maatwebsite\Excel\Facades\Excel;

class StokController extends Controller
{
    public function index()
    {
        $data['stok'] = Stok::with(['menu'])->get();
        $data['menu'] = Menu::get();
        return view('stok.indexStok')->with($data);

    }

    public function exportData(){
        $date = date('Y-m-d');
        return Excel::download(new StokExport, $date.'_stok.xlsx');
    }

    public function store(StoreStokRequest $request)
    {
        Stok::create($request->all());
        return redirect('stok')->with('success', 'Data produk berhasil di tambahkan!');
    }

    public function update(UpdateStokRequest $request, string $id)
    {
        $stok = Stok::find($id)->update($request->all());
        return redirect('stok')->with('success', 'Update data berhasil');
    }

    public function destroy($id)
    {
        Stok::find($id)->delete();
        return redirect('stok')->with('success','Data berhasil dihapus!');
    }
}
