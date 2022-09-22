@extends('template.app')
 
@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama.' ('.strtoupper(Auth::user()->chief[0]->major->abbr).')')
@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Penempatan PKL 
        <h5> Nama DUDI: 
                {{$dudi->nama}}
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
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{$student->user->nama}}</td>
                            <td>{{$student->user->no_induk}}</td>
                            <td>{{$student->grade->nama}}</td>
                            <td>
                                @if(Auth::user()->chief[0]->major->abbr == $student->grade->major->abbr)
                                <form action="/dashboard/kakomli/dudi/{{$student->id}}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <input type="text" name="industry_id" value="{{$dudi->id}}" hidden>
                                    <button type="submit" class="badge rounded-pill bg-danger text-white text-decoration-none border-0" onclick="return confirm(`Apakah Anda yakin ingin menghapus {{$student->user->nama}} dari DUDI {{$dudi->nama}} ?`)">Hapus</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($dudi->kuota != null)
            <a href="/dashboard/kakomli/dudi/{{$dudi->id}}/tambah" class="btn btn-primary">Tambah Siswa</a>
            @endif
            <a href="/dashboard/kakomli" class="btn btn-link">Kembali</a>
        </div>
    </div>
</div>
@endsection
