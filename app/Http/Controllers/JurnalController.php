<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateJurnalRequest;
use Illuminate\Validation\Rule;

class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('siswa.jurnal.index',[
            'title' => 'jurnal',
            'jurnals' => Jurnal::where('student_id', auth()->user()->student[0]->id)->get()
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siswa.jurnal.add',[
            'title' => 'jurnal',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJurnalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kegiatan' => 'required',
            'dokumentasi' => 'required|image|max:2048',
        ],
        [
            'required' => 'Harap bagian :attribute di isi',
            'dokumentasi.required' => 'Harap unggah dokumentasi terlebih dahulu',
            'dokumentasi.mimes' => 'Format file harus gambar',
            'dokumentasi.max' => 'Ukuran file tidak boleh melebihi 2MB',
        ]
        );
        // $fileName = $request->file('dokumentasi')->getClientOriginalName();
        Jurnal::create([
            'student_id' => auth()->user()->student[0]->id,
            'waktu' => now(),
            'kegiatan' => $request->kegiatan,
            'image' => $request->file('dokumentasi')->store('dokumentasi'),
            'verifikasi' => false
        ]);
        return redirect('/dashboard/siswa/jurnal')->with('status', 'Jurnal Berhasil Ditambahkan!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jurnal  $jurnal
     * @return \Illuminate\Http\Response
     */
    public function show(Jurnal $jurnal)
    {
        //
    }
    public function show_students()
    {
        return view('pembimbing.jurnals', [
            'title' => 'jurnal',
            'students' =>  Student::where('mentor_id',auth()->user()->mentor[0]->id)->get()]);
    }
    public function show_jurnals($id)
    {
        $students = Student::where('mentor_id',auth()->user()->mentor[0]->id)->get();
        foreach($students as $student){
            if($student->id == $id)
            return view('pembimbing.jurnal', [
                'title' => 'jurnal',
                'jurnals' => Jurnal::where('student_id',$id)->get(),
                'student' => Student::where('id',$id)->first()
            ]);
        }
        return redirect('/dashboard/pembimbing/jurnal');
        
    }

    public function store_validation(Request $request)
    {
        $jurnal = Jurnal::where('id', $request->id)
        ->update(['verifikasi' => 1]);
        return redirect(route('pembimbing.jurnal',['id' => $request->student_id]))->with('status', 'Jurnal siswa berhasil diverifikasi!');
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jurnal  $jurnal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurnal $jurnal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJurnalRequest  $request
     * @param  \App\Models\Jurnal  $jurnal
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJurnalRequest $request, Jurnal $jurnal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jurnal  $jurnal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jurnal $jurnal)
    {
        //
    }
}
