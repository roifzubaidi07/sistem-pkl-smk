<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\File;
use App\Models\User;
use App\Models\Mentor;
use App\Models\Student;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PrTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    use DatabaseTransactions;
    public function test_sistem_menampilkan_daftar_siswa_pkl()
    {
        $user = User::find(4);
        $response = $this->actingAs($user)->get('dashboard/humas')->assertViewIs('humas.index');
        $response->assertViewHas('students');
        $response->assertSuccessful();
    }
    public function test_sistem_menampilkan_daftar_guru_pembimbing()
    {
        $user = User::find(4);
        $response = $this->actingAs($user)->get('dashboard/humas/pembimbing')->assertViewIs('humas.pembimbing');
        $response->assertViewHas('mentors');
        $response->assertSuccessful();
    }
    public function test_sistem_menampilkan_daftar_dudi()
    {
        $user = User::find(4);
        $response = $this->actingAs($user)->get('dashboard/humas/dudi')->assertViewIs('humas.dudi.index');
        $response->assertViewHas('industries');
        $response->assertSuccessful();
    }
    public function test_sistem_menampilkan_form_edit_pembimbing_siswa()
    {
        $user = User::find(4);
        $response = $this->actingAs($user)->get('dashboard/humas/edit')->assertViewIs('humas.pembimbing_edit');
        $response->assertViewHasAll(['title','students', 'mentors']);
        $response->assertSuccessful();
    }
    public function test_humas_menentukan_pembimbing_siswa()
    {
        $user = User::find(4);
        $student = Student::find(1);
        $this->actingAs($user)->put(route('editPembimbingSiswa'),[
            'id' => [$student->id],
            'mentor_id' => [2],
        ])->assertStatus(302);
        $update_student = Student::find(1);

        $this->assertEquals(2,$update_student->mentor->id);
        
    }
    public function test_sistem_menampilkan_halaman_berkas_pkl()
    {
        $user = User::find(4);
        $response = $this->actingAs($user)->get('dashboard/humas/berkas')->assertStatus(200);
        $response->assertViewIs('humas.berkas');
    }
    public function test_humas_mengunduh_berkas_pkl()
    {
        $user = User::find(4);
        $berkas = File::find(1);
        $response = $this->actingAs($user)->get(route('getBerkasPKLHumas', ['id'=>$berkas->id]))->assertDownload();
    }
}
