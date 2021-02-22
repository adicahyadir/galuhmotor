<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Absensi') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-center p-4 mb-5">
        <h2 class="text-lg font-semibold text-gray-600 dark:text-gray-300" > Absensi Kehadiran </h2>
    </div>

    @if ($roleUser != "admin")
    <!-- Cards -->
    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-2">
        <!-- Card -->
        <div class="flex justify-center items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"> Jam Masuk </p>
                @if (!$absen)  
                    <form method="POST" action="{{ route('absensi.store') }}">
                        @csrf
                        <input name="absensi" value="datang" class="invisible" hidden></input>
                        <button type="submit" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            <span> Klik untuk Absen </span>
                            <svg class="w-6 h-6 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6.672 1.911a1 1 0 10-1.932.518l.259.966a1 1 0 001.932-.518l-.26-.966zM2.429 4.74a1 1 0 10-.517 1.932l.966.259a1 1 0 00.517-1.932l-.966-.26zm8.814-.569a1 1 0 00-1.415-1.414l-.707.707a1 1 0 101.415 1.415l.707-.708zm-7.071 7.072l.707-.707A1 1 0 003.465 9.12l-.708.707a1 1 0 001.415 1.415zm3.2-5.171a1 1 0 00-1.3 1.3l4 10a1 1 0 001.823.075l1.38-2.759 3.018 3.02a1 1 0 001.414-1.415l-3.019-3.02 2.76-1.379a1 1 0 00-.076-1.822l-10-4z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </form>
                @else
                    @if ($absen->check_in)
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"> {{ date('h:i A', strtotime($absen->check_in)) }} </p>
                    @endif
                @endif
                {{-- <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"> 6389 </p> --}}
            </div>
        </div>
        <!-- Card -->
        <div class="flex justify-center items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"> Jam Pulang </p>
                @if (!$absen)  
                    <form method="POST" action="{{ route('absensi.store') }}">
                        @csrf
                        <input name="absensi" value="pulang" class="invisible" hidden></input>
                        <button type="submit" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            <span> Klik untuk Absen </span>
                            <svg class="w-6 h-6 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6.672 1.911a1 1 0 10-1.932.518l.259.966a1 1 0 001.932-.518l-.26-.966zM2.429 4.74a1 1 0 10-.517 1.932l.966.259a1 1 0 00.517-1.932l-.966-.26zm8.814-.569a1 1 0 00-1.415-1.414l-.707.707a1 1 0 101.415 1.415l.707-.708zm-7.071 7.072l.707-.707A1 1 0 003.465 9.12l-.708.707a1 1 0 001.415 1.415zm3.2-5.171a1 1 0 00-1.3 1.3l4 10a1 1 0 001.823.075l1.38-2.759 3.018 3.02a1 1 0 001.414-1.415l-3.019-3.02 2.76-1.379a1 1 0 00-.076-1.822l-10-4z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </form>
                @else
                    @if ($absen)
                        @if (!$absen->check_out)
                            <form method="POST" action="{{ route('absensi.store') }}">
                                @csrf
                                <input name="absensi" value="pulang" class="invisible" hidden></input>
                                <button type="submit" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                    <span> Klik untuk Absen </span>
                                    <svg class="w-6 h-6 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M6.672 1.911a1 1 0 10-1.932.518l.259.966a1 1 0 001.932-.518l-.26-.966zM2.429 4.74a1 1 0 10-.517 1.932l.966.259a1 1 0 00.517-1.932l-.966-.26zm8.814-.569a1 1 0 00-1.415-1.414l-.707.707a1 1 0 101.415 1.415l.707-.708zm-7.071 7.072l.707-.707A1 1 0 003.465 9.12l-.708.707a1 1 0 001.415 1.415zm3.2-5.171a1 1 0 00-1.3 1.3l4 10a1 1 0 001.823.075l1.38-2.759 3.018 3.02a1 1 0 001.414-1.415l-3.019-3.02 2.76-1.379a1 1 0 00-.076-1.822l-10-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </form>
                        @else
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"> {{ date('h:i A', strtotime($absen->check_out)) }} </p>
                        @endif
                    @endif
                @endif
            </div>
        </div>
    </div>
    @endif

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
                        @if ($roleUser == "admin")
                        <th class="px-4 py-3 text-center">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800" >
                    @switch($roleUser)
                        @case("admin")
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
                                    <td class="px-4 py-3 flex justify-center">
                                        <form action="{{ route('absensi.destroy', $data->id) }}" method="POST">
                                            <div class="flex items-center space-x-4 text-sm">
                                                <a href="{{ route('absensi.show', $data->id) }}" class="px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit" >
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </a>
                                                <a href="{{ route('absensi.edit', $data->id) }}" class="px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit" >
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                </a>
                                                @csrf
                                                @method('DELETE')
                                                <button class="px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
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
                                    <td class="px-4 py-3">-</td>
                                </tr>
                            @endif
                            @break
                        @default
                            @if ($absensi)
                                @foreach ($absensi as $data)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <div>
                                                <p class="font-semibold">{{$infoUser->name}}</p>
                                                <p class="text-xs text-gray-600 dark:text-gray-400">{{$infoUser->phone}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">{{ date('h:i A', strtotime( $data->check_in )) }}</td>
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
                    @endswitch
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
