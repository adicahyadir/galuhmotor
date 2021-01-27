<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Barang') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-between p-4 mb-5">
        <h2 class="text-lg font-semibold text-gray-600 dark:text-gray-300" > Daftar Barang </h2>
    </div>

    <form method="POST" action="{{ route('barang.store') }}">
        @csrf
        <div class="px-4 py-3 mb-5 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Nama</span>
                <input id="name" name="name" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="John Doe" value="{{ old('name') }}"/>
                @error('name')
                <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </label>
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Jumlah</span>
                <input type="number" id="qty" name="qty" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="7" value="{{ old('qty') }}"/>
                @error('qty')
                <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </label>
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Harga Per Unit</span>
                <input type="number" id="price" name="price" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="200000" value="{{ old('price') }}"/>
                @error('price')
                <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </label>
            <label class="block mt-4 mb-2 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Kategori</span>
                <select name="category" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ (old('category') == $category->id) ? 'selected' : '' }}>{{ ucfirst($category->name) }}</option>
                    @endforeach
                </select>
            </label>
            <label class="block mt-4 mb-2 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Merek</span>
                <select name="merk" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                    @foreach ($merks as $merk)
                        <option value="{{ $merk->id }}" {{ (old('merk') == $merk->id) ? 'selected' : '' }}>{{ ucfirst($merk->name) }}</option>
                    @endforeach
                </select>
            </label>
            <label class="block mt-4 mb-2 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Supplier</span>
                <select name="supplier" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ ucfirst($supplier->name) }}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <div class="flex mt-4 items-center justify-between">
            <a href="{{ route('barang.index') }}" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span> Kembali </span>
            </a>
            <button type="submit" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                </svg>
                Simpan
            </button>
        </div>
    </form>
</x-app-layout>
