<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\IndustrySubmissionController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');//Login
Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');//Login
Route::post('/register', [RegisterController::class, 'authenticate'])->name('register')->middleware('guest');//Registrasi
Route::post('/login', [LoginController::class, 'authenticate']);//Login
Route::post('/logout', [LoginController::class, 'logout']);//Logout
Route::get('/dashboard', [PageController::class, 'index'])->middleware('auth');//autentikasi

Route::middleware(['auth', 'level:1'])->group(function () {
    Route::get('dashboard/admin', [PageController::class, 'admin']);
    Route::resource('dashboard/admin/pengguna',UserController::class);
    Route::resource('dashboard/admin/dudi',IndustryController::class);
});
Route::middleware(['auth', 'level:2'])->group(function () {
    Route::get('dashboard/humas', [StudentController::class, 'getSiswa']);
    Route::get('dashboard/humas/dudi', [IndustryController::class, 'getIndustries']);
    Route::get('dashboard/humas/dudi/{id}', [IndustryController::class, 'getIndustry']);
    Route::get('dashboard/humas/pembimbing', [MentorController::class, 'getPembimbing']);
    Route::get('dashboard/humas/edit', [StudentController::class, 'showEditPembimbingSiswa']);
    Route::put('dashboard/humas/edit', [StudentController::class, 'EditPembimbingSiswa'])->name('editPembimbingSiswa');
    Route::get('dashboard/humas/berkas', [FileController::class, 'getBerkasHumas']);
    Route::get('dashboard/humas/berkas/{id}', [FileController::class, 'getBerkasPKL'])->name('getBerkasPKLHumas');
});
Route::middleware(['auth', 'level:3'])->group(function () {
    Route::get('dashboard/kakomli', [IndustryController::class, 'getDudiJurusan']);
    Route::get('dashboard/kakomli/dudi/{id}', [StudentController::class, 'getSiswaDudi'])->name('getSiswaDudi');
    Route::put('dashboard/kakomli/dudi/{id}', [StudentController::class, 'setSiswaDudi'])->name('setSiswaDudi');
    Route::delete('dashboard/kakomli/dudi/{id}', [StudentController::class, 'deleteSiswaDudi'])->name('deleteSiswaDudi');
    Route::get('/dashboard/kakomli/dudi/{id}/tambah', [StudentController::class, 'getSiswaJurusan']);
    Route::put('dashboard/kakomli/pendataan/{id}', [IndustrySubmissionController::class, 'verifikasiPendataan'])->name('verifikasiPendataan');
    Route::delete('dashboard/kakomli/pendataan/{id}', [IndustrySubmissionController::class, 'hapusPendataan'])->name('hapusPendataan');
    Route::resource('dashboard/kakomli/pendataan',IndustrySubmissionController::class)->only(['index','destroy']);
});
Route::middleware(['auth', 'level:4'])->group(function () {
    Route::get('dashboard/pembimbing', [StudentController::class, 'getSiswaBimbingan']);
    Route::get('dashboard/pembimbing/presensi', [AttendenceController::class, 'show_attendences'])->name('pembimbing.presensi');;
    Route::put('dashboard/pembimbing/presensi/{id}', [AttendenceController::class, 'store_validation'])->name('presensi.store_validation');
    Route::get('dashboard/pembimbing/jurnal', [JurnalController::class, 'show_students'])->name('jurnal_siswa');
    Route::get('dashboard/pembimbing/jurnal/{id}', [JurnalController::class, 'show_jurnals'])->name('pembimbing.jurnal');
    Route::put('dashboard/pembimbing/jurnal/{id}', [JurnalController::class, 'store_validation'])->name('jurnal.store_validation');
    Route::get('dashboard/pembimbing/berkas', [FileController::class, 'getBerkasPembimbing']);
    Route::get('dashboard/pembimbing/berkas/{id}', [FileController::class, 'getBerkasPKL'])->name('getBerkasPKLPembimbing');
    Route::put('dashboard/pembimbing/berkas/bimbingan', [FileController::class, 'UploadBerkasBimbingan'])->name('UploadBerkasBimbingan');
    Route::put('/dashboard/pembimbing/sertifikat', [FileController::class, 'UploadSertifikatSiswa'])->name('UploadSertifikatSiswa');
});
Route::middleware(['auth', 'level:5'])->group(function () {
    Route::get('dashboard/siswa', [StudentController::class, 'getInfoSiswa']);
    // Route::get('/dashboard/siswa/dudi', [IndustrySubmissionController::class, 'tambahDudiSiswa']);
    Route::get('/dashboard/siswa/laporan', [FileController::class, 'getBerkasLaporanSiswa']);
    Route::get('/dashboard/siswa/berkas/{id}', [FileController::class, 'getBerkasPKL']);
    Route::put('/dashboard/siswa/laporan', [FileController::class, 'UploadBerkasLaporanSiswa'])->name('UploadBerkasLaporanSiswa');
    Route::resource('dashboard/siswa/dudi',IndustrySubmissionController::class, ['as' => 'industrysubmission'])->except(['index','destroy']);
    Route::resource('dashboard/siswa/jurnal',JurnalController::class);
    Route::resource('dashboard/siswa/presensi',AttendenceController::class);
});