@extends('template.app')
 
@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama)
@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Daftar Siswa Bimbingan</h3>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @error('sertifikat')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
    <div class="card mb-4">
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>DUDI</th>
                        <th>Sertifikat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr>
                        <td>{{$student->user->nama}}</td>
                        <td>{{$student->user->no_induk}}</td>
                        <td>{{$student->grade->nama}}</td>
                        <td>{{$student->industry ? $student->industry->nama : '-' }}</td>
                        @if($student->sertifikat == null)
                        <td><form action="/dashboard/pembimbing/sertifikat" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="input-group input-group-sm">
                                <input type="hidden" name="id" value="{{$student->id}}">
                                <input type="file" id="unggah_laporan" class="form-control @error('sertifikat') is-invalid @enderror" id="file" name="sertifikat" accept="application/pdf">
                                <button type="submit" class="btn btn-primary">Unggah</button>
                            </div>
                        </form></td>
                        @else
                        <td>
                            <a class="badge rounded-pill bg-success text-light text-decoration-none disabled">File sudah diunggah</a>
                            <a class="badge rounded-pill bg-light text-dark text-decoration-none" href="/storage/{{$student->sertifikat}}" target="_blank">Lihat File</a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
