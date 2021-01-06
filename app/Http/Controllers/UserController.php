<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = User::first()->paginate(9);

        return view('employee.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        
        return view('employee.create', compact('roles'));
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
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'job' => 'required'
        ]);

        $user = Str::lower(preg_replace('/[^A-Za-z0-9]/', '', $request->name));

        User::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'photo' => 'default.png',
            'email' => $user.'@dummy.com',
            'password' => Hash::make(123456)
        ])->roles()->attach(Role::find($request->job));

        return redirect()->route('pegawai.index')
            ->with('success', 'Pegawai updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $pegawai)
    {
        $infoUser = User::find($pegawai->id);
        
        return view('employee.show', compact('infoUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $pegawai)
    {
        $infoUser = User::find($pegawai->id);

        $roles = Role::all();

        return view('employee.edit', compact('infoUser', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $pegawai)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'job' => 'required'
        ]);

        $id = $pegawai->id;
        $infoUser = User::find($pegawai->id);
        $infoUser->name = $request->name;
        $infoUser->address = $request->address;
        $infoUser->phone = $request->phone;
        $infoUser->save();

        $newRole = $request->job;
        $currentRole = User::find($pegawai->id)->roles->first()->id;

        if ($currentRole != $newRole) {
            User::find($pegawai->id)->roles()->detach();
            User::find($pegawai->id)->roles()->attach($newRole);
        }

        if ($request->password) {
            User::find($id)->update([
                'password' => Hash::make($request->password)
            ]);
        }
        
        return redirect()->route('pegawai.index')
            ->with('success', 'Pegawai updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $pegawai)
    {
        User::find($pegawai->id)->roles()->detach();

        User::find($pegawai->id)->delete();

        return redirect()->route('pegawai.index')
            ->with('success', 'Pegawai deleted successfully');
    }
}