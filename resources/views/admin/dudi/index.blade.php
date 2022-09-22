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
                            <a href="/dashboard/admin/dudi/{{$industry->id}}/edit" class="badge rounded-pill bg-primary text-white text-decoration-none">Edit</a>
                            <form action="/dashboard/admin/dudi/{{$industry->id}}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="badge rounded-pill bg-danger text-white text-decoration-none border-0" onclick="return confirm('Apakah Anda yakin ingin menghapus {{$industry->nama}} dari database ?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="/dashboard/admin/dudi/create" class="btn btn-primary">Tambah DUDI</a>
        </div>
    </div>
</div>
@endsection
