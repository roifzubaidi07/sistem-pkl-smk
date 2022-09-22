<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\Student;
use App\Models\Attendence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('siswa.presensi.index',[
            'title' => 'presensi',
            'attendences' => Attendence::where('student_id', auth()->user()->student[0]->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siswa.presensi.add',[
            'title' => 'presensi',
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
            'tanggal' => 'required',
            'jam_datang' => 'required',
            'jam_pulang' => 'required',
            'status' => 'required'
        ],
        [
            'required' => 'Harap bagian :attribute di isi',
        ]);
        Attendence::create([
            'student_id' => auth()->user()->student[0]->id,
            'tanggal' => $request->tanggal,
            'jam_datang' => $request->jam_datang,
            'jam_pulang' => $request->jam_pulang,
            'status' => $request->status,
            'verifikasi' => false
        ]);
        return redirect('/dashboard/siswa/presensi')->with('status', 'Presensi Berhasil Ditambahkan!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

    }
    public function show_attendences()
    {
        $students_id = Student::where('mentor_id',auth()->user()->mentor[0]->id)->get('id');
        return view('pembimbing.attendences', [
            'title' => 'presensi',
            'attendences' => Attendence::wherein('student_id',$students_id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendence $attendence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendence $attendence)
    {
        //
    }
    public function store_validation(Request $request)
    {
        Attendence::where('id', $request->id)
        ->update(['verifikasi' => 1]);

        return redirect('dashboard/pembimbing/presensi')->with('status', 'Presensi siswa berhasil diverifikasi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendence $attendence)
    {
        //
    }
}
