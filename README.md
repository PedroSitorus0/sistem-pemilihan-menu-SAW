# Sistem Pendukung Keputusan Pemilihan Menu Kantin (Metode SAW)

## Deskripsi Sistem
Aplikasi berbasis web untuk membantu pemilihan menu terbaik di kantin menggunakan metode *Simple Additive Weighting* (SAW). Sistem mendukung empat peran pengguna: Admin, Developer, Dosen, dan Mahasiswa. Setiap menu dinilai berdasarkan kriteria Harga (cost), Popularitas, Ketersediaan, dan Tingkat Rasa (benefit). Dosen dan mahasiswa dapat memberikan penilaian, admin mengelola data master, dan developer memiliki akses penuh plus alat debugging. Seluruh aktivitas tercatat dalam log sistem.

## Fitur Utama
- Multi-role authentication dan authorization (Admin, Dev, Dosen, Mahasiswa)
- Manajemen data menu (makanan/minuman)
- Manajemen kriteria dan bobot SAW
- Form penilaian oleh dosen/mahasiswa (multi-penilai)
- Penerapan constraint unik agar satu pengguna hanya satu kali menilai satu menu
- Perhitungan SAW: normalisasi, pembobotan, perankingan
- Pencatatan log aktivitas (HTTP method, URL, IP, user agent)
- Hak akses Developer mencakup seluruh modul Admin ditambah Developer Tools

## Struktur Database
### Tabel `users`
| Kolom          | Tipe         | Keterangan                          |
|----------------|--------------|-------------------------------------|
| id             | BIGINT PK    | Auto increment                      |
| nama           | VARCHAR      | Nama lengkap                        |
| email          | VARCHAR UK   | Unique, untuk login                 |
| password       | VARCHAR      | Hash bcrypt                         |
| role           | ENUM         | 'admin','dosen','mahasiswa','dev'   |
| nomor_induk    | VARCHAR NULL | NIM atau NIDN                       |
| created_at     | TIMESTAMP    |                                     |
| updated_at     | TIMESTAMP    |                                     |

### Tabel `menus`
| Kolom          | Tipe         | Keterangan                          |
|----------------|--------------|-------------------------------------|
| id             | BIGINT PK    | Auto increment                      |
| nama_menu      | VARCHAR      | Nama menu                           |
| kategori       | VARCHAR      | Kategori (Makanan Berat, dll)       |
| harga          | INTEGER      | Harga dalam Rupiah                  |
| deskripsi      | TEXT NULL    | Penjelasan menu                     |
| ketersediaan   | ENUM         | 'tersedia','tanpa keterangan','tidak tersedia' |
| foto           | VARCHAR NULL | Nama file gambar                    |
| created_at     | TIMESTAMP    |                                     |
| updated_at     | TIMESTAMP    |                                     |

### Tabel `kriteria`
| Kolom          | Tipe         | Keterangan                          |
|----------------|--------------|-------------------------------------|
| id             | BIGINT PK    | Auto increment                      |
| kode_kriteria  | VARCHAR UK   | C1, C2, C3, C4                      |
| nama_kriteria  | VARCHAR      | Harga, Popularitas, dll             |
| sifat          | ENUM         | 'cost' atau 'benefit'               |
| bobot          | FLOAT        | 0.35, 0.25, 0.25, 0.15 (total 1.0) |
| created_at     | TIMESTAMP    |                                     |
| updated_at     | TIMESTAMP    |                                     |

### Tabel `penilaian`
| Kolom          | Tipe         | Keterangan                          |
|----------------|--------------|-------------------------------------|
| id             | BIGINT PK    | Auto increment                      |
| menu_id        | BIGINT FK    | Referensi menus.id                  |
| kriteria_id    | BIGINT FK    | Referensi kriteria.id               |
| user_id        | BIGINT FK    | Referensi users.id                  |
| nilai          | FLOAT        | Nilai mentah                        |
| created_at     | TIMESTAMP    |                                     |
| updated_at     | TIMESTAMP    |                                     |
| UNIQUE(menu_id, kriteria_id, user_id) |      |                                     |

