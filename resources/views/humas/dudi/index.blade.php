@extends('template.app')
 
@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama)
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
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($industries as $industry)
                    <tr>
                        <td>{{$industry->nama}}</td>
                        <td>{{$industry->alamat}}</td>
                        <td>{{app\Http\Controllers\IndustryController::cekKuota($industry->id)}}/{{$industry->kuota}}</td>
                        <td>
                            <a href="/dashboard/humas/dudi/{{$industry->id}}" class="badge rounded-pill bg-info text-dark text-decoration-none">info</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
