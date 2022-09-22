<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Industry;
use Illuminate\Http\Request;
use App\Models\IndustrySubmission;

class IndustrySubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kakomli.pengajuan.index',[
            'title' => 'pendataan',
            'submissions' => IndustrySubmission::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siswa.dudi.add',[
            'title' => 'dashboard'
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
            'nama' => 'required|unique:industries',
            'alamat' => 'required',
            'alasan' => 'required',
        ],
        [
            'required' => 'Harap bagian :attribute di isi',
            'unique' => 'Data DUDI sudah ada di sistem',
        ]);

        IndustrySubmission::create([
            'nama' => $request->nama,
            'student_id' => auth()->user()->student[0]->id,
            'alamat' => $request->alamat,
            'alasan' => $request->alasan,
            'verifikasi' => 0,
        ]);

        return redirect('/dashboard/siswa')->with('status', 'DUDI Berhasil Ditambahkan, mohon menunggu verifikasi kakomli!');
    
    }
    public function verifikasiPendataan($id)
    {
        $dataPendataan = IndustrySubmission::where('id',$id)->first();
        IndustrySubmission::where('id',$id)->update([
            'verifikasi' => 1
        ]);
        $industry = Industry::create([
            'nama' => $dataPendataan->nama,
            'alamat' => $dataPendataan->alamat,
        ]);

        Student::where('id',$dataPendataan->student_id)->update([
            'industry_id' => $industry->id
        ]);
        return redirect('/dashboard/kakomli/pendataan')->with('status', 'DUDI ajuan siswa berhasil diverifikasi!');
    
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IndustrySubmission  $industrySubmission
     * @return \Illuminate\Http\Response
     */
    public function show(IndustrySubmission $industrySubmission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IndustrySubmission  $industrySubmission
     * @return \Illuminate\Http\Response
     */
    public function edit(IndustrySubmission $industrySubmission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IndustrySubmission  $industrySubmission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IndustrySubmission $industrySubmission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IndustrySubmission  $industrySubmission
     * @return \Illuminate\Http\Response
     */
    public function destroy(IndustrySubmission $industrySubmission)
    {
        //
    }
    public function hapusPendataan($id)
    {
        IndustrySubmission::where('id',$id)->
        delete();

        return redirect('/dashboard/kakomli/pendataan')->with('status', 'DUDI ajuan siswa berhasil dihapus!');
    }
}
