# Sistem Informasi Praktik Kerja Lapangan (PKL) SMK

Aplikasi web untuk mengelola seluruh siklus kegiatan **Praktik Kerja Lapangan (PKL)** di Sekolah Menengah Kejuruan (SMK) — mulai dari pendataan siswa, penempatan ke DUDI (Dunia Usaha / Dunia Industri), presensi harian, jurnal kegiatan, hingga pengumpulan laporan dan sertifikat.

Proyek ini dibangun sebagai sampel sistem untuk keperluan **skripsi**.

> Status: Sampel akademik. Data seeder berisi data dummy dan bukan data produksi.

---

## Daftar Isi

- [Fitur Utama](#fitur-utama)
- [Role Pengguna & Hak Akses](#role-pengguna--hak-akses)
- [Arsitektur & Teknologi](#arsitektur--teknologi)
- [Struktur Direktori](#struktur-direktori)
- [Model & Relasi Data](#model--relasi-data)
- [Instalasi & Menjalankan Lokal](#instalasi--menjalankan-lokal)
- [Akun Sampel](#akun-sampel)
- [Deployment (Vercel)](#deployment-vercel)
- [Lisensi](#lisensi)

---

## Fitur Utama

- **Autentikasi berbasis nomor induk** (NIS/NIP/NIK sekolah) dengan 5 level role.
- **Manajemen pengguna** oleh admin (siswa, guru pembimbing, kakomli, humas).
- **Manajemen DUDI** (perusahaan tempat PKL) termasuk kuota per-DUDI.
- **Pengajuan DUDI mandiri oleh siswa** beserta alur verifikasi oleh Kakomli.
- **Penempatan siswa ke DUDI** oleh Kakomli sesuai jurusan (dengan validasi kuota).
- **Pembimbingan**: siswa dialokasikan ke guru pembimbing oleh Humas.
- **Presensi harian** siswa + verifikasi oleh guru pembimbing.
- **Jurnal kegiatan harian** siswa beserta dokumentasi foto + verifikasi pembimbing.
- **Manajemen berkas PKL**: upload laporan siswa (PDF), berkas bimbingan, dan sertifikat.
- **Role-based access control** via middleware `level` yang memfilter akses per-URL.

## Role Pengguna & Hak Akses

Level (`levels` table) digunakan oleh middleware `CekLevel` (`app/Http/Middleware/CekLevel.php`) untuk membatasi akses rute. Setiap pengguna memiliki `level_id` dengan nilai sebagai berikut:

| `level_id` | Role | Dashboard URL | Ringkasan Hak Akses |
|---|---|---|---|
| 1 | **Admin** | `/dashboard/admin` | CRUD pengguna & CRUD data DUDI. |
| 2 | **Humas** | `/dashboard/humas` | Lihat siswa, DUDI, dan pembimbing. Mengatur pembimbing tiap siswa. Kelola berkas umum. |
| 3 | **Kakomli** (Kepala Kompetensi Keahlian) | `/dashboard/kakomli` | Penempatan siswa jurusannya ke DUDI + verifikasi/penolakan pengajuan DUDI dari siswa. |
| 4 | **Guru Pembimbing** | `/dashboard/pembimbing` | Verifikasi presensi & jurnal siswa bimbingan. Upload berkas bimbingan & sertifikat siswa. |
| 5 | **Siswa** | `/dashboard/siswa` | Isi presensi, jurnal harian (+ foto), ajukan DUDI, dan upload laporan PKL. |

## Arsitektur & Teknologi

| Komponen | Versi / Pilihan |
|---|---|
| Framework | **Laravel** `^9.2` |
| Bahasa | PHP `^8.0.2` |
| Auth | Laravel session + **Laravel Sanctum** `^2.14.1` |
| View engine | Blade |
| Asset bundler | Laravel Mix `^6.0` + **Vite** `^5.4` |
| Styling | SCSS (`sass`, `sass-loader`) |
| Database | MySQL (default, lihat `.env.example`) |
| Testing | PHPUnit `^9.5`, Laravel Browser Kit Testing, Mockery, Faker |
| Deployment | Vercel serverless PHP (`vercel-php@0.7.0`) |

## Struktur Direktori

```
sistem-pkl-smk/
├── api/                    # Entry point untuk serverless Vercel
├── app/
│   ├── Http/
│   │   ├── Controllers/    # 13 controller (Login, Register, User, Student, dst.)
│   │   └── Middleware/     # CekLevel.php -> middleware role-based
│   └── Models/             # User, Student, Mentor, Industry, Jurnal, Attendence, ...
├── bootstrap/
├── config/
├── database/
│   ├── migrations/         # 16 migration (users, students, industries, dst.)
│   └── seeders/            # Seeder lengkap termasuk akun demo
├── lang/
├── public/                 # Document root Laravel
├── resources/
│   └── views/
│       ├── admin/          # Tampilan role admin
│       ├── humas/          # Tampilan role humas
│       ├── kakomli/        # Tampilan role kakomli
│       ├── pembimbing/     # Tampilan role guru pembimbing
│       ├── siswa/          # Tampilan role siswa
│       ├── template/       # Layout app.blade.php & sidebar.blade.php
│       ├── login.blade.php
│       └── register.blade.php
├── routes/
│   ├── web.php             # Rute utama, dikelompokkan per-level middleware
│   └── api.php
├── storage/
├── tests/
├── vercel.json             # Konfigurasi Vercel
└── webpack.mix.js
```

## Model & Relasi Data

Entitas utama dan relasinya (Eloquent):

- **User** `hasMany` Mentor, Student, Chief, Pr; `belongsTo` Level.
- **Level** `hasMany` User (1 Admin, 2 Humas, 3 Kakomli, 4 Pembimbing, 5 Siswa).
- **Student** `belongsTo` User, Grade, Mentor, Industry; `hasMany` Attendence, Jurnal; `hasOne` IndustrySubmission.
- **Mentor** `belongsTo` User, Major; `hasMany` Student.
- **Chief** (Kakomli) `belongsTo` User, Major.
- **Grade** (kelas) `belongsTo` Major.
- **Major** (jurusan): Perhotelan (`ph`), Akuntansi (`akl`), Bisnis Daring & Pemasaran (`bdp`), Multimedia (`mm`), OTKP (`otkp`), RPL (`rpl`), TKJ (`tkj`), Tata Busana (`tb`).
- **Industry** (DUDI): memiliki `kuota` siswa.
- **IndustrySubmission**: pengajuan DUDI baru oleh siswa (diverifikasi Kakomli → lalu menjadi `Industry`).
- **Attendence**: presensi harian siswa (tanggal, jam_datang, jam_pulang, status, `verifikasi`).
- **Jurnal**: jurnal kegiatan siswa (waktu, kegiatan, dokumentasi gambar, `verifikasi`).
- **File**: template & dokumen yang diunduh/diunggah pembimbing dan siswa.

## Instalasi & Menjalankan Lokal

### Prasyarat

- PHP `>= 8.0.2` beserta ekstensi standar Laravel (`mbstring`, `openssl`, `pdo_mysql`, `xml`, `ctype`, dll.)
- Composer
- Node.js + npm
- MySQL / MariaDB

### Langkah-langkah

1. **Clone repositori**

   ```bash
   git clone <url-repo-ini> sistem-pkl-smk
   cd sistem-pkl-smk
   ```

2. **Instal dependensi PHP & JS**

   ```bash
   composer install
   npm install
   ```

3. **Siapkan file environment**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Default database pada `.env.example`:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=db_pkl
   DB_USERNAME=root
   DB_PASSWORD=
   ```

   Buat database bernama `db_pkl` (atau sesuaikan pada `.env`).

4. **Migrasi & seeding**

   ```bash
   php artisan migrate --seed
   ```

   Seeder (`database/seeders/DatabaseSeeder.php`) akan membuat level, jurusan, pengguna contoh, DUDI, presensi, jurnal, dan berkas dummy.

5. **Symlink storage** (agar upload dapat diakses publik)

   ```bash
   php artisan storage:link
   ```

6. **Jalankan aplikasi**

   ```bash
   php artisan serve
   # di terminal lain
   npm run dev
   ```

   Aplikasi akan berjalan di `http://localhost:8000`.

## Akun Sampel

> Semua akun sampel menggunakan password **`12345`**.

| No. Induk | Role |
|-----------|------|
| `00000`   | Admin |
| `111111`  | Guru Pembimbing |
| `22222`   | Guru Pembimbing |
| `33333`   | Humas |
| `55555`   | Siswa |
| `67698`   | Siswa |
| `41878`   | Siswa |
| `73146`   | Siswa |
| `62389`   | Siswa |
| `80584`   | Siswa |
| `101010`  | Kakomli |
| `290307`  | Siswa |
| `070900`  | Guru Pembimbing |

Login dilakukan dengan kolom **no_induk** (bukan email) — lihat `app/Http/Controllers/LoginController.php`.

## Deployment (Vercel)

Proyek sudah dilengkapi `vercel.json` dan entry serverless di `api/index.php`:

- Runtime: `vercel-php@0.7.0`
- Semua request non-asset di-rewrite ke `api/index.php` yang meng-include `public/index.php`.
- ENV yang di-override pada produksi (lihat `vercel.json`): `APP_ENV=production`, path cache ke `/tmp`, `SESSION_DRIVER=cookie`, `CACHE_DRIVER=array`, `LOG_CHANNEL=stderr`.

Untuk deploy sendiri, buat project baru di Vercel, arahkan ke repo ini, dan tambahkan variabel `APP_KEY`, kredensial database, serta override `APP_URL` sesuai domain Vercel Anda.

## Lisensi

Framework Laravel yang mendasari proyek ini dirilis di bawah [MIT License](https://opensource.org/licenses/MIT). Kode aplikasi pada repositori ini merupakan **karya akademik** dan dapat dipakai untuk referensi pembelajaran.
