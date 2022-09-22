<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        return view('register',[
            'grades' => Grade::all()
        ]);
    }
    public function authenticate(Request $request){
        $request->validate([
            'nama' => 'required',
            'password' => 'required',
            'no_induk' => 'required|unique:users',
            'alamat' => 'required',
            'no_telp' => 'required|unique:users',
        ],
        [
            'required' => 'Harap bagian :attribute di isi',
            'unique' => 'Data :attribute sudah terdaftar di sistem',   
        ]);
    
        $user = User::create([
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'no_induk' => $request->no_induk,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'level_id' => 5,
        ]);
        
        Student::create([
            'grade_id' => $request->grade_id,
            'user_id' => $user->id,
            'verifikasi' => false,
        ]);
        return redirect('/')->with('status', 'Registrasi Berhasil!');
    }
}
