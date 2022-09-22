@extends('template.app')
 
@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama)
@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Daftar Berkas Pembimbing</h3>
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
                        <th>Unggah File</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($files as $file)
                    <tr>
                        <td>{{$file->name}}</td>
                        <td><a class="badge rounded-pill bg-primary text-light text-decoration-none" href="/dashboard/pembimbing/berkas/{{$file->id}}">Unduh</a></td>
                        @if($file->is_pembimbing == false)
                            <td>-</td>
                            <td>-</td>
                        @else    
                        @if($pembimbing->file_bimbingan === null)
                            <td>
                                <form action="/dashboard/pembimbing/berkas/bimbingan" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                    <div class="input-group input-group-sm">
                                        <input type="file" id="unggah_laporan" class="form-control @error('file_bimbingan') is-invalid @enderror" id="file" name="file_bimbingan" accept="application/pdf">
                                        <button type="submit" class="btn btn-primary">Unggah</button>
                                    </div>
                                </form>
                            </td>
                                @else
                            <td>
                                <a class="badge rounded-pill bg-success text-light text-decoration-none disabled">File sudah diunggah</a>
                                <a class="badge rounded-pill bg-light text-dark text-decoration-none" href="\storage\{{$pembimbing->file_bimbingan}}" target="_blank">Lihat File</a>
                            </td>
                        @endif
                        <td>
                            @if($pembimbing->file_bimbingan === null)
                            <a class="badge rounded-pill bg-danger text-light text-decoration-none disabled">File Belum Diunggah</a>
                            @else
                            <a class="badge rounded-pill bg-success text-light text-decoration-none disabled">Terunggah</a>
                            @endif
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
