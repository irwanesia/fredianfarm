# PRD — Fredian Farm

**Produk**: Website Penjualan Bibit Kentang
**Versi**: 1.2 (revisi sinkronisasi dokumen ↔ kode, 2026-08-04)
**Stack**: Laravel 13 + PHP 8.3

> **Changelog v1.1 → v1.2**: dokumen ini direvisi setelah code review terhadap implementasi aktual. Perubahan utama: versi Laravel, arsitektur frontend (Tabler vs custom), status keranjang/checkout, dokumentasi modul Pesanan, daftar tabel database, dan status implementasi rate limiting AI generator. Lihat bagian **13. Status Keamanan Pra-Deploy** untuk item yang masih terbuka.

---

## 1. Latar Belakang & Tujuan

Fredian Farm menjual bibit kentang (Granola, Atlantik, Medians, dll.). Website ini bertujuan sebagai:

- **Company profile** membangun kepercayaan
- **Katalog produk** interaktif
- **Blog SEO** untuk mendatangkan traffic organik
- **CMS** untuk pengelolaan konten mandiri

Target utama: petani, kelompok tani, distributor, dinas pertanian, toko pertanian, dan masyarakat umum.

---

## 2. Tech Stack

### Backend

| Komponen | Pilihan |
|----------|---------|
| Framework | **Laravel 13** |
| PHP | PHP 8.3 |
| Database | MySQL 8.0 / MariaDB 10.x |
| Web Server | Apache (php:8.3-apache) |
| AI/LLM | Google Gemini API (artikel) + Groq/Llama (judul & metadata) via HTTP Client Laravel |

### Frontend

> **Catatan v1.2**: frontend **terpisah desain** antara admin panel dan halaman publik — lihat detail di bagian Arsitektur.

| Komponen | Admin Panel | Halaman Publik |
|----------|-------------|-----------------|
| UI Framework | **Tabler** (Bootstrap 5) | Custom design (bukan Tabler) |
| CSS | `@tabler/core` + custom override warna brand | Custom CSS, tidak memakai Bootstrap/Tabler |
| Interaktivitas | Alpine.js | Vanilla JS / sesuai kebutuhan halaman |
| Font | Inter | Fraunces (heading), Manrope (body), JetBrains Mono (aksen) |
| Asset Bundler | Vite | Vite |
| Node.js | 20 LTS | 20 LTS |

### Package (Composer)

| Package | Fungsi | Status |
|---------|--------|--------|
| `spatie/laravel-medialibrary` | Manajemen gambar (produk, galeri, banner, testimoni) | Aktif |
| `spatie/laravel-sitemap` | Generate sitemap.xml otomatis | Aktif |
| `spatie/laravel-sluggable` | SEO-friendly URL | Aktif |
| `spatie/laravel-honeypot` | Anti-spam form kontak | Aktif |
| `spatie/laravel-permission` | Role & permission multi-admin | **Ter-install, migrasi ada, TAPI belum dipakai di kode.** Role saat ini ditangani via kolom `role` enum (`admin`/`editor`) di tabel `users` + middleware custom `EnsureUserRole`. Perlu keputusan: (a) wire up package ini untuk permission granular ke depannya, atau (b) uninstall package + drop tabel permission untuk menyederhanakan dependency. |
| `spatie/laravel-activitylog` | Audit trail CMS | Direncanakan — cek apakah sudah diaktifkan di implementasi final |
| `intervention/image` | Resize & optimasi gambar, konversi WebP | Aktif |
| `livewire/livewire` | Komponen dinamis tanpa JS | Sesuai kebutuhan |
| `mews/purifier` | Sanitasi HTML artikel | Aktif untuk `konten` artikel. **Belum diterapkan ke `deskripsi` produk** — lihat bagian 13, temuan #2. |
| `barryvdh/laravel-debugbar` | Debugging (dev) | Dev only — pastikan tidak aktif di production (`APP_DEBUG=false`) |

### Image & Editor

| Komponen | Pilihan | Keterangan |
|----------|---------|------------|
| Rich Text Editor | **TinyMCE** | Support drag & drop image upload |
| Image Format | **WebP** | Auto-konversi dari JPG/PNG/GIF via `intervention/image` (decode ulang, bukan sekadar ganti ekstensi) |
| Image Quality | **80%** | Balance ukuran file vs kualitas visual |
| Image Storage | `storage/app/public/{artikel,produk,galeri}/` | Symlink ke `public/storage/...` |

---

## 3. Arsitektur

> **Revisi v1.2**: klaim versi sebelumnya ("Tabler digunakan untuk seluruh website") **tidak sesuai implementasi**. Berikut arsitektur yang benar-benar berjalan:

