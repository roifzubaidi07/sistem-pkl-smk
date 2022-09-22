<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Mentor;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function getBerkasPembimbing(){
        return view('pembimbing.berkas', [
            'title' => 'berkas',
            'pembimbing' => Mentor::where('user_id',Auth::user()->id)->first(),
            'files' => File::all()
        ]
    );
    }
    public function getBerkasHumas(){
        return view('humas.berkas', [
            'title' => 'berkas',
            'pembimbing' => Mentor::where('user_id',Auth::user()->id)->first(),
            'files' => File::where('is_pembimbing',false)->get()
        ]
    );
}

public function getBerkasLaporanSiswa(){
    return view('siswa.laporan', [
        'title' => 'laporan',
        'template' => File::where('id',3)->first()
    ]
    );  
}

    public function getBerkasPKL(Request $request){
        $file = File::where('id',$request->id)->first();
        return response()->download(Storage::path($file->filename), $file->filename, [$file->header]);
    }
    public function UploadBerkasBimbingan(Request $request){
        $request->validate([
            'file_bimbingan' => 'required|mimes:pdf|max:2048'
        ],[
            'file_bimbingan.required' => 'Silahkan unggah file terlebih dahulu',
            'file_bimbingan.mimes' => 'Format file harus PDF',
            'file_bimbingan.max' => 'Ukuran file tidak boleh melebihi 2MB',
        ]);
        $fileName = $request->file('file_bimbingan')->getClientOriginalName();
        Mentor::where('user_id', Auth::user()->id)->update(['file_bimbingan' => 
        $request->file('file_bimbingan')->storeAs('file_bimbingan',$fileName)]);

        return redirect('/dashboard/pembimbing/berkas')->with('status', 'File Berhasil Diunggah!');
    }
    public function UploadBerkasLaporanSiswa(Request $request){
        $request->validate([
            'file_laporan' => 'required|mimes:pdf|max:2048'
        ],[
            'file_laporan.required' => 'Silahkan unggah file terlebih dahulu',
            'file_laporan.mimes' => 'Format file harus PDF',
            'file_laporan.max' => 'Ukuran file tidak boleh melebihi 2MB',
        ]);
        $fileName = $request->file('file_laporan')->getClientOriginalName();
        Student::where('user_id', Auth::user()->id)->update(['file_laporan' => 
        $request->file('file_laporan')->storeAs('file_laporan',$fileName)]);

        return redirect('/dashboard/siswa/laporan')->with('status', 'File Laporan Berhasil Diunggah!');
    }
    public function UploadSertifikatSiswa(Request $request){
        $request->validate([
            'sertifikat' => 'required|mimes:pdf|max:2048'
        ],[
            'sertifikat.required' => 'Silahkan unggah file terlebih dahulu',
            'sertifikat.mimes' => 'Format file harus PDF',
            'sertifikat.max' => 'Ukuran file tidak boleh melebihi 2MB',
        ]);
        $fileName = $request->file('sertifikat')->getClientOriginalName();
        Student::where('id', $request->id)->update(['sertifikat' => 
        $request->file('sertifikat')->storeAs('sertifikat',$fileName)]);

        return redirect('/dashboard/pembimbing')->with('status', 'File Sertifikat Berhasil Diunggah!');
    }
}
