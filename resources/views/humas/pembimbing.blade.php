@extends('template.app')
 
@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama)
@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Daftar Pembimbing PKL</h3>

    
    <div class="card mb-4">
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Jurusan</th>
                        <th>Laporan Bimbingan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mentors as $mentor)
                    <tr>
                        <td>{{$mentor->user->nama}}</td>
                        <td>{{$mentor->user->no_induk}}</td>
                        <td>{{$mentor->major->nama}}</td>
                        @if($mentor->file_bimbingan != null)
                        <td><a class="badge rounded-pill bg-primary text-light text-decoration-none d-inline" href="\storage\{{$mentor->file_bimbingan}}" target="_blank">Lihat Laporan</a></td>
                        @else
                        <td>-</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
