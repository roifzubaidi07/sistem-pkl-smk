@extends('template.app')
 
@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama)
@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Daftar Siswa PKL</h3>
    <div class="card mb-4">
        <div class="card-body">
            <form action="/dashboard/humas/edit" method="post">
                @csrf
                @method('put')
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <th>DUDI</th>
                            <th>Pembimbing</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                        <tr>
                            <input name="id[]" value="{{$student->id}}" hidden>
                            <td>{{$student->id}}</td>
                            <td>{{$student->user->nama}}</td>
                            <td>{{$student->user->no_induk}}</td>
                            <td>{{$student->grade->nama}}</td>
                            <td>{{$student->industry ? $student->industry->nama : '-' }}</td>
                            <td>
                                <select class="form-select" aria-label="Default select example" name="mentor_id[]">
                                    <option value="">-</option>
                                    @foreach($mentors as $mentor)
                                        @if($mentor->major_id == $student->grade->major_id)
                                            @if(old('mentor_id', $mentor->id == $student->mentor_id))
                                                <option value="{{$mentor->id}}" selected>{{$mentor->user->nama}}</option>
                                            @else
                                                <option value="{{$mentor->id}}">{{$mentor->user->nama}}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary align-self-end">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