- **Halaman publik**: desain custom (bukan Tabler) — layout sendiri dengan sistem warna & tipografi brand (font Fraunces/Manrope/JetBrains Mono), dibangun dari CSS kustom + Vite.
- **Admin panel**: layout **Tabler dashboard** (sidebar, datatables, forms, charts) + Alpine.js untuk interaktivitas, sesuai rencana awal.
- **Blade components** reusable: card produk, breadcrumb, schema.org structured data, partial ikon sosial media, dll.

### Docker

Mengikuti pola project Laravel lain di repo:

```
php:8.3-apache
  ├── composer (multi-stage)
  ├── node:20 (multi-stage)
  ├── extensions: intl, pdo_mysql, zip, gd, mbstring, exif
  ├── a2enmod rewrite
  ├── document root → /var/www/html/public
  └── entrypoint: install → build → migrate → start
```

Database pakai `mysql_core` yang sudah ada di docker-compose.

---

## 4. Fitur & Modul

### 4.1 Public Pages

| Halaman | Konten Utama |
|---------|--------------|
| Home | Hero, Kenapa Kami, Produk Unggulan, Cara Pesan, Artikel Terbaru, Testimoni, Partner, Lokasi, CTA WA |
| Tentang Kami | Sejarah, visi misi, legalitas, sertifikat, lokasi kebun, proses produksi, foto |
| Produk | Grid produk + filter (kategori, status stok, pencarian nama/deskripsi) |
| Detail Produk | Foto, deskripsi, varian (harga/berat/stok per varian), tombol keranjang, tombol WA |
| Keranjang & Checkout | Lihat bagian 4.4 — **direvisi dari rencana awal** |
| Tracking Pesanan | Cek status pesanan via nomor pesanan + nomor WA |
| Cara Pemesanan | Flow: Pilih → Keranjang/Checkout → Konfirmasi via WA → Bayar → Kirim → Terima |
| Blog | Daftar artikel + kategori, pencarian |
| Detail Artikel | Gambar, heading, konten, FAQ, artikel terkait/populer/terbaru |
| Galeri | Foto kebun, gudang, bibit, sortir, packing, pengiriman — filter kategori |
| Testimoni | Foto, review, nama, daerah |
| FAQ | Accordion pertanyaan umum |
| Kontak | Alamat, WA, email, sosial media, form kontak (dilindungi honeypot) |
| Kebijakan Privasi | Kebijakan privasi |
| Pencarian (`/cari`) | Mencari produk (nama/deskripsi) dan artikel (judul/konten) sekaligus |

### 4.2 Admin CMS

| Modul | Fungsi | Akses |
|-------|--------|-------|
| Dashboard | Statistik (pesan masuk & artikel terbit 14 hari terakhir) | admin, editor |
| Produk & Kategori Produk | CRUD produk + varian + gambar + stok | admin, editor |
| Artikel & Kategori Artikel | CRUD artikel + **AI Generate** (judul via Groq, konten via Gemini) | admin, editor |
| Galeri | CRUD foto galeri | admin, editor |
| Testimoni | CRUD testimoni | admin, editor |
| FAQ | CRUD pertanyaan-jawaban | admin, editor |
| Banner | CRUD slider hero | admin, editor |
| **Pesanan** | Lihat detail 4.5 — modul yang lebih lengkap dari rencana awal | admin only |
| **Bank/Metode Pembayaran** | CRUD rekening bank untuk pembayaran transfer | admin only |
| Media Sosial | Kelola link WA, IG, FB, YT | admin only |
| Pesan Masuk (Kontak) | Lihat & kelola pesan form kontak | admin only |
| Pengaturan & SEO | Meta global, sitemap, robots.txt | admin only |
| Pengguna | CRUD admin/editor + role | admin only |

### 4.3 Fitur Tambahan

- **WhatsApp CTA** pada setiap halaman produk, artikel, dan hasil checkout
- **Lead Management** — menyimpan data calon pelanggan dari form kontak
- **Manajemen Stok** — status: Tersedia, Terbatas, Pre-order; otomatis disesuaikan saat status pesanan berubah
- **Riwayat Populer** — dashboard menampilkan artikel & produk paling diminati
- **AI Content Generator** — generate judul & konten artikel otomatis via Google Gemini + Groq (detail di section 12)

### 4.4 Keranjang & Checkout — **revisi dari rencana awal**

> PRD v1.1 menyatakan "tidak ada keranjang belanja online" dan sistem murni inquiry via WA. **Ini tidak sesuai implementasi akhir.** Yang benar-benar dibangun:

