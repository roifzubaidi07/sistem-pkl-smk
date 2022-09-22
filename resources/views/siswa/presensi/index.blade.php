@extends('template.app')
 
@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama)
@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Daftar Presensi Anda</h3>
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
                        <th>Jam Datang</th>
                        <th>Jam Pulang</th>
                        <th>Status</th>
                        <th>Status Verifikasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendences as $attendance)
                    <tr>
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
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#presensi">
                Tambah Presensi
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="presensi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Presensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="/dashboard/siswa/presensi" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal">
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="jam_datang" class="form-label">Jam Datang</label>
                                <input type="time" class="form-control @error('jam_datang') is-invalid @enderror" name="jam_datang" id="jam_datang">
                                @error('jam_datang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="jam_pulang" class="form-label">Jam Pulang</label>
                                <input type="time" class="form-control @error('jam_pulang') is-invalid @enderror" name="jam_pulang" id="jam_pulang">
                                @error('jam_pulang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status Kehadiran</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                                    <option value="1">Hadir</option>
                                    <option value="2">Sakit</option>
                                    <option value="3">Izin</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
