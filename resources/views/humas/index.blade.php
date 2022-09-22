@extends('template.app')
 
@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama)
@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Daftar Siswa PKL</h3>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card-body">
        <p class="mb-0">
            Halaman ini adalah halaman untuk menampilkan daftar siswa. Dalam halaman ini, Anda akan disajikan tabel daftar siswa yang sedang melaksanakan PKL beserta informasi DUDI dan guru pembimbing dari masing-masing siswa.
        </p>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>DUDI</th>
                        <th>Pembimbing</th>
                        <th>Laporan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr>
                        <td>{{$student->user->nama}}</td>
                        <td>{{$student->user->no_induk}}</td>
                        <td>{{$student->grade->nama}}</td>
                        <td>{{$student->grade->major->nama}}</td>
                        <td>{{$student->industry ? $student->industry->nama : '-' }}</td>
                        <td>{{$student->mentor ? $student->mentor->user->nama : '-'}}</td>
                        @if($student->file_laporan != null)
                        <td><a class="badge rounded-pill bg-primary text-light text-decoration-none d-inline" href="\storage\{{$student->file_laporan}}" target="_blank">Lihat Laporan</a></td>
                        @else
                        <td>-</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="/dashboard/humas/edit" class="btn btn-primary align-self-end">Edit Pembimbing</a>
        </div>
    </div>
</div>
@endsection
