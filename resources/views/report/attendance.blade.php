<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Absensi') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-center mt-4">
        <h2 class="text-lg font-semibold text-gray-600 dark:text-gray-300"> 
            {{ __('Laporan Absensi') }}
        </h2>
    </div>

    <div class="mb-4 flex items-center justify-end">
            <a href="{{ route('cetak.absensi') }}" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple mr-3">
            <span> {{ __('messages.print_report') }} </span>
            <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
            </svg>
        </a>
    </div>    


    {{-- Table --}}    
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800" >
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Jam masuk</th>
                        <th class="px-4 py-3">Jam pulang</th>
                        <th class="px-4 py-3">Keterangan</th>
                        <th class="px-4 py-3">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800" >
                    @if($roleUser == "admin")
                        @if ($absensi)
                            @foreach ($absensi as $data)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <div>
                                            <p class="font-semibold">{{$data->name}}</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">{{$data->phone}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">{{ date('h:i A', strtotime($data->check_in)) }}</td>
                                <td class="px-4 py-3 text-sm">{{ ($data->check_out == null) ? 'Belum Absen' : date('h:i A', strtotime($data->check_out)) }}</td>
                                <td class="px-4 py-3 text-sm">-</td>
                                <td class="px-4 py-3 text-sm">{{ date('j F, Y', strtotime($data->created_at)) }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <div>
                                            <p class="font-semibold">-</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">-</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">-</td>
                                <td class="px-4 py-3 text-sm">-</td>
                                <td class="px-4 py-3 text-sm">-</td>
                                <td class="px-4 py-3">-</td>
                            </tr>
                        @endif
                    @endif
                </tbody>
            </table>
        </div>
        @if ($roleUser != "admin")
            {{-- @if ($absensi != null)
                {!! $absensi->links() !!}
            @endif --}}
        @endif
    </div>

</x-app-layout>
