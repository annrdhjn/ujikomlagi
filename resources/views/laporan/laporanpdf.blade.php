<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #ffff00;
            color: white;
            text-align: center;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>

<body>

    <h1>Data Laporan</h1>
    <table id="customers">
        <tr>
            <th>No</th>
            <th>Transaksi</th>
            <th>Menu</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
        @php
        $no = 1;
        @endphp
        @foreach ($detail_transaksi as $p)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $p->transaksi_id }}</td>
            <td>{{ $p->menu->nama_menu }}</td>
            <td>{{ $p->jumlah }}</td>
            <td>{{ $p->subtotal }}</td>
        </tr>
        @endforeach
    </table>

</body>

</html>