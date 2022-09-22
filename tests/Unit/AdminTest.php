<?php

namespace Tests\Unit;

use App\Models\Industry;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use DatabaseTransactions;
    public function test_sistem_menampilkan_daftar_pengguna_sistem()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('dashboard/admin')->assertViewIs('admin.index');
        $response->assertViewHas('users');
        $response->assertSuccessful();
    }
    public function test_sistem_menampilkan_form_tambah_pengguna_sistem()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('dashboard/admin/pengguna/create')->assertViewIs('admin.pengguna.add');
        $response->assertViewHasAll(['title','levels','grades', 'levels']);
        $response->assertSuccessful();
    }
    public function test_sistem_menampilkan_form_edit_pengguna_sistem()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('dashboard/admin/pengguna/5/edit')->assertViewIs('admin.pengguna.edit');
        $response->assertViewHasAll(['title', 'user','grades','grades', 'user_major','user_grade']);
        $response->assertSuccessful();
    }
    public function test_admin_menambahkan_data_pengguna()
    {
        //login sebagai admin
        $user = User::find(1);

        //admin melakukan penambahan data
        $response = $this->actingAs($user)->post(route('pengguna.store'),[
            'nama' => 'reza',
            'password' => bcrypt(12345),
            'no_induk' => '122312',
            'alamat' => 'sumenep',
            'no_telp' => '082129318212',
            'verifikasi' => true,
            'level_id' => 5,
            'grade_id' => 1,
            'verifikasi' => false,
        ]);

        $last_user = User::latest()->get()->first();

        $response->assertStatus(302);

        $this->assertEquals('reza', $last_user->nama);
        $this->assertEquals('122312', $last_user->no_induk);
        $this->assertEquals('sumenep', $last_user->alamat);
        $this->assertEquals('082129318212', $last_user->no_telp);
        $this->assertEquals(5, $last_user->level_id);
        $this->assertEquals(1, $last_user->student[0]->grade_id);
    }
    public function test_admin_mengubah_data_pengguna()
    {
        //login sebagai admin
        $user = User::find(1);
        
        //mengambil data user terakhir
        $last_user = User::latest()->get()->first();

        //admin melakukan perubahan data user ke-12
        $response = $this->actingAs($user)->put(route('pengguna.update',[
            'pengguna' => $last_user->id,
        ]),[
            'nama' => 'reza pahlevi',
            'password' => bcrypt(12345),
            'no_induk' => '122312',
            'alamat' => 'pamekasan',
            'no_telp' => '082129318212',
            'verifikasi' => true,
            'level_id' => 5,
            'grade_id' => 1,
            'verifikasi' => false, 
        ]);
        
        $update_user = User::latest()->get()->first();
        $response->assertStatus(302);

        $this->assertEquals('reza pahlevi', $update_user->nama);
        $this->assertEquals('pamekasan', $update_user->alamat);
    }
    public function test_admin_menghapus_data_pengguna()
    {
        //login sebagai admin
        $user = User::find(1);
        
        //mengambil data user terakhir
        $last_user = User::latest()->get()->first();
        //admin melakukan perubahan data user terakhir

        $response = $this->actingAs($user)->delete(route('pengguna.destroy',[
            'pengguna' => $last_user->id,
        ]));

        //mengambil data user terakhir setelah dihapus
        $update_user = User::latest()->get()->first();
        
        $response->assertStatus(302);

        //memastikan data user telah dihapus
        $this->assertNotEquals('reza pahlevi', $update_user->nama);
    }
    public function test_sistem_menampilkan_daftar_dudi()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('dashboard/admin/dudi')->assertViewIs('admin.dudi.index');
        $response->assertViewHas('industries');
        $response->assertSuccessful();
    }
    public function test_sistem_menampilkan_form_tambah_dudi()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('dashboard/admin/dudi/create')->assertViewIs('admin.dudi.add');
        $response->assertSuccessful();
    }
    public function test_sistem_menampilkan_form_edit_dudi()
    {
        $user = User::find(1);
        $dudi = Industry::find(1);
        $response = $this->actingAs($user)->get('dashboard/admin/dudi/1/edit')->assertViewIs('admin.dudi.edit');
        $response->assertViewHas('industry');
        $response->assertSuccessful();
    }
    public function test_admin_menambahkan_data_dudi()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->post('dashboard/admin/dudi',[
            'nama' => 'PT Sinar Jaya',
            'alamat' => 'sumenep',
            'kuota' => 4
        ]);

        $dudi = Industry::latest()->get()->first();
        
        $response->assertStatus(302);

        $this->assertEquals('PT Sinar Jaya', $dudi->nama);
        $this->assertEquals('sumenep', $dudi->alamat);
        $this->assertEquals(4, $dudi->kuota);
    }
    public function test_admin_mengubah_data_dudi()
    {
        $user = User::find(1);
        
        $dudi = Industry::latest()->get()->first();

        $response = $this->actingAs($user)->put(route('dudi.update',[
            'dudi' => $dudi->id,
        ]),[
            'nama' => 'PT Sinar Jaya Abadi',
            'alamat' => 'Kota Sumenep',
            'kuota' => 4
        ]);
        
        $update_dudi = Industry::latest()->get()->first();
        $response->assertStatus(302);

        $this->assertEquals('PT Sinar Jaya Abadi', $update_dudi->nama);
        $this->assertEquals('Kota Sumenep', $update_dudi->alamat);
    }
    public function test_admin_menghapus_data_dudi()
    {
        //login sebagai admin
        $user = User::find(1);
        
        $dudi = Industry::latest()->get()->first();

        $response = $this->actingAs($user)->delete(route('dudi.destroy',[
            'dudi' => $dudi->id,
        ]));

        $update_dudi = Industry::latest()->get()->first();
        
        $response->assertStatus(302);

        //memastikan data user telah dihapus
        $this->assertNotEquals('PT Sinar Jaya Abadi', $update_dudi->nama);
    }
}
