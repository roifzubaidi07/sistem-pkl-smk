@extends('template.app')
 
@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama)
@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Laporan PKL</h3>
    <div class="card mb-3">
        <div class="card-body">
          <p class="mb-0">
              Pada halaman ini, Anda dapat melakukan pengunduhan dan pengunggahan berkas laporan PKL. Laporan dapat diunggah apabila Anda telah menyelesaikan semua tanda tangan pada lembar pengesahan. Anda hanya bisa melakukan satu kali pengunggahan, jadi mohon untuk diperhatikan kembali laporan yang akan Anda unggah.
          </p>
        </div>
      </div>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @error('file_laporan')
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
                    <tr>
                        <td>{{$template->name}}</td>
                        <td><a class="badge rounded-pill bg-primary text-light text-decoration-none" href="/dashboard/siswa/berkas/{{$template->id}}">Unduh</a></td>                        
                        <td>
                        @if(Auth::user()->student[0]->file_laporan === null)
                        <form action="/dashboard/siswa/laporan" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="input-group input-group-sm">
                                <input type="file" id="unggah_laporan" class="form-control @error('file_laporan') is-invalid @enderror" id="file" name="file_laporan" accept="application/pdf">
                                <button type="submit" class="btn btn-primary">Unggah</button>
                            </div>
                        </form>
                        @else
                            <a class="badge rounded-pill bg-success text-light text-decoration-none disabled">File sudah diunggah</a>
                            <a class="badge rounded-pill bg-light text-dark text-decoration-none" href="/storage/{{Auth::user()->student[0]->file_laporan}}" target="_blank">Lihat File</a>
                        @endif
                        </td>
                        <td>
                        @if(Auth::user()->student[0]->file_laporan === null)
                            <a class="badge rounded-pill bg-danger text-light text-decoration-none disabled">File Belum Diunggah</a>
                            @else
                            <a class="badge rounded-pill bg-success text-light text-decoration-none disabled">Terunggah</a>
                        @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
