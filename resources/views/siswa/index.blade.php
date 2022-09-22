@extends('template.app')

@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama)
@section('content')
<div class="container">
  @if (session('status'))
      <div class="alert alert-success mt-3">
          {{ session('status') }}
      </div>
  @endif
  <div class="row">
    <div class="col-md-3">
      <div class="card mt-3" style="width: 16rem;">
        <img src="{{ url('assets/img/default.png') }}" class="card-img-top rounded" alt="Profil">
        <div class="card-body">
          <h5 class="card-title">{{$student->user->nama}}</h5>
          <h6 class="card-subtitle mb-2 text-muted">Kelas: {{$student->grade->nama}}</h6>
          <h6 class="card-subtitle mb-2 text-muted">Guru Pembimbing: {{$student->mentor ? $student->mentor->user->nama : "-"}}</h6>
          <h6 class="card-subtitle mb-2 text-muted">Tempat DUDI: {{$student->industry ? $student->industry->nama : "-"}}</h6>
        </div>
      </div>
    </div>
    <div class="col m-3">
      <h3>Selamat Datang, {{Auth::user()->nama}}</h3>
      <div class="card mb-3">
        <div class="card-body">
          <p class="mb-0">
              Selamat Datang di sistem informasi PKL SMK Negeri 1 Sumenep. Pada sistem ini Anda dapat melakukan pengelolaan data PKL. Segala kegiatan PKL di SMK Negeri 1 Sumenep diintegrasikan dalam sistem ini untuk memudahkan Anda dalam melaksanakan kegiatan PKL.
          </p>
        </div>
      </div>
      @if($industrySubmission == null)
      <div class="card">
        <div class="card-header">
          Informasi DUDI PKL
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <p>Anda dialokasikan ke DUDI {{$student->industry ? $student->industry->nama : "-"}}, Anda dapat mengajukan DUDI sendiri dengan menekan tombol "Ajukan DUDI"
            </p>
            <a href="/dashboard/siswa/dudi/create" class="btn btn-primary">Ajukan DUDI</a>
          </blockquote>
        </div>
      </div>
      @else
      <div class="card">
        <div class="card-header">
          Informasi DUDI PKL
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <p>Anda mengajukan DUDI {{$industrySubmission->nama}}, status verifikasi Anda saat ini adalah @if($industrySubmission->verifikasi == 0) <b style="color: red">menunggu persetujuan kakomli </b> @else <b style="color: green"> diterima </b>@endif
            </p>
          </blockquote>
        </div>
      </div>
      @endif
      @if($student->sertifikat != null)
      <div class="card mt-3">
        <div class="card-header">
          Sertifikat PKL
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <p>Anda dapat mengakses sertifikat PKL Anda <a class="d-inline" href="\storage\{{$student->sertifikat}}" target="_blank">disini</a>
            </p>
          </blockquote>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