### Tabel `system_logs`
| Kolom          | Tipe         | Keterangan                          |
|----------------|--------------|-------------------------------------|
| id             | BIGINT PK    | Auto increment                      |
| user_id        | BIGINT FK    | Referensi users.id                  |
| method         | VARCHAR(10)  | GET, POST, PUT, DELETE              |
| url            | VARCHAR      | URL yang diakses                    |
| aksi           | VARCHAR      | Deskripsi aktivitas                 |
| ip_address     | VARCHAR(45) NULL | IP pengguna                     |
| user_agent     | VARCHAR(500) NULL | User-Agent header               |
| created_at     | TIMESTAMP    |                                     |
| updated_at     | TIMESTAMP    |                                     |

### Relasi
- users 1 : N system_logs
- users 1 : N penilaian
- menus 1 : N penilaian
- kriteria 1 : N penilaian

## Teknologi
- Laravel 11+ (PHP Framework)
- Laravel Breeze (starter kit autentikasi)
- MySQL / MariaDB (database)
- Blade template engine

## Status Pengembangan Saat Ini
1. Semua migration telah dibuat dan dijalankan.
2. Model (User, Menu, Kriteria, Penilaian, SystemLog) sudah terdefinisi dengan relasi.
3. Middleware `RoleMiddleware` telah dibuat dan didaftarkan di `bootstrap/app.php`.
4. Seeder untuk 6 akun developer sudah tersedia.
5. Struktur route dasar sudah disiapkan dengan middleware `auth` dan `role`.

## Tugas Pengembangan Selanjutnya (Prioritas)
### Fase 1 - Data Master dan Dashboard
- [x] Migration dan model
- [x] Middleware role
- [x] Seeder akun developer
- [ ] **Seeder Kriteria** (C1, C2, C3, C4 beserta bobot dan sifat)
- [ ] **Seeder Menu** (5-10 menu contoh)
- [ ] **Seeder User tambahan** (1 admin, 1 dosen, 1 mahasiswa untuk testing)
- [ ] **Dashboard Controller** – mengarahkan user ke view sesuai role
- [ ] **Layout Blade** – template utama dengan sidebar dinamis berdasarkan role

### Fase 2 - Modul Admin & Developer
- [ ] **Admin/MenuController** (resource) – CRUD menu
- [ ] **Admin/KriteriaController** (resource) – CRUD kriteria, validasi total bobot = 1
- [ ] **Admin/UserController** (resource) – Manajemen pengguna (admin hanya mengelola non-dev)
- [ ] **Admin/LogController** (index) – Menampilkan system log (bisa difilter)

### Fase 3 - Modul Penilaian (Dosen & Mahasiswa)
- [ ] **Penilai/PenilaianController** (index, store)
  - `index()` – Menampilkan daftar menu yang bisa dipilih untuk dinilai
  - `store()` – Menerima input C2, C3, C4; otomatis mengambil C1 dari harga menu; menyimpan ke tabel penilaian dengan unique constraint
- [ ] **Form penilaian** – Blade view untuk input rating

### Fase 4 - Perhitungan SAW
- [ ] **Service SAW** – Class khusus untuk logika: mengambil rata-rata nilai per menu per kriteria, normalisasi, perkalian bobot, penjumlahan, pengurutan
- [ ] **SawController** – Method `index` (halaman perhitungan untuk admin/dev) dan `hasil` (halaman hasil untuk penilai)
- [ ] **View hasil** – Menampilkan tabel peringkat menu

### Fase 5 - Logging dan Tools
- [ ] **Middleware Logger** – Mencatat setiap request (method, URL, IP, user agent) ke tabel system_logs; dapat diaktifkan untuk route tertentu
- [ ] **DevController** – Halaman Developer Tools (informasi environment, log level, dsb.)

### Fase 6 - Testing dan Penyempurnaan
- [ ] Uji setiap role, pastikan constraint unique berfungsi
- [ ] Perbaikan UI/UX, notifikasi, validasi form
- [ ] Dokumentasi penggunaan

## Catatan Penting
- Semua route yang memerlukan autentikasi sudah dibungkus middleware `auth`.
- Route Admin/Dev dipisahkan dari route Penilai menggunakan middleware `role:admin,dev` dan `role:dosen,mahasiswa`.
- Penilaian menggunakan composite unique key untuk mencegah duplikasi penilaian.
- Nilai C1 (Harga) tidak diinput manual oleh penilai, tetapi diambil otomatis dari tabel menus.
- Ketersediaan pada tabel menus saat ini bertipe ENUM; apabila akan digunakan langsung dalam perhitungan, harus dikonversi ke integer melalui accessor di model.
- Pastikan file `.env` sudah dikonfigurasi untuk database sebelum menjalankan migrate dan seed.