<?php

namespace App\Http\Controllers;

use App\Models\Chief;
use App\Models\Mentor;
use App\Models\Student;
use App\Models\Jurnal;
use App\Models\Industry;
use App\Models\IndustrySubmission;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getSiswa()
    {
        return view('humas.index',[
            'title' => 'daftar-siswa',
            'students' => Student::all()
        ]);
    }
    public function getInfoSiswa()
    {
        return view('siswa.index',[
            'title' => 'dashboard',
            'student' => Student::where('user_id',auth()->user()->id)->first(),
        'industrySubmission' => IndustrySubmission::where('student_id',auth()->user()->student[0]->id)->first(),
        ]);
    }
    public function getSiswaBimbingan()
    {
        return view('pembimbing.index',[
            'title' => 'daftar-siswa',
            'students' => Student::where('mentor_id',auth()->user()->mentor[0]->id)->get()
        ]);

    }
    
    public function showEditPembimbingSiswa(){
        return view('humas.pembimbing_edit',[
            'title' => 'daftar-pembimbing',
            'students' => Student::all(),
            'mentors' => Mentor::all(),
        ]);
    }
    public function editPembimbingSiswa(Request $request){
        
        for ($i=0; $i < count($request->id); $i++) { 
            Student::where('id',$request->id[$i])->
                    update([
                        'mentor_id' => $request->mentor_id[$i],
                    ]);
        }
        return redirect('/dashboard/humas')->with('status', 'Pembimbing Berhasil Disimpan!');
    }

    public function getSiswaJurusan($id){
        return view('kakomli.siswa.add',[
            'title' =>'penempatan',
            'students' => Student::whereHas('grade',function($q){
                $q->where('major_id', auth()->user()->chief[0]->major_id);
            })->where('industry_id',null)->get(),
            'dudi' => Industry::where('id',$id)->first()
        ]);
    }
    public function getSiswaDudi($id){
        return view('kakomli.siswa.index',[
            'title' =>'penempatan',
            'students' => Student::where('industry_id',$id)->get(),
            'dudi' => Industry::where('id',$id)->first()
        ]);
    }
    public function setSiswaDudi(Request $request){
        if($request->jumlah+count($request->id) > $request->kuota){
            return  redirect()->back()->withErrors(['Jumlah siswa melampaui kuota DUDI!']);
        }
        for ($i=0; $i < count($request->id); $i++) { 
            Student::where('id',$request->id[$i])->
                    update([
                        'industry_id' => $request->industry_id,
                    ]);
        }
        return redirect('/dashboard/kakomli/dudi/'.$request->industry_id)->with('status', 'Data Siswa Berhasil Ditambahkan!');
    }
    public function deleteSiswaDudi(Request $request){
            Student::where('id',$request->id)->
                    update([
                        'industry_id' => null
                    ]);
        return redirect('/dashboard/kakomli/dudi/'.$request->industry_id)->with('status', 'Data Siswa Berhasil Dihapus!');
    }

 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
