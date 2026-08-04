# Fredian Farm

Website perusahaan **Fredian Farm** — produsen dan distributor **bibit kentang** berkualitas (G-0, G-0 MZ, Granola L, G-0 Plus) dari Dieng, Jawa Tengah. Dibangun dengan **Laravel 13** dan dijalankan di atas **Docker**.

Website mencakup halaman publik (profil, katalog produk, blog, galeri, testimoni, FAQ, formulir RFQ/kontak, keranjang & checkout ringan berbasis WhatsApp, pencarian, tracking pesanan) dan panel admin (manajemen produk, artikel, galeri, banner, testimoni, FAQ, pengaturan, pesanan, dan dashboard statistik).

> **Sebelum deploy ke production**, cek `security-review-fredianfarm.md` — ada beberapa temuan keamanan (🔴 tinggi: validasi harga checkout, sanitasi deskripsi produk, rate limiting) yang wajib diperbaiki dulu. Lihat juga `prd.md` section 13 untuk status terkini.

---

## Fitur Utama

### Halaman Publik
- **Beranda** — hero slider (banner data-driven), produk unggulan, artikel terbaru, testimoni, FAQ.
- **Produk** — katalog dengan filter kategori & status stok, halaman detail produk + varian, tombol keranjang.
- **Keranjang & Checkout** — pengunjung bisa menambahkan produk/varian ke keranjang, checkout mencatat pesanan (`Order`) ke database lalu generate link WhatsApp berisi ringkasan pesanan ke admin. **Tidak ada payment gateway otomatis** — pembayaran tetap transfer manual/COD, dikonfirmasi admin.
- **Tracking Pesanan** — cek status pesanan via nomor pesanan + nomor WA pemesan.
- **Blog** — daftar & detail artikel, artikel terkait/populer, pencarian.
- **Galeri** — dokumentasi foto produk/kegiatan/lahan/tim dengan filter kategori.
- **Testimoni, FAQ, Cara Pesan, Tentang Kami, Privasi**.
- **Pencarian publik** (`/cari`) — mencari produk (nama/deskripsi) dan artikel (judul/konten).
- **Kontak / RFQ** — formulir dengan proteksi **honeypot** anti-spam.
- **SEO** — `sitemap.xml`, `robots.txt`, Schema.org JSON-LD (Organization, Product, Article, FAQPage, BreadcrumbList).

### Panel Admin (`/admin`)
- **Dashboard** — KPI + grafik data nyata (pesan masuk & artikel terbit 14 hari terakhir).
- **Produk & Kategori** — CRUD katalog + varian produk (harga, berat, stok).
- **Artikel & Kategori** — CRUD artikel + **Generator Konten AI** (judul via Groq, isi via Gemini).
- **Galeri** — upload gambar (otomatis konversi **WebP**).
- **Banner**, **Testimoni**, **FAQ**, **Media Sosial**, **Bank/Metode Pembayaran**.
- **Pesan Masuk (Kontak inbox)** — lihat & kelola lead dari form kontak.
- **Pesanan** — kelola order dari web maupun kanal lain (WA/TikTok/Shopee), status `baru → diproses → dikirim → selesai → dibatalkan`, input kurir & nomor resi, notifikasi WA otomatis ke pelanggan saat status berubah, penyesuaian stok otomatis.
- **Pengguna** (role `admin`/`editor`).
- **Pengaturan & SEO** (hanya role admin).

### Keamanan & Kualitas
- Upload gambar otomatis dikonversi ke **WebP** (produk, tinymce artikel, galeri) — file gambar di-decode ulang lalu di-encode, bukan sekadar ganti ekstensi, sehingga payload berbahaya dalam file gambar ikut terbuang.
- Konten artikel & deskripsi produk disanitasi dengan **mews/purifier** (anti XSS).
- Formulir kontak dilindungi **spatie/laravel-honeypot**.
- Otentikasi admin + role-based (admin/editor) via kolom `role` + middleware custom.
- **Status keamanan pra-deploy**: lihat `security-review-fredianfarm.md` untuk daftar lengkap temuan & rekomendasi perbaikan sebelum go-live.

---

## Teknologi

- **Laravel 13** (PHP 8.3) di atas Apache (`php:8.3-apache`)
- **MySQL 8.0**
- **Docker Compose** (manajemen multi-aplikasi)
- **Intervention Image** — proses & konversi gambar WebP
- **spatie/laravel-honeypot** — anti spam form
- **mews/purifier** — sanitasi HTML
- **spatie/laravel-sitemap**, **sluggable**, **permission**\*, **medialibrary**
- **Livewire**, **TinyMCE** (editor konten), **ApexCharts** (dashboard)
- Integrasi AI: **Google Gemini** (konten) & **Groq (Llama)** (judul & metadata)

