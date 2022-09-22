@extends('template.app')
 
@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama)
@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Sertifikat PKL</h3>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @error('file_bimbingan')
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
                        <th>Unduh File</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($files as $file)
                    <tr>
                        <td>{{$file->name}}</td>
                        <td><a class="badge rounded-pill bg-primary text-light text-decoration-none" href="/dashboard/pembimbing/berkas/{{$file->id}}">Unduh</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
