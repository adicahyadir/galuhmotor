<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Barang') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-between p-4 mb-5">
        <h2 class="text-lg font-semibold text-gray-600 dark:text-gray-300" > Daftar Barang </h2>
    </div>
    <div class="px-4 py-3 mb-5 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Nama</span>
            <input id="name" name="name" value="{{ $data->name }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="John Doe" disabled/>
        </label>
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Jumlah</span>
            <input type="number" id="qty" name="qty" value="{{ $data->jumlah }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="7" disabled/>
        </label>
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Harga Per Unit</span>
            <input type="number" id="price" name="price" value="{{ $data->price }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="200000" disabled/>
        </label>
        <label class="block mt-4 mb-2 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Kategori</span>
            <select name="category" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" disabled>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $data->categories_id ? 'selected' : '' }}>{{ ucfirst($category->name) }}</option>
                @endforeach
            </select>
        </label>
        <label class="block mt-4 mb-2 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Merek</span>
            <select name="merk" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" disabled>
                @foreach ($merks as $merk)
                    <option value="{{ $merk->id }}" {{ $merk->id == $data->merk_id ? 'selected' : '' }}>{{ ucfirst($merk->name) }}</option>
                @endforeach
            </select>
        </label>
        <label class="block mt-4 mb-2 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Supplier</span>
            <select name="supplier" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" disabled>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $supplier->id == $data->supplier_id ? 'selected' : '' }}>{{ ucfirst($supplier->name) }}</option>
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
    </div>
</x-app-layout>