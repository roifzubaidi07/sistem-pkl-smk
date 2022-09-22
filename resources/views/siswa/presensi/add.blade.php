@extends('template.app')
 
@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama)
@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Tambah Presensi</h3>
    <form action="/dashboard/siswa/jurnal" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                @csrf
                <div class="mb-3">
                    <label for="date" class="form-label">Tanggal</label>
                    <input class="form-control @error('date') is-invalid @enderror" type="date" id="date" name="date" rows="3" autofocus value="{{old('date')}}">
                    @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="appt">Jam Kedatangan:</label>
                    <input type="time" id="appt" name="appt">
                </div>
                <div class="mb-3">
                    <label for="appt">Jam Pulang:</label>
                    <input type="time" id="appt" name="appt">
                </div>
                  <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection
