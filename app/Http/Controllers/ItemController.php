<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Item;
use App\Models\Merk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $role = Auth::user()->roles->first()->name;
            if ($role == "admin" || $role == "pegawai") {
                return $next($request);
            } else {
                return abort(404);
            }
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataItem = Item::first()->paginate(5);

        $categories = Categories::all();

        $merks = Merk::all();

        $suppliers = Supplier::all();

        return view('item.index', compact('dataItem', 'categories', 'merks', 'suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();

        $merks = Merk::all();

        $suppliers = Supplier::all();

        return view('item.create', compact('categories', 'merks', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:items',
            'qty' => 'required',
            'price' => 'required|numeric',
        ]);

        Item::create([
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'merk_id' => $request->merk,
            'categories_id' => $request->category,
            'supplier_id' => $request->supplier,
        ]);

        alert()->success('Barang telah terekam dalam sistem .', 'Berhasil', 'success');

        return redirect()->route('barang.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $barang)
    {
        $data = Item::find($barang->id);

        $categories = Categories::all();

        $merks = Merk::all();

        $suppliers = Supplier::all();

        return view('item.show', compact('data', 'categories', 'merks', 'suppliers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $barang)
    {
        $data = Item::find($barang->id);

        $categories = Categories::all();

        $merks = Merk::all();

        $suppliers = Supplier::all();

        return view('item.edit', compact('data', 'categories', 'merks', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $barang)
    {
        $request->validate([
            'name' => 'required',
            'qty' => 'required',
            'price' => 'required|numeric',
        ]);

        $newData = Item::find($barang->id);
        $newData->name = $request->name;
        $newData->qty = $request->qty;
        $newData->price = $request->price;
        $newData->merk_id = $request->merk;
        $newData->categories_id = $request->category;
        $newData->supplier_id = $request->supplier;
        $newData->save();

        alert()->info('Data telah terubah dalam sistem .', 'Berhasil', 'success');

        return redirect()->route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $barang)
    {
        Item::find($barang->id)->delete();

        alert()->success('Data telah terhapus dalam sistem .', 'Berhasil', 'success');

        return redirect()->route('barang.index');
    }

    public function report()
    {
        $dataItem = Item::all();

        $categories = Categories::all();

        $merks = Merk::all();

        $suppliers = Supplier::all();

        return view('report.item', compact('dataItem', 'categories', 'merks', 'suppliers'));
    }

    public function print()
    {
        $dataItem = Item::where([
            // Tanggal Pertama di Bulan tertentu
            ['created_at', '>', date('Y-m-1')],
            // Tanggal Akhir di Bulan tertentu
            ['created_at', '<', date('Y-m-t')],
        ])->get();

        $categories = Categories::all();

        $merks = Merk::all();

        $suppliers = Supplier::all();

        $pdf = PDF::loadView('item.report', compact('dataItem', 'categories', 'merks', 'suppliers'));
        return $pdf->stream(date('d-M-Y') . '_laporan-barang.pdf');
    }
}
