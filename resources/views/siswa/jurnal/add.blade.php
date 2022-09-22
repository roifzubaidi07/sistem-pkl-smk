@extends('template.app')
 
@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama)
@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Tambah Jurnal</h3>
    <form action="/dashboard/siswa/jurnal" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                @csrf
                <div class="mb-3">
                    <label for="kegiatan" class="form-label">Kegiatan</label>
                    <textarea class="form-control @error('kegiatan') is-invalid @enderror" id="kegiatan" name="kegiatan" rows="3" autofocus>{{old('kegiatan')}}</textarea>
                    @error('kegiatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="dokumentasi">Unggah Dokumentasi<sub>(file tidak melebihi 2 MB)</sub></label>
                    <input type="file" class="form-control @error('dokumentasi') is-invalid @enderror" id="dokumentasi" name="dokumentasi" accept="image/*">
                    @error('dokumentasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                  <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection
