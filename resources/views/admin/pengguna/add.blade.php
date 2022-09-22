@extends('template.app')
 
@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama)
@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Tambah Pengguna</h3>
    <form action="/dashboard/admin/pengguna" method="post">
        <div class="row">
            <div class="col-md-6">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required autofocus value="{{old('nama')}}">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="no_induk" class="form-label">No Induk</label>
                    <input type="text" class="form-control @error('no_induk') is-invalid @enderror" id="no_induk" name="no_induk" required value="{{old('no_induk')}}">
                    @error('no_induk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required value="{{old('password')}}">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="no_telp" class="form-label">No Telepon</label>
                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp" required autofocus value="{{old('no_telp')}}">
                    @error('no_telp')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" required autofocus value="{{old('alamat')}}">
                    @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="level" class="form-label">Level Pengguna</label>
                    <select class="form-select" name="level_id" id="level">
                        @foreach ($levels as $level)
                            <option value="{{$level->id}}">{{$level->nama}}</option>
                        @endforeach
                    </select>
                    @error('level')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3" id="major" style="display: none">
                    <label for="major" class="form-label">Jurusan</label>
                    <select class="form-select" name="major_id">
                        @foreach ($majors as $major)
                            <option value="{{$major->id}}">{{$major->nama}}</option>
                        @endforeach
                    </select>
                    @error('grade')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3" id="grade" style="display: none">
                    <label for="grade" class="form-label">Kelas</label>
                    <select class="form-select" name="grade_id">
                        @foreach ($grades as $grade)
                            <option value="{{$grade->id}}">{{$grade->nama}}</option>
                        @endforeach
                    </select>
                    @error('grade')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary align-self-end">Simpan</button>
            </div>
        </div>
    </form>
</div>

<script>
    const level = document.querySelector('#level');
    const grade = document.querySelector('#grade');

    level.addEventListener('change', function(){
        if(level.value == 3 || level.value == 4){
            major.style.display = "block";
            grade.style.display = "none";
        }
        else if(level.value == 5){
            major.style.display = "none";
            grade.style.display = "block";
        }else{
            major.style.display = "none";
            grade.style.display = "none";
        }
    })
</script>
@endsection
