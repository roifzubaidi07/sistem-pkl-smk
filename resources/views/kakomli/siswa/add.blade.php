@extends('template.app')
 
@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama.' ('.strtoupper(Auth::user()->chief[0]->major->abbr).')')
@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Penempatan PKL
        <h5> Nama DUDI: 
                {{$dudi->nama}}
        </h5>
        <h5> Kuota: 
            <p id="kuota" class="d-inline">{{app\Http\Controllers\Controller::cekKuota($dudi->id)}}</p>/{{$dudi->kuota}}
        </h5>
    </h3>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            {{$errors->first()}}
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <form action="/dashboard/kakomli/dudi/{{$dudi->id}}" method="post">
            @csrf
            @method('put')
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Tambah Siswa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <input type="text" name="industry_id" value="{{$dudi->id}}" hidden>
                            <input type="text" name="jumlah" value="{{app\Http\Controllers\Controller::cekKuota($dudi->id)}}" hidden>
                            <input type="text" name="kuota" value="{{$dudi->kuota}}" hidden>
                            <td>{{$student->user->nama}}</td>
                            <td>{{$student->user->no_induk}}</td>
                            <td>{{$student->grade->nama}}</td>
                            <td>
                                <div>
                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel" name="id[]" value="{{$student->id}}" onchange="kuota()">
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Simpan Siswa</button>
            </form>
        </div>
    </div>
</div>

<script>
    
    var kuota_awal = {{app\Http\Controllers\Controller::cekKuota($dudi->id)}}
    var kuota_temp = kuota_awal;
    function kuota(){
        // if (document.getElementById("checkboxNoLabel").checked == true){
        //     kuota_temp += 1;
        //     document.getElementById("kuota").innerHTML = kuota_temp;
        // } else{
        //     kuota_temp -= 1;
        //     document.getElementById("kuota").innerHTML = kuota_temp;
        // }
    }
</script>
@endsection
