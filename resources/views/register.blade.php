<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Halaman Registrasi</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <link rel="shortcut icon" href="{{ url('assets/img/icon.jpg') }}"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-images">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Masukkan identitas Anda</h3></div>
                                    <div class="card-body">
                                        @if (session('status'))
                                            <div class="alert alert-success">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        @error('error')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <form method="post" action="/register">
                                            @csrf
                                            <div class="form-floating mb-3">
                                                <input class="form-control @error('nama') is-invalid @enderror" id="nama" type="text" name="nama" placeholder="Masukkan no induk Anda..." value="{{old('nama')}}"/>
                                                <label for="nama">Nama</label>
                                                @error('nama')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control @error('no_induk') is-invalid @enderror" id="no_induk" type="text" name="no_induk" placeholder="Masukkan no induk Anda..." value="{{old('no_induk')}}"/>
                                                <label for="no_induk">Nomer Induk</label>
                                                @error('no_induk')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" type="text" name="no_telp" placeholder="Masukkan no induk Anda..." value="{{old('no_telp')}}"/>
                                                <label for="no_telp">Nomer Telepon</label>
                                                @error('no_telp')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control @error('alamat') is-invalid @enderror" id="alamat" type="text" name="alamat" placeholder="Masukkan no induk Anda..." value="{{old('alamat')}}"/>
                                                <label for="alamat">Alamat</label>
                                                @error('alamat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <select class="form-select" name="grade_id">
                                                    <option value="">Kelas</option>
                                                    @foreach ($grades as $grade)
                                                        <option value="{{$grade->id}}">{{$grade->nama}}</option>
                                                    @endforeach
                                                </select>
                                                @error('grade')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control @error('password') is-invalid @enderror" name="password" id="Password" type="password" placeholder="Masukkan Password Anda..." />
                                                <label for="Password">Password</label>
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button type="submit" class="btn btn-primary" >Register</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="/">Sudah memiliki akun ? Login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
