<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $idUser = Auth::user()->id;
        
        $roleUser = User::find(Auth::user()->id)->roles->first()->name;

        return view('dashboard', compact('roleUser'));
    }
}
