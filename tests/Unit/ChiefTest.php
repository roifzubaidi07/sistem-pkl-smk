<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Student;
use App\Models\Industry;
use app\Http\Controllers\Controller;
use App\Models\IndustrySubmission;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class ChiefTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use DatabaseTransactions;
    public function test_sistem_menampilkan_siswa_jurusan()
    {
        //User Kakomli
        $user = User::find(11);

        //Menampilkan status 200 OK
        $this->actingAs($user)->get('/dashboard/kakomli')->assertSuccessful();
    }
    public function test_sistem_menampilkan_siswa_di_dudi_tertentu()
    {
        //User Kakomli
        $user = User::find(11);

        //contoh DUDI
        $dudi = Industry::find(1);

        //Menampilkan status 200 OK
        $this->actingAs($user)->get(route('getSiswaDudi',[
            'id' => $dudi->id
        ]))->assertViewHasAll(['title','students','dudi']);
    }
    public function test_kakomli_menambahkan_siswa_di_dudi_tertentu()
    {
        //User Kakomli
        $user = User::find(11);

        //Contoh siswa yang akan ditambahkan
        $student = Student::find(1);

        //contoh DUDI
        $dudi = Industry::find(2);

        $this->actingAs($user)->put(route('setSiswaDudi',[
            'id' => $dudi->id
        ]),[
            'id' => [$student->id],
            'industry_id' => $dudi->id,
            'kuota' => $dudi->kuota,
            'jumlah' => Controller::cekKuota($dudi->id)
        ])->assertStatus(302);

        $update_student = Student::find(1);

        $this->assertEquals(2,$update_student->industry_id);
    }
    public function test_kakomli_menghapus_siswa_di_dudi_tertentu()
    {
        //User Kakomli
        $user = User::find(11);

        //Contoh siswa yang akan ditambahkan
        $student = Student::find(1);

        $this->actingAs($user)->delete(route('deleteSiswaDudi',[
            'id' => $student->id
        ]),[
            'industry_id' => null,
        ])->assertStatus(302);
    }
    public function test_kakomli_menampilkan_data_ajuan_dudi_oleh_siswa()
    {
        //User Kakomli
        $user = User::find(11);

        $response = $this->actingAs($user)->get(route('pendataan.index'))->assertStatus(200);

        $response->assertViewIs('kakomli.pengajuan.index');
        $response->assertViewHasAll(['title','submissions']);
    }
    public function test_kakomli_memverifikasi_data_ajuan_dudi_oleh_siswa()
    {
        //User Kakomli
        $user = User::find(11);

        $dudiAjuan =IndustrySubmission::create([
            'student_id' => 1,
            'nama' => 'Bahari Elektronik',
            'alamat' => 'Kalianget',
            'alasan' => 'Dekat dengan rumah',
            'verifikasi' => false,
        ]);
        $this->actingAs($user)->put(route('verifikasiPendataan',[
            'id' => $dudiAjuan->id,
        ]))->assertStatus(302);

        $student = Student::find(1);
        $this->assertEquals('Bahari Elektronik', $student->industry->nama);
    }
    public function test_kakomli_menghapus_data_ajuan_dudi_oleh_siswa()
    {
        //User Kakomli
        $user = User::find(11);

        $dudiAjuan =IndustrySubmission::create([
            'student_id' => 1,
            'nama' => 'Bahari Elektronik',
            'alamat' => 'Kalianget',
            'alasan' => 'Dekat dengan rumah',
            'verifikasi' => false,
        ]);
        $this->actingAs($user)->delete(route('hapusPendataan',[
            'id' => $dudiAjuan->id,
        ]))->assertStatus(302);

        $student = Student::find(1);
        $this->assertNotEquals('Bahari Elektronik', $student->industry->nama);
    }

}
