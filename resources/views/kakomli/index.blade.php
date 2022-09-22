@extends('template.app')
 
@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama.' ('.strtoupper(Auth::user()->chief[0]->major->abbr).')')
@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Daftar DUDI PKL</h3>
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
                        <th>Alamat</th>
                        <th>Kuota</th>
                        <th>Info</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($industries as $industry)
                    <tr>
                        <td>{{$industry->nama}}</td>
                        <td>{{$industry->alamat}}</td>
                        @if($industry->kuota != null)
                        <td>{{app\Http\Controllers\Controller::cekKuota($industry->id)}}/{{$industry->kuota}}</td>
                        @else
                        <td>-</td>
                        @endif
                        <td><a class="badge rounded-pill bg-info text-dark text-decoration-none" href="/dashboard/kakomli/dudi/{{$industry->id}}">Info</a></td>
                    </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
