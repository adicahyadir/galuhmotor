<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        // $this->middleware(function ($request, $next) {
        //     $role = Auth::user()->roles->first()->name;
        //     dd($role);
        // });
    }

    public function index()
    {
        $idUser = Auth::user()->id;
        
        $roleUser = User::find(Auth::user()->id)->roles->first()->name;

        return view('dashboard.index', compact('roleUser'));
    }
}
