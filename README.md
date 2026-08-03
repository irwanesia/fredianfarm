# Fredian Farm

Website perusahaan **Fredian Farm** — produsen dan distributor **bibit kentang** berkualitas (G-0, G-0 MZ, Granola L, G-0 Plus) dari Dieng, Jawa Tengah. Dibangun dengan **Laravel 13** dan dijalankan di atas **Docker**.

Website mencakup halaman publik (profil, katalog produk, blog, galeri, testimoni, FAQ, formulir RFQ/kontak, pencarian, tracking pesanan) dan panel admin (manajemen produk, artikel, galeri, banner, testimoni, FAQ, pengaturan, pesanan, dan dashboard statistik).

---

## Fitur Utama

### Halaman Publik
- **Beranda** — hero slider (banner data-driven), produk unggulan, artikel terbaru, testimoni, FAQ.
- **Produk** — katalog dengan filter kategori & status stok, halaman detail produk + varian, tombol keranjang.
- **Blog** — daftar & detail artikel, artikel terkait/populer, pencarian.
- **Galeri** — dokumentasi foto produk/kegiatan/lahan/tim dengan hover-caption.
- **Testimoni, FAQ, Cara Pesan, Tentang Kami, Privasi**.
- **Pencarian publik** (`/cari`) — mencari produk (nama/deskripsi) dan artikel (judul/konten).
- **Kontak / RFQ** — formulir dengan proteksi **honeypot** anti-spam.
- **Checkout & Tracking** pesanan.
- **SEO** — `sitemap.xml`, `robots.txt`, Schema.org JSON-LD (Organization, Product, Article, FAQPage, BreadcrumbList).

### Panel Admin (`/admin`)
- **Dashboard** — KPI + grafik data nyata (pesan masuk & artikel terbit 14 hari terakhir).
- **Produk & Kategori** — CRUD katalog + varian produk (harga, berat, stok).
- **Artikel & Kategori** — CRUD artikel + **Generator Konten AI** (judul via Groq, isi via Gemini).
- **Galeri** — upload gambar (otomatis konversi **WebP**).
- **Banner**, **Testimoni**, **FAQ**, **Media Sosial**, **Pembayaran (Bank)**.
- **Pesan Masuk (Kontak inbox)**, **Pesanan**, **Pengguna** (role admin/editor).
- **Pengaturan & SEO** (hanya role admin).

### Keamanan & Kualitas
- Upload gambar otomatis dikonversi ke **WebP** (produk, tinymce artikel, galeri).
- Konten artikel disanitasi dengan **mews/purifier** (anti XSS).
- Formulir kontak dilindungi **spatie/laravel-honeypot**.
- Otentikasi admin + role-based (admin/editor).

---

## Teknologi

- **Laravel 13** (PHP 8.3) di atas Apache (`php:8.3-apache`)
- **MySQL 8.0**
- **Docker Compose** (manajemen multi-aplikasi)
- **Intervention Image** — proses & konversi gambar WebP
- **spatie/laravel-honeypot** — anti spam form
- **mew/purifier** — sanitasi HTML
- **spatie/laravel-sitemap**, **sluggable**, **permission**, **medialibrary**
- **Livewire**, **TinyMCE** (editor konten), **ApexCharts** (dashboard)
- Integrasi AI: **Google Gemini** (konten) & **Groq (Llama)** (judul & metadata)

---

## Struktur Login

| Role  | Email                    | Password |
|-------|--------------------------|----------|
| Admin | `admin@fredianfarm.co.id`| `password` |
| Editor| `editor@fredianfarm.co.id`| `password` |

> Akun admin dibuat via seeder. Login di `http://localhost:8098/login`, panel di `http://localhost:8098/admin`.

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
| GET    | `/tracking`, POST `/checkout` | Pelacakan & checkout      |
| GET    | `/sitemap.xml`, `/robots.txt` | SEO                     |
| GET    | `/admin`                   | Dashboard admin               |

---

## Kontribusi & Lisensi

Proyek ini dikembangkan sebagai website untuk Fredian Farm. Kode sumber menggunakan **MIT License** (framework Laravel).