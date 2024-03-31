<?php

namespace App\Http\Controllers;

use Exception;
use PDOException;
use App\Models\Meja;
use App\Http\Requests\StoreMejaRequest;
use App\Http\Requests\UpdateMejaRequest;
use Illuminate\Database\QueryException;

class MejaController extends Controller
{
    public function index()
    {
        try{
            $data['meja'] = Meja::get();
            // dd($data);
            return view('meja.index')->with($data);
        }
            catch (QueryException | Exception | PDOException $error) {
            $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    public function store(StoreMejaRequest $request)
    {
        Meja::create($request->all());
        return redirect('jenis')->with('success', 'Data produk berhasil di tambahkan!');
    }

    public function update(UpdateMejaRequest $request, string $id)
    {
        $meja = Meja::find($id)->update($request->all());
        return redirect('meja')->with('success', 'Update data berhasil');
    }

    public function destroy($id)
    {
        Meja::find($id)->delete();
        return redirect('meja')->with('success','Data jenis berhasil dihapus!');
    }
}
