@extends('template.app')
 
@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama)
@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Edit DUDI PKL</h3>
    <div class="row">
        <div class="col-md-7">
            <form action="/dashboard/admin/dudi/{{$industry->id}}" method="post">
                @method('put')
                @csrf
                <div class="mb-3">
                <label for="nama" class="form-label">Nama DUDI</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required autofocus value="{{old('nama', $industry->nama)}}">
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>
                <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" required value="{{old('alamat', $industry->alamat)}}">
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>
                <div class="mb-3">
                <label for="kuota" class="form-label">Kuota</label>
                <input type="number" class="form-control @error('kuota') is-invalid @enderror" id="kuota" name="kuota" value="{{old('kuota', $industry->kuota)}}">
                @error('kuota')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/dashboard/admin/dudi" class="btn btn-link">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
