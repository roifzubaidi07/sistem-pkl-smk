<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'no_induk' => ['required'],
            'password' => ['required'],
        ],
        [
           'required' => 'Harap bagian :attribute di isi!',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $level_id = User::where('no_induk',$request->no_induk)->value('level_id');
            $url = 'dashboard/'.Level::where('id',$level_id)->value('url');
            return redirect()->intended($url);
        }
 
        return back()->withErrors([
            'error' => 'Nomer induk atau password salah!',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
