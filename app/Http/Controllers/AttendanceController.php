<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
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
        $idUser = Auth::user()->id;
        
        $roleUser = User::find($idUser)->roles->first()->name;

        $pegawai = User::find($idUser)->employees->first();

        $absen = Attendance::where([
                ['created_at', 'like', date('Y-m-d').'%'],
                ['employees_id', $pegawai->id],
            ])->first(['in','out']);

        if ($roleUser == "admin") {
            if (Attendance::all()) {
                $absensi = DB::table('attendances')
                    ->join('employees', 'attendances.employees_id', '=', 'employees.id')
                    ->select('attendances.*', 'employees.*')
                    ->get();
            }
        } else {
            if (Attendance::first('created_at', date('Y-m-d').'%') == null) {
                $absensi = null;
            } else{
                $absensi = Attendance::where([
                    ['employees_id', $pegawai->id],
                ])->get();
            }
        }

        return view('attendance.index', compact('roleUser', 'pegawai', 'absen', 'absensi'));
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
        $pegawai = User::find(Auth::user()->id)->employees->first()->id;
        switch ($request->absensi) {
            case 'datang':
                Attendance::create([
                    'in' => date('Y-m-d H:i:s'),
                    'employees_id' => $pegawai,
                ]);
                break;
            
            default:
                $absen = Attendance::where([
                    ['in', 'like' ,date('Y-m-d').'%'],
                    ['employees_id', $pegawai],
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
