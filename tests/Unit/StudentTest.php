<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Jurnal;
use App\Models\Student;
use App\Models\Attendence;
use Illuminate\Http\Testing\File;
use Illuminate\Http\UploadedFile;
use App\Models\IndustrySubmission;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StudentTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use DatabaseTransactions;
    public function test_sistem_menampilkan_siswa_jurusan()
    {
        //User siswa
        $user = User::find(5);

        //Menampilkan status 200 OK
        $response = $this->actingAs($user)->get('/dashboard/siswa')->assertSuccessful();

        $response->assertViewIs('siswa.index');
    }
    public function test_sistem_menampilkan_form_pengajuan_dudi_pkl_siswa()
    {
        //User siswa
        $user = User::find(5);

        //Menampilkan status 200 OK
        $response = $this->actingAs($user)->get('/dashboard/siswa/dudi/create')->assertSuccessful();

        $response->assertViewIs('siswa.dudi.add');
    }
    public function test_siswa_mengajukan_dudi_pkl()
    {
        //User siswa
        $user = User::find(5);

        $this->actingAs($user)->post(route('industrysubmission.dudi.store'),[
            'nama' => 'PT Bahari Elektronik',
            'student_id' => $user->id,
            'alamat' => 'Sumenep',
            'alasan' => 'Dekat dengan rumah',
            'verifikasi' => 0,
        ])->assertStatus(302);

        $pengajuan = IndustrySubmission::latest()->get()->first();
        $this->assertEquals('PT Bahari Elektronik', $pengajuan->nama);
    }

    public function test_sistem_menampilkan_daftar_jurnal_siswa()
    {
        //User siswa
        $user = User::find(5);
        
        $response = $this->actingAs($user)->get(route('jurnal.index'))->assertSuccessful();

        $response->assertViewIs('siswa.jurnal.index');
    }
    public function test_sistem_menampilkan_form_tambah_jurnal_siswa()
    {
        //User siswa
        $user = User::find(5);
        
        $response = $this->actingAs($user)->get(route('jurnal.create'))->assertSuccessful();

        $response->assertViewIs('siswa.jurnal.add');
    }
    public function test_siswa_menambahkan_jurnal_harian()
    {
        //User siswa
        $user = User::find(5);
        Storage::fake('dokumentasi');
        $file = UploadedFile::fake()->create('kegiatan_upacara.jpg', 100, 'image/jpg');
        $response = $this->actingAs($user)->post(route('jurnal.store'),[
            'student_id' => 1,
            'waktu' => now(),
            'kegiatan' => 'Upacara Bendera',
            'image' => $file,
            'verifikasi'=> false
        ])->assertStatus(302);
    }
    
    public function test_sistem_menampilkan_daftar_presensi_siswa()
    {
        //User siswa
        $user = User::find(5);
        
        $response = $this->actingAs($user)->get(route('presensi.index'))->assertSuccessful();

        $response->assertViewIs('siswa.presensi.index');
        $response->assertViewHas('attendences');
    }
    public function test_sistem_menampilkan_form_tambah_presensi_siswa()
    {
        //User siswa
        $user = User::find(5);
        
        $response = $this->actingAs($user)->get(route('presensi.create'))->assertSuccessful();

        $response->assertViewIs('siswa.presensi.add');
    }
    public function test_siswa_menambahkan_presensi_harian()
    {
        //User siswa
        $user = User::find(5);
        $response = $this->actingAs($user)->post(route('presensi.store'),[
            'student_id' => 1,
            'tanggal' => '2022-06-14',
            'jam_datang' => '07:14',
            'jam_pulang' => '16:18',
            'status' => 1,
            'verifikasi' => false
        ])->assertStatus(302);

        $attendence = Attendence::latest()->get()->first();
        $this->assertEquals('2022-06-14', $attendence->tanggal);
    }

    public function test_siswa_mengunggah_berkas_laporan()
    {
        $user = User::find(5);
        Storage::fake('file_laporan');
        $file = UploadedFile::fake()->create('file_laporan.pdf', 100, 'application/pdf');
        $response = $this->actingAs($user)->put(route('UploadBerkasLaporanSiswa',[
            'user_id' => $user->id,
        ]),[
            'file_laporan' => $file,
        ])->assertStatus(302);

        $siswa = Student::where('user_id',$user->id)->first();
        $this->assertEquals('file_laporan/file_laporan.pdf', $siswa->file_laporan);
    }
}
