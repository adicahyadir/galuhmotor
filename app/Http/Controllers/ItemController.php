<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Category;
use App\Models\Item;
use App\Models\Merk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $dataItem = Item::all();

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

        return redirect()->route('barang.index')
            ->with('success', 'Pegawai updated successfully');
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

        return redirect()->route('barang.index')
            ->with('success', 'Pegawai updated successfully');
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

        return redirect()->route('barang.index')
            ->with('success', 'Pegawai deleted successfully');
    }

    public function report()
    {
        return view('report.item');
    }
}
