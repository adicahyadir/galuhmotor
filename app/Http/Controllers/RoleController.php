<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $role = Auth::user()->roles->first()->name;
            if ($role == "admin") {
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
        $result = Role::first()->paginate(9);

        return view('job.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('job.create');
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
            'name' => 'required|unique:roles',
        ]);

        Role::create([
            'name' => strtolower($request->name),
        ]);

        return redirect()->route('jabatan.index')
            ->with('success', 'Pegawai updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $jabatan)
    {
        $data = Role::find($jabatan->id);
        
        return view('job.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $jabatan)
    {
        $data = Role::find($jabatan->id);

        return view('job.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $jabatan)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = Role::find($jabatan->id);

        if ($data->name != $request->name) {
            $data->name = strtolower($request->name);
            $data->save();
        }

        return redirect()->route('jabatan.index')
            ->with('success', 'Pegawai updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $jabatan)
    {
        Role::find($jabatan->id)->delete();

        return redirect()->route('jabatan.index')
            ->with('success', 'Pegawai deleted successfully');
    }
}
