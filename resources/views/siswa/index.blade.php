@extends('template.app')
 
@section('nama', "M. Ro'if")
@section('status', 'Siswa')
@section('sidebar')
    <a class="nav-link" href="index.blade.php">
        <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
        Pendaftaran
    </a>
    <a class="nav-link" href="index.blade.php">
        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
        Presensi
    </a>
    <a class="nav-link" href="index.blade.php">
        <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
        Jurnal Harian
    </a>
    <a class="nav-link" href="index.blade.php">
        <div class="sb-nav-link-icon"><i class="fas fa-books"></i></div>
        Logbook
    </a>
    <a class="nav-link" href="index.blade.php">
        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
        Sertifikat
    </a>
@endsection
