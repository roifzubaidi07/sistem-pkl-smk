@extends('template.app')
 
@section('nama', Auth::user()->nama)
@section('status', Auth::user()->level->nama)
@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Info {{$industry->nama}}</h3>
    <div class="row">
        <div class="col-md-7">
            <div class="card" style="">
                <div class="card-body">
                  <h5 class="card-title">{{$industry->nama}}</h5>
                  <h6 class="card-subtitle mb-2 text-muted">{{$industry->alamat}} | Kuota: {{$industry->kuota}}</h6>
                  <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro, repellendus! Facere consequatur, laudantium numquam nobis illo animi inventore? Aspernatur dignissimos consectetur obcaecati! Ipsam dolor accusamus illo voluptatem dolorem inventore quasi.</p>
                  <a href="/dashboard/admin/dudi/{{$industry->id}}/edit" class="card-link">Edit Data</a>
                  <a href="/dashboard/admin/dudi" class="card-link">Kembali</a>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection
