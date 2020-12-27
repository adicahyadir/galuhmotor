<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = User::find(Auth::user()->id)->roles->first()->name;
        $pegawai = User::find(Auth::user()->id)->pegawai->first();
        $absen = DB::table('attendances')
            ->where([
                ['pegawai_id', $pegawai->id],
                ['created_at', 'like', date('Y-m-d').'%']
            ])->first(['in','out']);

        if ($role == "admin") {
            if (Attendance::all() == null) {
                $absensi = null;
            } else{
                $absensi = Attendance::latest()->paginate(9);
            }
        } else {
            if (Attendance::first('pegawai_id', $pegawai->id) == null) {
                $absensi = null;
            } else{
                $absensi = Attendance::latest('pegawai_id', $pegawai->id)
                    ->paginate(9);
            }
        }
        // $infoPegawai = Pegawai::where('id',Attach::)

        return view('attendance.index', compact('role', 'pegawai', 'absen', 'absensi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pegawai = User::find(Auth::user()->id)->pegawai->first()->id;
        if($request->absensi == "datang") {
            Attendance::create([
                'in' => date('Y-m-d H:i:s'),
                'pegawai_id' => $pegawai,
            ]);
        } else {
            Attendance::where([
                    ['in', 'like', date('Y-m-d').'%'],
                    ['pegawai_id', $pegawai]
                ])
                ->update(['out' => date('Y-m-d H:i:s')]);
        }

        return redirect()->route('absensi.index')
            ->with('success', 'Pegawai updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
