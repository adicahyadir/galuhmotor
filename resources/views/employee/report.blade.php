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
                @php $total = 0; $telat = 0; $tepat = 0; $pulangAwal = 0; $pulangTepat = 0; @endphp
                @foreach ($resultAttendance as $key => $dataAttendance)
                @php 
                if ($dataAttendance->users_id == $dataUser->id) {
                    $total++;
                    if (strtotime($dataAttendance->created_at->format('H:i')) >= strtotime('08:00:00')) {
                        $telat++;
                    }
                   
                    if (strtotime($dataAttendance->created_at->format('H:i')) <= strtotime('08:00:00')) {
                        $tepat++;
                    }

                    if (strtotime($dataAttendance->updated_at->format('H:i')) <= strtotime('16:00:00')) {
                        $pulangAwal++;
                    }

                    if (strtotime($dataAttendance->updated_at->format('H:i')) >= strtotime('16:00:00')) {
                        $pulangTepat++;
                    }
                }
                @endphp
                @endforeach
                <td>
                    {{ date('t') - $total}}
                </td>
                <td>
                    {{ $telat }}
                </td>
                <td>
                    {{ $tepat }}
                </td>
                <td> 
                    {{ $pulangAwal }}
                </td>
                <td> 
                    {{ $pulangTepat }}
                </td>
                <td> 
                    {{ $total }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>