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

    <h1>Data Menu</h1>
    <table id="menu">
        <tr>
            <th>No</th>
            <th>Nama Menu</th>
            <th>Jenis</th>
            <th>image</th>
            <th>Deskripsi</th>
        </tr>
        @php
        $no = 1;
        @endphp
        @foreach ($menu as $p)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $p->nama_menu }}</td>
            <td>{{ $p->jenis->nama_jenis }}</td>
            <td>{{ $p->image }}</td>
            <td>{{ $p->deskripsi }}</td>
        </tr>
        @endforeach
    </table>

</body>

</html>