<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PegawaiController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $role = auth()->user()->roles->first()->name;
            if ($role != "admin") {
                return redirect('/');
            } else {
                return $next($request);
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
        $datas = User::first()->paginate(9);

        return view('pegawai.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('pegawai.create', compact('roles'));
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
            'email' => $user.'@dummy.com',
            'password' => Hash::make(123456)
        ])->roles()->attach(Role::find($request->job));
        
        $idUser = DB::table('users')
            ->where('email', $user.'@dummy.com')->first()->id;

        Pegawai::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'photo' => 'default.png',
        ])->users()->attach(User::find($idUser));

        return redirect()->route('pegawai.index')
            ->with('success', 'Pegawai updated successfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        $id = User::find($pegawai->id);
        $name = $id->pegawai->first()->name;
        $address = $id->pegawai->first()->address;
        $phone = $id->pegawai->first()->phone;
        $role = $id->roles->first()->name;
        $email = $id->email;
        
        return view('pegawai.show', compact(
            'id', 
            'name', 
            'address', 
            'phone', 
            'role', 
            'email'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        $id = User::find($pegawai->id);
        $name = $id->pegawai->first()->name;
        $address = $id->pegawai->first()->address;
        $phone = $id->pegawai->first()->phone;
        $role = $id->roles->first()->id;
        $roles = Role::all();
        $email = $id->email;

        return view('pegawai.edit', compact(
            'id', 
            'name', 
            'address', 
            'phone', 
            'role', 
            'roles',
            'email'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'job' => 'required'
        ]);

        $id = $pegawai->id;

        $infoPegawai = User::find($id)->pegawai()->first();
        $infoPegawai->name = $request->name;
        $infoPegawai->address = $request->address;
        $infoPegawai->phone = $request->phone;
        $infoPegawai->save();

        $newRole = $request->job;
        $currentRole = User::find($id)->roles->first()->id;

        if ($currentRole != $newRole) {
            User::find($id)->roles()->detach();
            User::find($id)->roles()->attach($newRole);
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
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {   
        $idUser = $pegawai->id;
        $idPegawai = DB::table('pegawai_user')
            ->where('user_id', $idUser)
            ->first()->pegawai_id;

        Pegawai::find($idPegawai)->delete();
        User::find($idUser)->pegawai()->detach();
        User::find($idUser)->roles()->detach();
        User::find($idUser)->delete();

        return redirect()->route('pegawai.index')
            ->with('success', 'Pegawai deleted successfully');
    }
}
