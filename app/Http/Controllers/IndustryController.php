<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Industry;
use Illuminate\Http\Request;

class IndustryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dudi.index', [
            'title' => 'daftar-dudi',
            'industries' => Industry::all()
        ]);
    }
    public function getIndustries()
    {
        return view('humas.dudi.index', [
            'title' => 'daftar-dudi',
            'industries' => Industry::all()
        ]);
    }

    public function getDudiJurusan()
    {
        return view('kakomli.index', [
            'title' => 'penempatan',
            'industries' => Industry::all(),
            'students' => Student::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dudi.add', [
            'title' => 'daftar-dudi',
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
        $validated = $request->validate([
            'nama' => 'required|unique:industries',
            'alamat' => 'required',
            'kuota' => 'required',
        ],
        [
            'unique' => 'Data DUDI sudah terdaftar di sistem',
        ]);

        Industry::create($validated);

        return redirect('/dashboard/admin/dudi')->with('status', 'DUDI Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Industry  $industry
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.dudi.show', [
            'title' => 'daftar-dudi',
            'industry' => Industry::findOrFail($id)
        ]);
    }
    public function getIndustry($id)
    {
        return view('humas.dudi.show', [
            'title' => 'daftar-dudi',
            'industry' => Industry::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Industry  $industry
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.dudi.edit', [
            'title' => 'daftar-dudi',
            'industry' => Industry::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Industry  $industry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'kuota' => 'required',
        ]);

        Industry::where('id',$id)->
                update($validated);

        return redirect('/dashboard/admin/dudi')->with('status', 'Data DUDI Berhasil Disimpan!');
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Industry  $industry
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Industry::where('id',$id)->
                delete();
        
        Student::where('industry_id',$id)->
                update([
                    'industry_id' => null
                ]);
        return redirect('/dashboard/admin/dudi')->with('status', 'DUDI Berhasil Dihapus!');
    }
}