- Pengunjung publik bisa menambahkan produk/varian ke **keranjang** di sisi client, lalu submit ke endpoint `/checkout`.
- Sistem membuat record `Order` di database (nomor pesanan format `FRD-YYYYMMDD-NNNN`), dengan status awal `baru` dan `payment_status = pending`.
- Setelah checkout, sistem generate **link WhatsApp** berisi ringkasan pesanan untuk pengunjung kirim ke admin — jadi **tetap tidak ada payment gateway** (transfer manual/COD, dikonfirmasi manual oleh admin).
- Pengunjung bisa **melacak status pesanan** via halaman tracking (nomor pesanan + nomor WA).

**Yang TIDAK berubah dari rencana awal**: tidak ada payment gateway (kartu/VA otomatis), pembayaran tetap dikonfirmasi manual oleh admin.

**⚠️ Status keamanan**: per code review, endpoint checkout publik saat ini mempercayai harga yang dikirim dari client tanpa validasi ulang ke database — lihat `security-review-fredianfarm.md` temuan #1. **Ini harus diperbaiki sebelum go-live.**

### 4.5 Manajemen Pesanan (Admin) — modul baru, belum terdokumentasi di v1.1

- Admin bisa membuat pesanan manual (untuk order dari WA/TikTok/Shopee di luar sistem checkout web), dengan harga dihitung ulang dari data produk di database (bukan input manual — aman dari manipulasi harga).
- Status pesanan: `baru → diproses → dikirim → selesai → dibatalkan`, dengan penyesuaian status stok otomatis di setiap transisi.
- Field kurir & nomor resi diisi saat status `dikirim`.
- Notifikasi WhatsApp otomatis (link `wa.me`) terkirim ke pelanggan saat status berubah.
- Sumber pesanan (`order_source`): `wa`, `tiktok`, `shopee`, `manual` — mendukung pencatatan pesanan dari kanal di luar website.

---

## 5. Database

> **Revisi v1.2**: jumlah tabel di v1.1 ("12 tabel") sudah tidak akurat. Berikut daftar tabel aktual per migrasi terbaru:

| Kategori | Tabel |
|----------|-------|
| Konten inti | `kategori_produk`, `produk`, `produk_variants`, `gambar_produk`, `kategori_artikel`, `artikel`, `galeri`, `testimoni`, `faq`, `banner`, `media_sosial`, `settings` |
| Transaksi | `orders`, `banks`, `kontak` |
| Pengguna & akses | `users` (+ kolom `role` enum), tabel `permission_tables` (spatie/laravel-permission — **ter-install, belum dipakai aktif**, lihat catatan section 2) |
| Framework Laravel | `cache`, `jobs`, `sessions`, `password_reset_tokens` |

Relasi utama:

```
kategori_produk → produk → produk_variants
                        └→ gambar_produk
kategori_artikel → artikel
users → semua modul (created_by / user_id di artikel)
produk/produk_variants → orders (via kolom items JSON, snapshot harga saat order dibuat)
```

---

## 6. SEO Requirements

*(tidak berubah dari v1.1)*

- URL SEO-friendly (`/produk/bibit-kentang-granola`)
- Meta title & meta description (per halaman)
- Open Graph (OG) tags
- Breadcrumb (schema.org BreadcrumbList)
- Sitemap XML otomatis (spatie/laravel-sitemap)
- Robots.txt dinamis
- Schema.org: Product, Article, Organization, FAQ, BreadcrumbList
- Alt text pada gambar
- Internal linking antar artikel & produk
- Related posts
- Search (pencarian blog/produk)
- Lazy loading gambar
- Kompresi aset (Vite build)
- WebP conversion untuk semua gambar (artikel, produk, galeri)

> **Catatan performa**: kolom yang dipakai fitur pencarian (`produk.nama`, `produk.deskripsi`, `artikel.judul`, `artikel.konten`) belum memiliki index full-text. Tidak mendesak untuk volume data kecil, tapi perlu direncanakan sebelum katalog/blog membesar.

---

## 7. UI/UX — Tema Visual

### Warna

| Elemen | Warna | Hex |
|--------|-------|-----|
| Primary | Hijau Daun | #2E7D32 |
| Secondary | Coklat Tanah | #8D6E63 |
| Accent | Kuning Kentang | #F9A825 |
| Background | Cream | #FAF7F0 |
| Text | Abu Gelap | #333333 |

Warna ini **konsisten diterapkan** di admin panel (via override variable Tabler) dan halaman publik (custom CSS).

### Typography

> **Revisi v1.2** — berbeda antara admin dan publik (lihat section 2):

- **Admin panel**: Inter (default Tabler)
- **Halaman publik**: Fraunces (heading), Manrope (body), JetBrains Mono (aksen/label)

---

## 8. Struktur Navigasi

*(tidak berubah dari v1.1)*

