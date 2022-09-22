<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use App\Models\User;
use App\Models\Chief;
use App\Models\Grade;
use App\Models\Level;
use App\Models\Major;
use App\Models\Jurnal;
use App\Models\Mentor;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index',[
            'title' => 'daftar-pengguna',
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pengguna.add',[
            'title' => 'daftar-pengguna',
            'levels' => Level::all(),
            'grades' => Grade::all(),
            'majors' => Major::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'password' => 'required',
            'no_induk' => 'required|unique:users',
            'alamat' => 'required',
            'no_telp' => 'required|unique:users',
        ],
        [
            'required' => 'Harap bagian :attribute di isi', 
            'unique' => 'Data :attribute sudah terdaftar di sistem!',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'no_induk' => $request->no_induk,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'verifikasi' => true,
            'level_id' => $request->level_id,
        ]);

        if($request->level_id == 3){
            Chief::create([
                'user_id' => $user->id,
                'major_id' => $request->major_id,
            ]);
        } else if($request->level_id == 4){
            Mentor::create([
                'user_id' => $user->id,
                'major_id' => $request->major_id,
                'verifikasi' => false
            ]);
        } else if($request->level_id == 5){
            Student::create([
                'grade_id' => $request->grade_id,
                'user_id' => $user->id,
                'verifikasi' => false
            ]);
        }

        return redirect('/dashboard/admin/pengguna')->with('status', 'Pengguna Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_level = User::where('id',$id)->get('level_id')->first()->level_id;
        if($user_level == 3){
            $user_major = Chief::where('user_id',$id)->get('major_id')->first()->major_id;
            $user_grade = null;
        } else if($user_level == 4){
            $user_major = Mentor::where('user_id',$id)->get('major_id')->first()->major_id;
            $user_grade = null;
        } else if($user_level == 5){
            $user_major = null;
            $user_grade = Student::where('user_id',$id)->get('grade_id')->first()->grade_id;
        }else{
            $user_major = null;
            $user_grade = null;
        }
        return view('admin.pengguna.edit', [
            'title' => 'admin',
            'user' => User::findOrFail($id),
            'grades' => Grade::all(),
            'majors' => Major::all(),
            'user_major' => $user_major,
            'user_grade' => $user_grade
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'no_induk' => ['required',Rule::unique('users')->ignore($id)],
            'alamat' => 'required',
            'no_telp' => ['required',Rule::unique('users')->ignore($id)],
        ],
        [
            'required' => 'Harap bagian :attribute di isi', 
            'unique' => 'Data :attribute sudah terdaftar di sistem',
        ]);
        User::where('id',$id)->
                update([
                    'nama' => $request->nama,
                    'no_induk' => $request->no_induk,
                    'alamat' => $request->alamat,
                    'no_telp' => $request->no_telp,
                ]);
        switch($request->level_id) {
            case(3):
                Chief::where('user_id',$id)->
                update([
                    'major_id' => $request->major_id,
                ]);    
            break;   
            case(4):
                Mentor::where('user_id',$id)->
                update([
                    'major_id' => $request->major_id,
                ]);    
            break;   
            case(5):
                Student::where('user_id',$id)->
                update([
                    'grade_id' => $request->grade_id,
                ]);    
            break;
            default:
                return redirect('/dashboard/admin/pengguna')->with('error', 'Terdapat kesalahan, silahkan dicoba lagi!');
            }
            
            return redirect('/dashboard/admin/pengguna')->with('status', 'Data Pengguna Berhasil Disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(User::where('id',$id)->get('level_id')->first()->level_id == 4){
            $mentor_id = Mentor::where('user_id',$id)->get('id')->first()->id;
            User::where('id',$id)->
                delete();
            Student::where('mentor_id',$mentor_id)->
                    update([
                        'mentor_id' => null
                    ]);
        }else{
            User::where('id',$id)->
                    delete();
        }
        
        return redirect('/dashboard/admin/pengguna')->with('status', 'Pengguna Berhasil Dihapus!');
    }
}
