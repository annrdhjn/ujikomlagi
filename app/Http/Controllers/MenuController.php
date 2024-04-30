<?php

namespace App\Http\Controllers;

use Exception;
use PDF;
use PDOException;
use App\Models\Menu;
use App\Models\Jenis;
use App\Imports\MenuImport;
use App\Exports\MenuExport;
use Illuminate\Database\QueryException;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class MenuController extends Controller
{
    public function index()
    {
        $data['menu'] = Menu::with(['jenis'])->get();
        $data['jenis'] = Jenis::get();
        // dd($data);
        return view('menu.indexMenu')->with($data);

    }

    public function exportData(){
        $date = date('Y-m-d');
        return Excel::download(new MenuExport, $date.'_menu.xlsx');
    }

    public function importData(Request $request)
    {
        Excel::import(new MenuImport, $request->import);
        return redirect()->back()->with('success', 'Import data berhasil');
    }

    public function generatepdf()
    {
        // Get data
        $menu = Menu::all();

        // Loop through menu items and encode images to base64
        foreach ($menu as $p) {
            $imagePath = public_path('image/' . $p->image);
            if (file_exists($imagePath)) {
                $image = base64_encode(file_get_contents($imagePath));
                $p->image = $image;
            } else {
                // Handle the case where the image file doesn't exist
                $p->imageData = null; // Or any other appropriate handling
            }
        }

        // Generate PDF
        $dompdf = new Dompdf();
        $html = View::make('menu.dataMenu', compact('menu'))->render();
        $dompdf->loadHtml($html);
        $dompdf->render();

        // Return the PDF as a download
        return $dompdf->stream('menu.pdf');
    }

    public function store(StoreMenuRequest $request)
    {
        // $menu = Menu::find($id);
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('image'), $imageName);
        $data = $request->all();
        $data['image'] = $imageName;

        Menu::create($data);
        return redirect('menu')->with('success', 'Data produk berhasil di tambahkan!');

        return back()->with('success'.'You have succesfully uploaded an image.')->with('image', $imageName);
    }

    public function update(StoreMenuRequest $request, string $id)
    {
        $menu = Menu::find($id);
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('image'), $imageName);
        $data = $request->all();
        $data['image'] = $imageName;

        $menu->update($data);
        return redirect('menu')->with('success', 'Update data berhasil');
    }

    public function destroy($id)
    {
        Menu::find($id)->delete();
        return redirect('menu')->with('success','Data Menu berhasil dihapus!');
    }
}
