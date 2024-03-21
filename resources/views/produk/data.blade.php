<div class="x_content">
    <div class="table-responsive">
        <table class="table table-compact table stripped" id="tbl-produk">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Nama Supplier</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Keterangan</th>
                    <th>Tools</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($produk  as $p)
            <tr>
                <td>{{ $i = !isset ($i) ? ($i = 1) : ++$i }}</td>
                <td>{{ $p->namaProduk }}</td>
                <td>{{ $p->namaSupplier }}</td>
                <td>{{ $p->hargaBeli }}</td>
                <td>{{ $p->hargaJual }}</td>
                <td>{{ $p->stok }}</td>
                <td>{{ $p->keterangan }}</td>
                <td>
                    <button class="btn text-warning" data-toggle="modal" data-target="#modalFormProduk" data-mode="edit"
                        data-id="{{ $p->id }}" data-namaProduk="{{ $p->namaProduk }}" data-namaSupplier="{{ $p->namaSupplier }}" 
                        data-hargaBeli="{{ $p->hargaBeli }}" data-hargaJual="{{ $p->hargaJual }}"
                        data-stok="{{ $p->stok}}" data-keterangan="{{ $p->keterangan }}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form method="post" action="{{ route('produk.destroy', $p->id) }}" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn text-danger delete-data" data-namaProduk="{{ $p->namaProduk }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
        </table>
    </div>
</div>