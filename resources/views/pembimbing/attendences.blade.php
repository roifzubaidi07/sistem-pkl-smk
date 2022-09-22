@extends('template.app')
 
@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama)
@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Daftar Presensi Siswa Bimbingan</h3>
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
                        <th>Tanggal</th>
                        <th>Jam Datang</th>
                        <th>Jam Pulang</th>
                        <th>Status</th>
                        <th>Status Verifikasi</th>
                        <th>Verifikasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendences as $attendance)
                    <tr>
                        <td>{{$attendance->student->user->nama}}</td>
                        <td>{{$attendance->tanggal}}</td>
                        <td>{{$attendance->jam_datang}}</td>
                        <td>{{$attendance->jam_pulang}}</td>
                        <td>
                            @switch($attendance->status)
                                @case(1)
                                    Hadir
                                    @break
                                @case(2)
                                    Sakit
                                    @break
                                @case(3)
                                    Izin
                                    @break
                                @default
                                    Alpha
                            @endswitch
                        </td>
                        <td>
                        @if ($attendance->verifikasi === 0)
                            <a class="badge rounded-pill bg-danger text-light text-decoration-none disabled">Belum Terverifikasi</a>
                        @else 
                            <a class="badge rounded-pill bg-success text-light text-decoration-none disabled">Sudah terverifikasi</a>                        
                        @endif</td>
                        <td>
                            @if ($attendance->verifikasi === 0)
                                <form action="/dashboard/pembimbing/presensi/{{$attendance->id}}" method="post">
                                    @method('put')
                                    @csrf
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
