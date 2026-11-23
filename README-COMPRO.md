# absenku — Company Profile

Halaman profil perusahaan generik untuk sistem absensi & payroll. Dibangun dengan
**Laravel 12** + SQLite agar bisa dipasang berdampingan dengan aplikasi absensi yang
sudah berjalan. Seluruh konten bisa diubah dari panel admin — tidak perlu edit kode.

## Menjalankan

```bash
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

Buka `http://127.0.0.1:8000` untuk halaman publik dan `/admin` untuk panel admin.

## Akun admin awal

Kredensial awal dibaca dari `.env` saat `migrate --seed`:

```
ADMIN_EMAIL=admin@example.com
ADMIN_PASSWORD=password
```

Ganti keduanya sebelum seed, lalu **segera ganti kata sandi** lewat menu **Akun saya**
setelah login pertama.

## Yang bisa diedit dari admin

| Menu | Isi |
|---|---|
| Konten halaman | Identitas, hero, latar, judul tiap bagian, CTA, kontak, SEO |
| Tampilan & warna | Logo, 7 token warna (langsung jadi CSS variable), pratinjau |
| Keunggulan | Kartu benefit (judul, deskripsi, ikon, urutan, tampil/sembunyi) |
| Modul | Daftar modul sistem |
| Langkah | Alur kerja 5 langkah |
| FAQ | Tanya-jawab |
| Statistik | Angka ringkas di halaman |
| Harga | Judul bagian, tiga paket, fitur, dan tautan tiap paket |
| Akun saya | Ganti kata sandi |

Logo diunggah lewat **Tampilan & warna**. Tombol "Hapus logo, kembali ke bawaan"
mengembalikan logo generik di `public/images/logo.svg` — aman untuk dipakai ulang
untuk klien berbeda. Inisial di mock dashboard mengikuti `brand_name`, dan alamat di
mock mengikuti `app_url`, jadi tidak ada nama perusahaan yang tertanam di kode.

Setiap bagian punya tombol tampil/sembunyi. Urutan memakai angka kecil ke besar.
Perubahan langsung dipakai halaman publik (cache pengaturan dibersihkan otomatis
saat simpan).

## Struktur penting

```
app/Http/Controllers/SiteController.php        halaman publik
app/Http/Controllers/Admin/                    panel admin (auth, konten, tampilan, koleksi)
app/Models/Setting.php                         pengaturan key-value + cache
config/compro.php                              definisi field, palet, koleksi, akun awal
resources/views/site/                          layout & partial landing page
resources/views/admin/                         layout & form admin
public/css/site.css, public/css/admin.css      CSS tulis tangan (tanpa build step)
public/js/site.js, public/js/admin.js
public/images/logo.svg                         logo bawaan (generik)
database/seeders/DatabaseSeeder.php            konten awal + akun admin
database/database.sqlite                       basis data konten
```

Data konten disimpan di SQLite milik proyek ini, tidak menyentuh database aplikasi
absensi. Tombol "Masuk ke aplikasi" diatur lewat field **URL aplikasi absen**.

## Perintah berguna

```bash
php artisan migrate:fresh --seed   # reset konten ke bawaan (hapus perubahan konten)
php artisan storage:link           # kalau folder public/storage belum ada
php artisan optimize:clear         # bersihkan cache config/route/view
php artisan test                   # test memakai SQLite :memory:, tidak menyentuh konten
```

`phpunit.xml` mengarahkan pengujian ke SQLite `:memory:` sehingga basis data konten
aman saat test dijalankan.

## Sebelum dipakai production

1. Isi `ADMIN_EMAIL` dan `ADMIN_PASSWORD` di `.env` sebelum seed, lalu ganti sandi setelah login.
2. Set `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL` sesuai domain.
3. Jalankan `php artisan config:cache route:cache view:cache` (setelah `optimize:clear`).
4. Pastikan folder `storage/` dan `bootstrap/cache/` bisa ditulis.
5. Backup `database/database.sqlite` bersama file upload di `storage/app/public/brand/`.

## Catatan desain

- Palet navy + aksen biru tenang, tipografi Archivo/Inter.
- Mock dashboard, ponsel, dan rekap digambar dengan HTML/CSS, bukan gambar stok.
- Animasi hanya *reveal* halus dan menghormati `prefers-reduced-motion`.
- Tidak memakai framework CSS atau build step, jadi halaman tetap ringan dan mudah dirawat.
