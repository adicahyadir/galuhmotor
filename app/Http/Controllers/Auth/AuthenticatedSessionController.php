<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $role = new Role;
        $data = $role->getRole($request->email);
        $request->session()->regenerate();
        
        switch ($data) {
            case 'admin':
                return redirect(RouteServiceProvider::HOME);
                break;
            case 'kasir':
                return redirect(RouteServiceProvider::KASIR);
                break;
            default:
                echo "memek";
                break;
        }

        // $data = DB::table('users')->where('email', '=', $request->email)->get();;
        // $id = $data[0]->id;
        // $role = DB::table('role_user')->where('user_id', '=', $id)->get();
        // dd($role);die;
        // $i = false ;
        // if ($i) {
            
            // $request->session()->regenerate();
            // return redirect(RouteServiceProvider::HOME);
        // } else {
        //     echo "ok";
        // }

        // dd($request);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
