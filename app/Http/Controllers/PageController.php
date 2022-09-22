<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mentor;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index(Request $request){
        if($request)
        $url = "dashboard/".$request->user()->level->url;
        return redirect($url);
    }
    public function admin(){
        return view('admin.index',[
            'title' => 'Admin',
            'users' => User::all()
        ]);
    }
}
