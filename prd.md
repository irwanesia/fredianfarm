# PRD — Fredian Farm

**Produk**: Website Penjualan Bibit Kentang
**Versi**: 1.1
**Stack**: Laravel 11 + PHP 8.3 + Tabler (all)

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
| Framework | Laravel 11 |
| PHP | PHP 8.3 |
| Database | MySQL 8.0 / MariaDB 10.x |
| Web Server | Apache (php:8.3-apache) |
| AI/LLM | Google Gemini API (via HTTP Client Laravel) |

### Frontend

| Komponen | Pilihan |
|----------|---------|
| Admin Template | Tabler (Bootstrap 5) |
| CSS Framework | Bootstrap 5.3 |
| Interactive JS | Alpine.js |
| Asset Bundler | Vite |
| Node.js | 20 LTS |

### Package (Composer)

| Package | Fungsi |
|---------|--------|
| `spatie/laravel-medialibrary` | Manajemen gambar (produk, galeri, banner, testimoni) |
| `spatie/laravel-sitemap` | Generate sitemap.xml otomatis |
| `spatie/laravel-sluggable` | SEO-friendly URL |
| `spatie/laravel-honeypot` | Anti-spam form kontak |
| `spatie/laravel-permission` | Role & permission multi-admin |
| `spatie/laravel-activitylog` | Audit trail CMS |
| `intervention/image` | Resize & optimasi gambar |
| `livewire/livewire` | Komponen dinamis tanpa JS |
| `mews/purifier` | Sanitasi HTML artikel |
| `barryvdh/laravel-debugbar` | Debugging (dev) |

### Image & Editor

| Komponen | Pilihan | Keterangan |
|----------|---------|------------|
| Rich Text Editor | **TinyMCE** | Komponen Tabler, support drag & drop image upload |
| Image Format | **WebP** | Auto-konversi dari JPG/PNG via intervention/image |
| Image Quality | **80%** | Balance ukuran file vs kualitas visual |
| Image Storage | `storage/app/public/artikel/` | Symlink ke `public/storage/artikel/` |

### Package (NPM)

| Package | Fungsi |
|---------|--------|
| `@tabler/core` | Tabler UI Kit |
| `alpinejs` | Interaktivitas frontend |
| `choices.js` | Dropdown filter produk |
| `swiper` | Slider (hero, galeri, testimoni) |
| `lightgallery` | Galeri foto lightbox |
| `apexcharts` | Chart dashboard admin |
| `tinymce` | Rich text editor untuk artikel |

---

## 3. Arsitektur

Tabler digunakan untuk **seluruh website** — baik halaman publik maupun admin panel. Satu source CSS/JS via `@tabler/core`, di-compile dengan Vite.

- **Halaman publik**: layout Tabler public (navbar, hero, cards, grid)
- **Admin panel**: layout Tabler dashboard (sidebar, datatables, forms, charts)
- **Blade components** reusable: card produk, breadcrumb, schema.org structured data, dll.

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
| Produk | Grid produk + filter (varietas, musim tanam, ketinggian, berat, ketersediaan) |
| Detail Produk | Foto, deskripsi, spesifikasi, sertifikat, keunggulan, cara tanam, usia panen, FAQ produk, tombol WA |
| Cara Pemesanan | Flow: Pilih → Hubungi Admin → Konfirmasi → Bayar → Kirim → Terima |
| Blog | Daftar artikel + kategori (Budidaya, Bibit, Pemupukan, Penyakit, Panen, Teknologi) |
| Detail Artikel | Gambar, heading, TOC, konten, FAQ, related articles |
| Galeri | Foto kebun, gudang, bibit, sortir, packing, pengiriman |
| Testimoni | Foto, video, review, nama, daerah |
| FAQ | Accordion pertanyaan umum |
| Kontak | Alamat, Google Maps, WA, email, IG, FB, YT, jam operasional, form kontak |
| Kebijakan Privasi | Kebijakan privasi |

### 4.2 Admin CMS

| Modul | Fungsi |
|-------|--------|
| Dashboard | Statistik (produk populer, artikel terbaru, kontak masuk) |
| Produk | CRUD produk + gambar + stok |
| Kategori Produk | CRUD kategori (varietas) |
| Artikel | CRUD artikel + gambar + kategori + **AI Generate** (judul & konten otomatis) |
| Kategori Artikel | CRUD kategori blog |
| Galeri | CRUD foto galeri |
| Testimoni | CRUD testimoni + foto/video |
| FAQ | CRUD pertanyaan-jawaban |
| Banner | CRUD slider hero |
| Media Sosial | Kelola link WA, IG, FB, YT |
| Profil Perusahaan | Edit setting perusahaan |
| Kontak | Lihat & kelola pesan masuk (lead management) |
| SEO | Meta global, sitemap, robots.txt |
| Pengguna | CRUD admin + role/permission |

### 4.3 Fitur Tambahan

- **WhatsApp CTA** pada setiap halaman produk dan artikel
- **Permintaan Penawaran (RFQ)** untuk pembelian jumlah besar
- **Lead Management** — menyimpan data calon pelanggan dari form kontak
- **Manajemen Stok** — status: Tersedia, Terbatas, Pre-order
- **Riwayat Populer** — dashboard menampilkan artikel & produk paling diminati
- **AI Content Generator** — generate judul & konten artikel otomatis via Google Gemini (detail di section 11)

---

## 5. Database (12 tabel)

