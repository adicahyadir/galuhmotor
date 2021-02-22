<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
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
        $result = Categories::first()->paginate(5);

        return view('categories.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
            'name' => 'required|unique:categories',
        ]);

        Categories::create([
            'name' => strtolower($request->name),
        ]);

        alert()->success('Kategori telah terekam dalam sistem .', 'Berhasil', 'success');

        return redirect()->route('kategori.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $kategori)
    {
        $data = Categories::find($kategori->id);

        return view('categories.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $kategori)
    {
        $data = Categories::find($kategori->id);

        return view('categories.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categories $kategori)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $data = Categories::find($kategori->id);

        if ($data->name != $request->name) {
            $data->name = strtolower($request->name);
            $data->save();
        }

        alert()->info('Data telah terubah dalam sistem .', 'Berhasil', 'success');

        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $kategori)
    {
        Categories::find($kategori->id)->delete();

        alert()->success('Data telah terhapus dalam sistem .', 'Berhasil', 'success');
        return redirect()->route('kategori.index');
    }
}
