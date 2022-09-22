@extends('template.app')
 
@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama)

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Daftar Pengguna Sistem
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>No Induk</th>
                        <th>No Telfon</th>
                        <th>Alamat</th>
                        <th>Level Pengguna</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->nama}}</td>
                        <td>{{$user->no_induk}}</td>
                        <td>{{$user->no_telp}}</td>
                        <td>{{$user->alamat}}</td>
                        <td>{{$user->level->nama}}</td>
                        <td>
                            <a class="badge rounded-pill bg-success text-light text-decoration-none" href="/dashboard/admin/pengguna/{{$user->id}}/edit">Edit</a>
                            @if($user->level_id != 1)
                                <form action="/dashboard/admin/pengguna/{{$user->id}}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="badge rounded-pill bg-danger text-white text-decoration-none border-0" onclick="return confirm(`Apakah Anda yakin ingin menghapus {{$user->nama}} dari database ?`)">Hapus</button>
                                </form>
                            @endif
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="/dashboard/admin/pengguna/create" class="btn btn-primary">Tambah Pengguna</a>
        </div>
    </div>
</div>
@endsection
