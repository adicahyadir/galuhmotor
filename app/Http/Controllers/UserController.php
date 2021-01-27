<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
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
            'phone' => 'required|unique:users|numeric',
            'job' => 'required'
        ]);

        $user = Str::lower(preg_replace('/[^A-Za-z0-9]/', '', strtolower($request->name)));

        User::create([
            'name' => ucfirst($request->name),
            'address' => $request->address,
            'phone' => $request->phone,
            'photo' => 'default.png',
            'email' => $user . '@dummy.com',
            'password' => Hash::make(123456)
        ])->roles()->attach(Role::find($request->job));

        alert()->success('Email: ' . $user . '@dummy.com Password: 123456', 'Berhasil', 'success')->autoclose(25000);

        return redirect()->route('pegawai.index');
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
            'phone' => 'required|numeric',
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

        alert()->info('Data telah terubah dalam sistem .', 'Berhasil', 'success');

        return redirect()->route('pegawai.index');
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

        alert()->success('Data telah terhapus dalam sistem .', 'Berhasil', 'success');

        return redirect()->route('pegawai.index');
    }
}