\* `spatie/laravel-permission` ter-install dan tabel permission-nya sudah dimigrasikan, tapi **belum dipakai aktif di kode** — sistem role yang aktif adalah kolom `role` (enum `admin`/`editor`, default `editor` di level DB) + middleware custom `EnsureUserRole`. Hindari mencampur kedua sistem ini; jika package tersebut tidak akan dipakai, pertimbangkan untuk dihapus. Lihat `prd.md` section 2 untuk detail.

### Frontend — desain terpisah admin vs publik

| | Admin Panel | Halaman Publik |
|---|---|---|
| UI Framework | Tabler (Bootstrap 5) | Custom design system |
| Interaktivitas | Alpine.js | Vanilla JS |
| Font | Inter | Fraunces / Manrope / JetBrains Mono |

---

## Struktur Login

| Role  | Email                    | Password |
|-------|--------------------------|----------|
| Admin | `admin@fredianfarm.co.id`| `password` |
| Editor| `editor@fredianfarm.co.id`| `password` |

> Akun admin dibuat via seeder. Login di `http://localhost:8098/login`, panel di `http://localhost:8098/admin`.
>
> ⚠️ **Wajib diganti sebelum production** — password default `password` tidak boleh terbawa ke deployment live.

---

## Menjalankan dengan Docker

Aplikasi ini berada di dalam proyek monorepo Docker `multi-docker`. Container: `app_fredianfarm` (port **8098**), basis data MySQL: `mysql_core` (DB: `fredianfarm_db`).

### 1. Bangun & jalankan container

Dari direktori `multi-docker`:

```bash
docker compose up -d --build app_fredianfarm
```

`entrypoint.sh` akan otomatis:
- membuat database `fredianfarm_db` jika belum ada (MySQL `mysql_core`),
- menjalankan migrasi,
- meng-install dependencies composer bila belum ada,
- menyimpan file publik di `public/storage` (symlink ke `storage/app/public`).

### 2. Konfigurasi `.env`

Subdir `./fredianfarm/.env` sudah disiapkan. Konfigurasi inti:

```env
APP_NAME="Fredian Farm"
APP_URL=http://localhost:8098

DB_CONNECTION=mysql
DB_HOST=mysql_core
DB_PORT=3306
DB_DATABASE=fredianfarm_db
DB_USERNAME=float
DB_PASSWORD=333

# Kunci AI (opsional: untuk generator artikel)
GEMINI_API_KEY=
GROQ_API_KEY=
```

### 3. (Opsional) Seeder data awal

Bila basis data baru dan kosong:

```bash
docker exec app_fredianfarm php artisan db:seed
```

Seeder membuat user admin + data contoh (kategori, produk, varian, artikel, testimoni, FAQ, banner, kontak, pengaturan, media sosial).

### Artisan dalam container

```bash
docker exec app_fredianfarm php artisan migrate      # migrasi
docker exec app_fredianfarm php artisan db:seed      # seeder
docker exec app_fredianfarm php artisan route:list   # daftar rute
```

---

## Menjalankan tanpa Docker (lokal)

Persyaratan: **PHP 8.3**, **Composer**, **Node 18+**, MySQL.

```bash
cd fredianfarm
cp .env.example .env          # sesuaikan kredensial DB
composer install
npm install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm run build
php artisan serve             # http://localhost:8000
```

---

## Rute Utama

| Metode | URI                        | Deskripsi                     |
|--------|----------------------------|-------------------------------|
| GET    | `/`                        | Beranda                      |
| GET    | `/produk`, `/produk/{slug}`| Katalog & detail produk      |
| GET    | `/cari?q=`                 | Pencarian produk & artikel   |
| GET    | `/blog`, `/blog/{slug}`    | Blog & detail artikel        |
| GET    | `/galeri`                  | Galeri foto                  |
| GET    | `/kontak`, POST `/kontak`  | Formulir kontak/RFQ (honeypot)|
| POST   | `/checkout`                | Submit keranjang → catat order + generate link WA |
| GET    | `/tracking`                | Cek status pesanan (nomor pesanan + nomor WA)      |
| GET    | `/sitemap.xml`, `/robots.txt` | SEO                     |
| GET    | `/admin`                   | Dashboard admin               |

---

## Sebelum Deploy ke Production

Lihat dua dokumen berikut sebelum go-live:

1. **`security-review-fredianfarm.md`** — checklist temuan keamanan (validasi harga checkout, sanitasi input, rate limiting, dll.) beserta lokasi kode dan rekomendasi perbaikan.
2. **`prd.md`** section 13 — status ringkas item keamanan yang masih terbuka, dihubungkan ke fitur terkait di PRD.

Selain itu, pastikan:
- Password default seeder (admin & editor) sudah diganti
- `APP_ENV=production`, `APP_DEBUG=false`
- `GEMINI_API_KEY` / `GROQ_API_KEY` terisi di `.env` production (bukan `.env` development)

---

## Kontribusi & Lisensi

Proyek ini dikembangkan sebagai website untuk Fredian Farm. Kode sumber menggunakan **MIT License** (framework Laravel).
