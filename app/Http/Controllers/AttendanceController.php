<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idUser = Auth::user()->id;
        
        $roleUser = User::find(Auth::user()->id)->roles->first()->name;

        $infoUser = User::find(Auth::user()->id);

        $absen = Attendance::where([
                ['created_at', 'like', date('Y-m-d').'%'],
                ['users_id', $infoUser->id],
            ])->first(['in','out']);

        if ($roleUser == "admin") {
            $absensi = DB::table('attendances')
                ->join('users', 'users.id', '=', 'attendances.users_id')
                ->select('attendances.*', 'users.name', 'users.phone')
                ->get();
        } else {
            if (Attendance::first('created_at', date('Y-m-d').'%') == null) {
                $absensi = null;
            } else{
                $absensi = Attendance::where([
                    ['users_id', $infoUser->id],
                ])->get();
            }
        }

        return view('attendance.index', compact('roleUser', 'infoUser', 'absen', 'absensi'));
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
        $infoUser = User::find(Auth::user()->id);
        switch ($request->absensi) {
            case 'datang':
                Attendance::create([
                    'in' => date('Y-m-d H:i:s'),
                    'users_id' => $infoUser->id,
                ]);
                break;
            
            default:
                $absen = Attendance::where([
                    ['in', 'like' ,date('Y-m-d').'%'],
                    ['users_id', $infoUser->id],
                ])->first();
                $absen->out = date('Y-m-d H:i:s');
                $absen->save();
                break;
        }

        return redirect()->route('absensi.index')
            ->with('success', 'Pegawai updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $absensi)
    {
        $data = Attendance::find($absensi->id);

        return view('attendance.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $absensi)
    {
        Attendance::find($absensi->id)->delete();

        return redirect()->route('absensi.index')
            ->with('success', 'Pegawai deleted successfully');
    }

    public function report()
    {
        $roleUser = User::find(Auth::user()->id)->roles->first()->name;

        if ($roleUser == "admin") {
            $pegawai = User::find(Auth::user()->id);
            
            if (Attendance::all()) {
                $absensi = DB::table('attendances')
                    ->join('users', 'users.id', '=', 'attendances.users_id')
                    ->select('attendances.*', 'users.*')
                    ->get();
            }
            
            return view('report.attendance', compact('absensi', 'roleUser'));
        } else {
            return redirect()->route('absensi.index');
        }
    }
}
