@extends('template.app')
 
@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama)
@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Daftar Jurnal 
        <h5> Nama Siswa : 
            {{$student->user->nama}}
        </h5>
    </h3>
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
                        <th>Tanggal</th>
                        <th>Kegiatan</th>
                        <th>Dokumentasi</th>
                        <th>Status</th>
                        <th>Verifikasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jurnals as $jurnal)
                    <tr>
                        <td>{{$jurnal->waktu}}</td>
                        <td>{{$jurnal->kegiatan}}</td>
                        <td>
                            <a class="badge rounded-pill bg-info text-dark text-decoration-none" href="/storage/{{$jurnal->image}}" target="_blank">Lihat dokumentasi</a>
                        </td>
                        <td>
                            @if ($jurnal->verifikasi === 0)
                                <a class="badge rounded-pill bg-danger text-light text-decoration-none disabled">Belum Terverifikasi</a>
                            @else 
                                <a class="badge rounded-pill bg-success text-light text-decoration-none disabled">Sudah terverifikasi</a>                        
                            @endif
                        </td>
                            <td>
                                @if ($jurnal->verifikasi === 0)
                                    <form action="/dashboard/pembimbing/jurnal/{{$jurnal->id}}" method="post">
                                        @method('put')
                                        @csrf
                                        <input type="text" name="student_id" value="{{$jurnal->student_id}}" hidden>
                                        <button type="submit" class="badge rounded-pill bg-info text-dark text-decoration-none border-0" onclick="return confirm('Apakah Anda yakin ingin melakukan verifikasi ?')" name="1">Verifikasi</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
