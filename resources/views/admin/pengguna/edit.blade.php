@extends('template.app')
 
@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama)
@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Edit Pengguna</h3>
    <form action="/dashboard/admin/pengguna/{{$user->id}}" method="post">
        <div class="row">
            <div class="col-md-6">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required autofocus value="{{old('nama', $user->nama)}}">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="no_induk" class="form-label">No Induk</label>
                    <input type="text" class="form-control @error('no_induk') is-invalid @enderror" id="no_induk" name="no_induk" required value="{{old('no_induk', $user->no_induk)}}">
                    @error('no_induk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="no_telp" class="form-label">No Telpon</label>
                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp" required autofocus value="{{old('no_telp', $user->no_telp)}}">
                    @error('no_telp')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" required autofocus value="{{old('alamat', $user->alamat)}}">
                    @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <input type="hidden" name="level_id" value="{{$user->level_id}}" id="level">
                <div class="mb-3" id="major" style="display: none">
                    <label for="major" class="form-label @error('major_id') is-invalid @enderror">Jurusan</label>
                    <select class="form-select" name="major_id">
                        @foreach ($majors as $major)
                            @if(old('major_id', $user_major == $major->id))
                                <option value="{{$major->id}}" selected>{{$major->nama}}</option>
                            @else
                                <option value="{{$major->id}}">{{$major->nama}}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('major')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3" id="grade" style="display: none">
                    <label for="grade" class="form-label @error('grade_id') is-invalid @enderror">Kelas</label>
                    <select class="form-select" name="grade_id">
                        @foreach ($grades as $grade)
                            @if(old('grade_id', $user_grade == $grade->id))
                                <option value="{{$grade->id}}" selected>{{$grade->nama}}</option>
                            @else
                                <option value="{{$grade->id}}">{{$grade->nama}}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('grade')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary align-self-end">Simpan</button>
                <a type="button" class="btn btn-link align-self-end" href="/dashboard/admin/pengguna">Batal</a>
            </div>
        </div>
    </form>
</div>

<script>
    const level = document.querySelector('#level');
    const grade = document.querySelector('#grade');


    // $(document).ready(function(){
    //     $('#level').change(function(){
    //         if($(this).val()==5) {
    //             $("#grade").show();
    //         }
    //         else {
    //             $("#grade").hide();
    //         }
    //     });
    // });

    window.addEventListener('load', (event) => {
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