| Tabel | Keterangan |
|-------|------------|
| `users` | Admin CMS + role |
| `kategori_produk` | Varietas bibit kentang |
| `produk` | Data bibit (spesifikasi sebagai JSON field) |
| `gambar_produk` | Relasi hasMany ke media |
| `kategori_artikel` | Kategori blog |
| `artikel` | Konten blog + field `ai_generated` (boolean) |
| `galeri` | Foto perusahaan/kegiatan |
| `testimoni` | Review pelanggan |
| `faq` | Pertanyaan umum |
| `banner` | Hero slider |
| `media_sosial` | Link sosial media |
| `setting` | Profil perusahaan, kontak, SEO global |

Relasi:

```
kategori_produk → produk → gambar_produk
kategori_artikel → artikel
users → semua modul (created_by)
```

---

## 6. SEO Requirements

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
- WebP conversion untuk semua gambar artikel (ukuran file lebih kecil 25-35% dibanding JPG/PNG)

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

Kesan: alami, profesional, terpercaya, modern — sesuai branding bibit kentang.

### Typography

Mengikuti font default Tabler (Inter / system-ui), dengan heading styles yang disesuaikan.

---

## 8. Struktur Navigasi

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

## 9. Alur Pemesanan

```
Pilih Bibit → Hubungi Admin (WA) → Konfirmasi → Pembayaran → Pengiriman → Bibit Diterima
```

Tidak ada keranjang/payment gateway — menggunakan sistem inquiry-based (hubungi admin via WhatsApp).

---

## 10. Batasan & Catatan

- **Tidak ada** payment gateway
- **Tidak ada** keranjang belanja online
- **Tidak ada** multi-bahasa (fase awal)
- **Ada** permintaan penawaran (RFQ) untuk partai besar
- **Ada** lead management dari form kontak
- **Ada** AI Content Generator untuk artikel (Google Gemini)
- Semua konten dikelola via admin CMS (tidak perlu coding untuk update konten)

---

## 11. AI Content Generator (Google Gemini)

### 11.1 Ringkasan

Fitur AI terintegrasi di admin CMS untuk membantu pembuatan konten blog. Menggunakan **Google Gemini API** (free tier: 60 request/menit) via HTTP Client bawaan Laravel. Proses dilakukan secara **realtime (synchronous)** — hasil langsung muncul tanpa queue.

### 11.2 Generate Judul

1. Admin masuk ke halaman **Artikel > Generate AI**
2. Klik tombol **"Generate 10 Judul"**
3. Request ke Gemini dengan prompt template:

```
Kamu adalah asisten konten untuk website bibit kentang "Fredian Farm".
Buatkan 10 judul artikel blog tentang bibit kentang.
Topik: budidaya, penyakit kentang, pemupukan, panen, bibit, teknologi pertanian.
Gaya bahasa: informatif, mudah dipahami petani.
Format: output hanya angka 1-10 dengan judul saja, tanpa deskripsi.
```

4. 10 judul tampil sebagai card list di UI
5. Setiap judul memiliki tombol **"Generate Konten"**

### 11.3 Generate Konten

1. Admin memilih salah satu judul → klik **"Generate Konten"**
2. Artikel tersimpan ke database dengan status **draft**, field `ai_generated = true`
3. Request ke Gemini dengan prompt template:

```
Kamu adalah asisten konten untuk website bibit kentang "Fredian Farm".
Buatkan artikel blog lengkap untuk judul: "{judul_terpilih}".

Struktur artikel:
- Paragraf pembuka (2-3 kalimat)
- 3-5 sub-heading (h2) dengan penjelasan masing-masing
- Kesimpulan (2-3 kalimat)
- FAQ (3-5 pertanyaan + jawaban)

Gaya penulisan: informatif, praktis, mudah dipahami petani kentang Indonesia.
Panjang: 500-800 kata.
Format: HTML (h2 untuk sub-heading, p untuk paragraf, ul/li untuk list).
```

4. Hasil konten langsung dimasukkan ke **TinyMCE editor**
5. Admin bisa **review, edit, dan menambahkan gambar** sebelum publish

### 11.4 Alur Gambar di Editor

```
Admin buka artikel di TinyMCE
  ↓
Baca hasil AI, edit konten
  ↓
Drag & drop gambar (JPG/PNG) ke editor
  ↓
Auto-upload ke server → konversi ke WebP (quality 80%)
  ↓
Gambar muncul di editor → admin atur posisi & alt text
  ↓
Publish artikel
```

### 11.5 Spesifikasi Gambar

| Aspek | Detail |
|-------|--------|
| Format Upload | JPG, PNG, WEBP |
| Format Simpan | **WebP Only** (97% browser modern support) |
| Kualitas | 80% — hasil visual hampir sama dengan original |
| Ukuran Max | 5MB per file (via server validation) |
| Alt Text | Wajib diisi untuk SEO (validasi client-side) |
| Lazy Loading | Default `loading="lazy"` di tag `<img>` |

### 11.6 Prompt Engineering Notes

- Prompt judul & konten dipisah agar hasil lebih presisi
- Prompt konten menyertakan instruksi format HTML untuk kompatibilitas dengan TinyMCE
- Prompt bisa dikembangkan seiring waktu (ditambah contoh artikel, tone suara, dll.)
- Template prompt disimpan di config Laravel agar mudah diubah tanpa deploy

### 11.7 Keamanan

- API Key Gemini disimpan di `.env` (`GEMINI_API_KEY`)
- Rate limiting per admin (misal maksimal 5 generate konten per jam)
- Semua hasil generate tetap harus **di-review admin** sebelum publish (tidak auto-publish)
