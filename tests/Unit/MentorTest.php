<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\File;
use App\Models\User;
use App\Models\Jurnal;
use App\Models\Mentor;
use App\Models\Student;
use App\Models\Attendence;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class MentorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use DatabaseTransactions;
    public function test_sistem_menampilkan_daftar_siswa_bimbingan()
    {
        //User Pembimbing
        $user = User::find(2);

        //Menampilkan status 200 OK
        $this->actingAs($user)->get('/dashboard/pembimbing/presensi')->assertSuccessful();
    }
    public function test_sistem_menampilkan_halaman_presensi_siswa_bimbingan()
    {
        //User Pembimbing
        $user = User::find(2);

        //Menampilkan status 200 OK
        $this->actingAs($user)->get('/dashboard/pembimbing/presensi')->assertSuccessful();
    }
    public function test_pembimbing_memverifikasi_presensi_siswa_bimbingan()
    {
        //User Pembimbing
        $user = User::find(2);

        //memastikan put dan status response redirect 302
        $response = $this->actingAs($user)->put(route('presensi.store_validation',1),[
            'verifikasi' => true
        ])->assertStatus(302);

        $presensi = Attendence::first();

        //Memastikan sistem melakukan redirect ke route presensi
        $response->assertRedirect(route('pembimbing.presensi'));

        //memastikan nilai verifikasi TRUE
        $this->assertEquals(true, $presensi->verifikasi);
    }
    public function test_sistem_menampilkan_halaman_jurnal_siswa_bimbingan()
    {
        //Login Sebagai User Pembimbing
        $user = User::find(2);

        //Menampilkan status 200 OK
        $this->actingAs($user)->get('/dashboard/pembimbing/jurnal/1')->assertSuccessful();
        
    }
    public function test_pembimbing_memverifikasi_jurnal_siswa_bimbingan()
    {
        //User Pembimbing
        $user = User::find(2);

        //User Siswa Bimbingan
        $student = Student::find(1);
        
        //Data jurnal Siswa Bimbingan
        $jurnal = Jurnal::where('student_id',$student->id)->first();

        //Status response verifikasi jurnal 302 
        $response = $this->actingAs($user)->put(route('jurnal.store_validation',[
            'id'=>$jurnal->id,
            'student_id'=>$student->id
        ]),[
            'verifikasi' => true
        ])->assertStatus(302);

        $update_jurnal = Jurnal::where('student_id',$student->id)->first();

        //Response redirect ke halaman jurnal siswa
        $response->assertRedirect(route('pembimbing.jurnal',['id' => 1]));

        $this->assertEquals(true, $update_jurnal->verifikasi);
    }
    public function test_pembimbing_mengakses_halaman_jurnal_siswa_lain()
    {
        //User Pembimbing
        $user = User::find(2);
        
        //User Siswa Lain
        $student = Student::find(4);

        //Menampilkan Status 302, redirect ke route jurnal
        $response = $this->actingAs($user)->get('/dashboard/pembimbing/jurnal/'.$student->id)->assertStatus(302);
        $response->assertRedirect(route('jurnal_siswa'));
    }
    public function test_pembimbing_mengunduh_berkas_pkl()
    {
        $user = User::find(2);
        $berkas = File::find(1);
        $response = $this->actingAs($user)->get(route('getBerkasPKLPembimbing', ['id'=>$berkas->id]))->assertDownload();
    }
    public function test_pembimbing_mengunggah_berkas_laporan_bimbingan()
    {
        $user = User::find(2);
        Storage::fake('file_bimbingan');
        $file = UploadedFile::fake()->create('file_laporan.pdf', 100, 'application/pdf');
        $response = $this->actingAs($user)->put(route('UploadBerkasBimbingan',[
            'user_id' => $user->id,
        ]),[
            'file_bimbingan' => $file,
        ])->assertStatus(302);

        $pembimbing = Mentor::where('user_id',$user->id)->first();
        $this->assertEquals('file_bimbingan/file_laporan.pdf', $pembimbing->file_bimbingan);
    }
    public function test_pembimbing_mengunggah_sertifikat_siswa()
    {
        $user = User::find(2);
        $student = Student::find(1);
        Storage::fake('sertifikat');
        $file = UploadedFile::fake()->create('sertifikat.pdf', 100, 'application/pdf');
        $response = $this->actingAs($user)->put(route('UploadSertifikatSiswa',[
            'id' => $student->id,
        ]),[
            'sertifikat' => $file,
        ])->assertStatus(302);

        $student = Student::find(1);
        $this->assertEquals('sertifikat/sertifikat.pdf', $student->sertifikat);
    }
}
