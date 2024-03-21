<body>
    <h2>JCafe</h2>
    <h3>Songsu-dong</h3>
    <hr>

    @if(isset($transaksi))
        <!-- <h5>NO. FAKTUR : {{ isset($transaksi->id) ? $transaksi->id : 'Not Set' }}</h5>
        <h5>{{ isset($transaksi->tanggal) ? $transaksi->tanggal : 'Not Set' }}</h5> -->
        <h3>NO. FAKTUR : {{ $transaksi -> id}}</h3>
        <h3>Tanggal    :{{ $transaksi->tanggal }}</h3>

        <table border="0">
            <thead>
                <tr>
                    <td>Qty</td>
                    <td>Item</td>
                    <td>Harga</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi->detailTransaksi as $item)
                    <tr>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $item->menu->nama_menu }}</td>
                        <td>{{ number_format($item->menu->harga, 0, "," , ".") }}</td>
                        <td>{{ number_format($item->subtotal, 0, "," , ".") }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total</td>
                    <td>{{ number_format($transaksi->total_harga,0,",",".") }}</td>
                </tr>
            </tfoot>
        </table>
    @else
        <p>No transaction found.</p>
    @endif
</body>