```
HOME
├── Tentang Kami
├── Produk
│   ├── Semua Produk
│   ├── Granola
│   ├── Atlantik
│   ├── Medians
│   └── Lainnya
├── Blog
│   ├── Budidaya
│   ├── Bibit
│   ├── Pemupukan
│   ├── Penyakit
│   └── Panen
├── Galeri
├── Testimoni
├── FAQ
└── Kontak
```

---

## 9. Alur Pemesanan — **revisi**

```
Pilih Bibit → Tambah ke Keranjang → Checkout (isi data + metode bayar)
  → Order tercatat (status: baru) → Link WA otomatis ke admin
  → Admin konfirmasi & proses manual (transfer/COD) → Update status di admin
  → Pelanggan bisa cek status via halaman Tracking → Pengiriman → Diterima
```

Tidak ada payment gateway otomatis (kartu/VA) — pembayaran tetap transfer manual atau COD, dikonfirmasi oleh admin. Perbedaan dari v1.1: ada keranjang & pencatatan order di database, bukan murni "hubungi admin tanpa keranjang".

---

## 10. Batasan & Catatan

- **Tidak ada** payment gateway otomatis (kartu/VA)
- **Ada** keranjang & checkout ringan berbasis WA (lihat 4.4) — *diperbarui dari v1.1*
- **Tidak ada** multi-bahasa (fase awal)
- **Ada** lead management dari form kontak
- **Ada** AI Content Generator untuk artikel (Google Gemini + Groq)
- **Ada** modul manajemen pesanan yang cukup lengkap di admin (lihat 4.5)
- Semua konten dikelola via admin CMS (tidak perlu coding untuk update konten)

---

## 11. AI Content Generator (Google Gemini + Groq)

*(alur tidak berubah dari v1.1, kecuali status rate limiting — lihat 11.7)*

### 11.1 Ringkasan

Fitur AI terintegrasi di admin CMS: **Groq (Llama)** untuk generate judul, **Google Gemini** untuk generate konten artikel, keduanya realtime (synchronous, tanpa queue).

### 11.2–11.6

*(tidak berubah dari v1.1 — lihat dokumen sebelumnya untuk detail prompt template, alur gambar di editor, dan spesifikasi gambar)*

### 11.7 Keamanan

- API Key Gemini/Groq disimpan di `.env` (`GEMINI_API_KEY`, `GROQ_API_KEY`)
- **Rate limiting per admin (target: maksimal 5 generate konten per jam)** — ⚠️ **status: BELUM diimplementasikan di kode** per code review terakhir. Lihat `security-review-fredianfarm.md` temuan #3. **Wajib diimplementasikan sebelum go-live** untuk mencegah penyalahgunaan kuota API.
- Semua hasil generate tetap harus **di-review admin** sebelum publish (tidak auto-publish) — sudah sesuai implementasi.

---

## 12. Ringkasan Perubahan Non-Fungsional (v1.1 → v1.2)

Perubahan di dokumen ini murni menyesuaikan deskripsi dengan implementasi yang sudah ada — bukan menambah scope baru. Tidak ada fitur yang dihapus dari rencana; beberapa fitur (keranjang, manajemen pesanan) ternyata dibangun lebih lengkap dari rencana awal.

---

## 13. Status Keamanan Pra-Deploy

Sebelum website ini go-live, hasil code review keamanan (`security-review-fredianfarm.md`, dibuat 2026-08-04) mencantumkan beberapa temuan yang **wajib diselesaikan**:

| # | Temuan | Level | Terkait section PRD |
|---|--------|-------|----------------------|
| 1 | Harga checkout publik tidak divalidasi ulang di server | 🔴 Tinggi | Section 4.4 |
| 2 | Field `deskripsi` produk tidak di-sanitasi (purify) sebelum tampil | 🔴 Tinggi | Section 4.1 |
| 3 | Tidak ada rate limiting (login, kontak, checkout, tracking, AI generator) | 🔴 Tinggi | Section 11.7 |
| 4 | `trustProxies` mempercayai semua proxy | 🟠 Sedang | — |
| 5 | Pembacaan `.env` manual di service AI | 🟠 Sedang | Section 11 |
| 6 | Default role di level database adalah `admin`, bukan `editor` | 🟠 Sedang | Section 5 |
| 7 | Dependency `laravel-permission` ter-install tapi tidak dipakai | 🟠 Sedang | Section 2 |

Detail lengkap, lokasi kode, dan rekomendasi perbaikan ada di file `security-review-fredianfarm.md` — dokumen tersebut adalah rujukan utama untuk item-item yang harus diselesaikan sebelum deploy ke production. PRD ini akan diperbarui lagi (v1.3) setelah semua temuan 🔴 selesai diperbaiki dan diverifikasi.
