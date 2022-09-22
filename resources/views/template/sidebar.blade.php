<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    @if(auth()->user()->level->url === 'admin')
                    <a class="nav-link {{($title === 'daftar-pengguna') ? 'active' : ''}}" href="/dashboard/admin">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Daftar Pengguna
                    </a>
                    <a class="nav-link {{($title === 'daftar-dudi') ? 'active' : ''}}" href="/dashboard/admin/dudi">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Data DUDI
                    </a>
                    @elseif(auth()->user()->level->url === 'humas')
                    <a class="nav-link {{($title === 'daftar-siswa') ? 'active' : ''}}" href="/dashboard/humas">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Daftar Siswa
                    </a>
                    <a class="nav-link {{($title === 'daftar-pembimbing') ? 'active' : ''}}" href="/dashboard/humas/pembimbing">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Daftar Pembimbing
                    </a>
                    <a class="nav-link {{($title === 'daftar-dudi') ? 'active' : ''}}" href="/dashboard/humas/dudi">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Data DUDI
                    </a>
                    <a class="nav-link {{($title === 'berkas') ? 'active' : ''}}" href="/dashboard/humas/berkas">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Berkas PKL
                    </a>
                    @elseif(auth()->user()->level->url === 'pembimbing')
                    <a class="nav-link {{($title === 'daftar-siswa') ? 'active' : ''}}" href="/dashboard/pembimbing">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Daftar Siswa
                    </a>
                    <a class="nav-link {{($title === 'jurnal') ? 'active' : ''}}" href="/dashboard/pembimbing/jurnal">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Jurnal Harian Siswa
                    </a>
                    <a class="nav-link {{($title === 'presensi') ? 'active' : ''}}" href="/dashboard/pembimbing/presensi">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Presensi Siswa
                    </a>
                    <a class="nav-link {{($title === 'berkas') ? 'active' : ''}}" href="/dashboard/pembimbing/berkas">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Berkas PKL
                    </a>
                    @elseif(auth()->user()->level->url === 'kakomli')
                    <a class="nav-link {{($title === 'penempatan') ? 'active' : ''}}" href="/dashboard/kakomli">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Penempatan DUDI
                    </a>
                    <a class="nav-link {{($title === 'pendataan') ? 'active' : ''}}" href="/dashboard/kakomli/pendataan">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Pendataan DUDI
                    </a>
                    @elseif(auth()->user()->level->url === 'siswa')
                    <a class="nav-link {{($title === 'dashboard') ? 'active' : ''}}" href="/dashboard/siswa">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link {{($title === 'presensi') ? 'active' : ''}}" href="/dashboard/siswa/presensi">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Presensi Online
                    </a>
                    <a class="nav-link {{($title === 'jurnal') ? 'active' : ''}}" href="/dashboard/siswa/jurnal">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Jurnal Harian
                    </a>
                    <a class="nav-link {{($title === 'laporan') ? 'active' : ''}}" href="/dashboard/siswa/laporan">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Laporan PKL
                    </a>
                    @endif
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Anda masuk sebagai:</div>
                @yield('nama')
            </div>
        </nav>
    </div>