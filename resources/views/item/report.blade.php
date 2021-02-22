<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <style type="text/css">
        table, th, td {
            font-size: x-small;
            border: 1px solid black;
            border-collapse: collapse;
        }
        table {
            width: 100%;
        }
        .th {
            height: 50px;
        }
        td {
            height: 25px;
            text-align: center;
            width: auto;
        }
        .title {
            font-size: 1.5rem;
            margin-top: -25px;
        }
        .bold {
            font-weight: 700!important;
        }
        .name {
            text-align: initial;
            width: 30%;
        }
        .center {
            text-align: center;
        }
        table {
            margin: 5px 0 5px 0;
        }
    </style>
</head>
<body>
    <h1 class="center title">Galuh Motor</h1>
    <div style="margin-top: -10px;">Dari tanggal : 
        <span class="bold">{{ date('1-M-Y') }}</span>
        s/d 
        <span class="bold">{{ date('t-M-Y') }}</span>
    </div>
    <table>
        <thead>
            <tr class="th">
                <th>No</th>
                <th>Nama Barang</th>
                <th>Merek</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Suplayer</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataItem as $key => $data)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ ucfirst($data->name) }}</td>
                @foreach ($merks as $merk)
                    @if ($merk->id == $data->merk_id)
                    <td>{{ ucfirst($merk->name) }}</td>
                    @endif
                @endforeach
                @foreach ($categories as $category)
                    @if ($category->id == $data->categories_id)
                        <td>{{ ucfirst($category->name) }}</td>
                    @endif
                @endforeach
                <td>{{ number_format($data->qty,0,',','.') }} / pcs</td>
                <td>{{ number_format($data->price,0,',','.') }} / pcs</td>
                @foreach ($suppliers as $supplier)
                    @if ($supplier->id == $data->supplier_id)
                        <td>{{ ucfirst($supplier->name) }}</td>
                    @endif
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>