<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MerkController extends Controller
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
        $result = Merk::first()->paginate(5);

        return view('merk.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('merk.create');
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
            'name' => 'required|unique:merks',
        ]);

        Merk::create([
            'name' => strtolower($request->name),
        ]);

        alert()->success('Merek telah terekam dalam sistem .', 'Berhasil', 'success');

        return redirect()->route('merek.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Merk $merek)
    {
        $data = Merk::find($merek->id);

        return view('merk.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Merk $merek)
    {
        $data = Merk::find($merek->id);

        return view('merk.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merk $merek)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $data = Merk::find($merek->id);

        if ($data->name != $request->name) {
            $data->name = strtolower($request->name);
            $data->save();
        }

        alert()->info('Data telah terubah dalam sistem .', 'Berhasil', 'success');

        return redirect()->route('merek.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merk $merek)
    {
        Merk::find($merek->id)->delete();

        alert()->success('Data telah terhapus dalam sistem .', 'Berhasil', 'success');

        return redirect()->route('merek.index');
    }
}
