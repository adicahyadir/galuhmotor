<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class LaporanController extends Controller
{
    public function index()
    {
        return view('pegawai.index');
    }

    public function absensi()
    {
        $data = [
            'title' => 'hallo'
        ];

        $pdf = PDF::loadView('testPDF', $data);

        return $pdf->download('absensi_'.date('m-d-Y').'.pdf');
    }
    
}
