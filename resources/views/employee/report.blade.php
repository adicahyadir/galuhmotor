<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Generate PDF From View</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <h1 class="text-center font-black text-2xl p-2">ABSENSI GALUH MOTOR</h1>
    <div class="p-2">Dari tanggal 
        <span class="font-black">{{ date('1-M-Y') }}</span>
         s/d 
        <span class="font-black">{{ date('t-M-Y') }}</span>
    </div>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap border-2 border-black-100 px-4 py-3">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Nama Pegawai</th>
                        <th class="px-4 py-3">Jabatan</th>
                        <th class="px-4 py-3">Tidak Masuk</th>
                        <th class="px-4 py-3">Masuk Telat</th>
                        <th class="px-4 py-3">Masuk Tepat Waktu</th>
                        <th class="px-4 py-3">Pulang Awal</th>
                        <th class="px-4 py-3">Pulang Tepat Waktu</th>
                        <th class="px-4 py-3">Jumlah Masuk Kerja</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($resultUser as $dataUser)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm"> {{ $dataUser->name }} </td>
                        <td class="px-4 py-3 text-sm"> {{ ucfirst($dataUser->roles()->first()->name) }} </td>
                        <td class="px-4 py-3 text-sm"> </td>
                        <td class="px-4 py-3 text-sm"> </td>
                        <td class="px-4 py-3 text-sm"> </td>
                        <td class="px-4 py-3 text-sm"> </td>
                        <td class="px-4 py-3 text-sm"> </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>