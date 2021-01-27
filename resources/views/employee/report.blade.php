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
    </style>
</head>
<body>
    <h1 class="center title">Galuh Motor</h1>
    <div style="margin-top: -25%;">Dari tanggal : 
        <span class="bold">{{ date('1-M-Y') }}</span>
        s/d 
        <span class="bold">{{ date('t-M-Y') }}</span>
    </div>
    <table>
        <thead>
            <tr class="th">
                <th>No</th>
                <th>Nama Pegawai</th>
                <th>Jabatan</th>
                <th>Tidak Masuk</th>
                <th>Masuk Telat</th>
                <th>Masuk Tepat Waktu</th>
                <th>Pulang Awal</th>
                <th>Pulang Tepat Waktu</th>
                <th>Jumlah Masuk Kerja</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($resultUser as $key => $dataUser)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td class="name"> {{ $dataUser->name }} </td>
                <td> {{ ucfirst($dataUser->roles()->first()->name) }} </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>