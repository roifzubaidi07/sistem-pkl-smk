@extends('template.app')
 
@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama.' ('.strtoupper(Auth::user()->chief[0]->major->abbr).')')
@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Daftar Pengajuan DUDI PKL Siswa</h3>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Alasan Pengajuan</th>
                        <th>Nama Pengaju</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($submissions as $submission)
                    <tr>
                        <td>{{$submission->nama}}</td>
                        <td>{{$submission->alamat}}</td>
                        <td>{{$submission->alasan}}</td>
                        <td>{{$submission->student->user->nama}}</td>
                        @if($submission->verifikasi == 0)
                        <td><form action="/dashboard/kakomli/pendataan/{{$submission->id}}" method="post" class="d-inline">
                            @csrf
                            @method('put')
                            <button type="submit" class="badge rounded-pill bg-success text-white text-decoration-none border-0" onclick="return confirm(`Apakah Anda yakin ingin memverifikasi data pengajuan dari siswa {{$submission->student->user->nama}} ?`)">Verifikasi</button>
                        </form>
                        <form action="/dashboard/kakomli/pendataan/{{$submission->id}}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="badge rounded-pill bg-danger text-white text-decoration-none border-0" onclick="return confirm(`Apakah Anda yakin ingin menghapus data pengajuan dari siswa {{$submission->student->user->nama}} ?`)">Hapus</button>
                        </form></td>
                        @else
                        <td><a class="badge rounded-pill bg-success text-white text-decoration-none disabled" >Terverifikasi</a></td>
                        @endif
                    </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
