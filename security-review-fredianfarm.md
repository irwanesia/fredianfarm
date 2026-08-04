# Security Review — Fredian Farm
**Tanggal review**: 2026-08-04
**Scope**: `app/`, `config/`, `resources/`, `routes/`, `bootstrap/`, `database/` (dari `fredianfarm-code.zip`)
**Catatan**: file `.env` asli, `composer.json/lock`, dan test suite tidak disertakan — beberapa hal (versi dependency, isi env production) tidak bisa diverifikasi dari review ini.

---

## 🔴 Tinggi — perbaiki sebelum deploy

### 1. Harga di checkout publik dipercaya mentah dari client
**Lokasi**: `app/Http/Controllers/PublicController.php` → `checkout()`
**Masalah**: `subtotal` dan `harga` per-item diambil langsung dari JSON yang dikirim browser (`$request->items`, `$request->subtotal`) tanpa dicocokkan ke harga asli di tabel `produk`/`produk_variant`. Siapa pun bisa mengubah nilai ini lewat DevTools sebelum submit. Order tersimpan ke DB dengan harga palsu dan ikut terkirim ke pesan WA ke admin.
**Bandingkan dengan**: `OrderController::store()` (versi admin/manual) sudah benar — menghitung ulang harga dari DB.
**Rekomendasi**: Di `checkout()`, ambil `produk_id`/`variant_id` dari tiap item, lookup harga asli dari DB, hitung `subtotal`/`grand_total` di server — persis seperti logika yang sudah ada di `OrderController::store()`. Abaikan field harga yang dikirim client.

### 2. `deskripsi` produk dirender sebagai HTML mentah tanpa sanitasi
**Lokasi**: `resources/views/public/produk/show.blade.php` baris ~120 (`{!! $produk->deskripsi !!}`)
**Masalah**: Field `deskripsi` cuma divalidasi `nullable|string` (di `StoreProdukRequest`/`UpdateProdukRequest`), tidak dilewatkan `Purifier::clean()` seperti `konten` artikel. Kalau akun admin/editor disusupi atau salah satu akun disalahgunakan, field ini bisa jadi jalur stored XSS ke semua pengunjung publik.
**Rekomendasi**: Terapkan `Purifier::clean()` pada `deskripsi` di `ProdukController::store()`/`update()`, konsisten dengan penanganan `konten` artikel. Atau jika deskripsi memang seharusnya plain text, ganti `{!! !!}` jadi `{{ }}` (escape otomatis) — tidak perlu HTML mentah sama sekali.

### 3. Tidak ada rate limiting di endpoint publik & login
**Lokasi**: `routes/web.php` (`/login`, `/kontak`, `/checkout`, `/tracking`, `admin/ai-artikel/{action}`); dikonfirmasi juga di `bootstrap/app.php` — tidak ada `RateLimiter::for()` custom yang didefinisikan.
**Masalah**:
- `/login` rawan brute force (tidak ada throttle sama sekali).
- `/kontak` cuma dilindungi honeypot (`spatie/laravel-honeypot`) — mudah dilewati bot yang menjalankan JS.
- `/tracking` bisa di-brute-force kombinasi `order_number` (formatnya predictable: `FRD-YYYYMMDD-0001`) + nomor WA, untuk mengintip nama & data pesanan orang lain.
- `admin/ai-artikel/{action}` tidak dibatasi — PRD sudah menyebutkan target "maksimal 5 generate konten per jam" tapi **tidak diimplementasikan di kode**. Berisiko menghabiskan kuota API Gemini/Groq.
**Rekomendasi**: Tambahkan middleware `throttle` pada masing-masing route, contoh:
```php
Route::post('/login', ...)->middleware('throttle:5,1');
Route::post('/checkout', ...)->middleware('throttle:10,1');
Route::get('/tracking', ...)->middleware('throttle:10,1');
Route::post('ai-artikel/{action}', ...)->middleware('throttle:5,60'); // 5x/jam sesuai PRD
```

---

## 🟠 Sedang

### 4. `trustProxies(at: '*')` mempercayai semua proxy
**Lokasi**: `bootstrap/app.php`
```php
$middleware->trustProxies(at: '*');
```
**Masalah**: Konfigurasi ini mempercayai header `X-Forwarded-For` / `X-Forwarded-Host` / `X-Forwarded-Proto` dari **siapa pun**, bukan hanya reverse proxy/load balancer resmi. Kalau nanti ada fitur yang bergantung pada IP address request (rate limiting per-IP, logging, blokir IP), header ini bisa dipalsukan oleh attacker langsung karena tidak dibatasi ke IP proxy tertentu.
**Rekomendasi**: Ganti `'*'` dengan IP/range spesifik dari reverse proxy/load balancer yang benar-benar dipakai di production (misalnya IP internal Docker network atau IP load balancer cloud provider), bukan wildcard.

### 5. `GeminiService`/`GroqService` membaca `.env` langsung sebagai fallback
**Lokasi**: `app/Services/GeminiService.php`, `app/Services/GroqService.php` → `resolveApiKey()`
**Masalah**: Kalau `config('services.gemini.api_key')` kosong, kode membaca ulang file `.env` mentah via `file_get_contents()` + regex. Bukan lubang keamanan langsung, tapi pola tidak lazim di Laravel — bisa membingungkan kalau nanti pakai `php artisan config:cache`, dan menambah titik akses file `.env` yang tidak perlu.
**Rekomendasi**: Hilangkan fallback ini, cukup andalkan `config('services.gemini.api_key')`. Pastikan `.env` sudah benar terisi sebelum deploy.

### 6. Default role kolom `users` di level database adalah `admin`
**Lokasi**: `database/migrations/2026_08_02_000001_add_role_to_users_table.php`
```php
$table->enum('role', ['admin', 'editor'])->default('admin')->after('email');
```
**Masalah**: Di level aplikasi (`PenggunaController::store()`) sudah defensif — default ke `'editor'` kalau role tidak diisi. Tapi default di level skema DB tetap `'admin'`. Kalau ada baris user dibuat lewat jalur lain (seeder baru, tinker, query manual) tanpa eksplisit set role, otomatis jadi admin penuh — bukan prinsip least-privilege.
**Rekomendasi**: Ubah default kolom jadi `'editor'` di migration (atau migration baru untuk ubah default), supaya default paling aman berlaku di semua lapisan, bukan cuma di controller.

### 7. `spatie/laravel-permission` ter-install & bermigrasi tapi tidak dipakai
**Lokasi**: `database/migrations/2026_07_18_141415_create_permission_tables.php` ada, tapi tidak ditemukan pemakaian `HasRoles`/`hasRole()`/`assignRole()` di `app/`.
**Masalah**: Bukan celah keamanan, tapi dependency & tabel tidak terpakai menambah permukaan (surface) tanpa manfaat — sistem role sebenarnya cuma kolom `role` enum + middleware custom `EnsureUserRole`. 
**Rekomendasi**: Kalau tidak akan dipakai, pertimbangkan uninstall package + drop tabel permission untuk menyederhanakan; kalau rencana ke depan mau pakai, dokumentasikan supaya developer lain tidak bingung ada 2 sistem role paralel.

---

## 🟢 Rendah / Hardening

### 8. Tidak ada index pada kolom yang dipakai fitur pencarian
**Lokasi**: `produk.nama`, `produk.deskripsi`, `artikel.judul`, `artikel.konten` — dipakai di `PublicController::search()` dan `produkIndex()`/`blogIndex()` dengan `LIKE '%...%'`.
**Catatan**: Ini isu performa, bukan keamanan — tapi kalau data produk/artikel sudah banyak, query `LIKE` tanpa index full-text akan lambat.
**Rekomendasi**: Pertimbangkan full-text index (`FULLTEXT` di MySQL) untuk kolom-kolom ini kalau volume data mulai besar.

### 9. Format nomor pesanan predictable
**Lokasi**: `PublicController::checkout()`, `OrderController::store()` — format `FRD-YYYYMMDD-0001` (incremental).
**Catatan**: Bukan bug berdiri sendiri, tapi memperbesar dampak temuan #3 (tracking bisa di-brute-force). Sudah cukup ditangani asal rate limiting di #3 diterapkan.

### 10. File `database/database.sqlite` ikut ter-bundle (kosong, 0 byte)
**Catatan**: Sudah benar di-gitignore lewat `database/.gitignore` (`*.sqlite*`), jadi ini bukan masalah nyata — hanya konfirmasi bahwa file lokal ini tidak akan ikut ter-commit ke repo.

---

## Ringkasan Prioritas

| # | Temuan | Level | Effort perbaikan |
|---|--------|-------|-------------------|
| 1 | Harga checkout publik tidak divalidasi server-side | 🔴 Tinggi | Sedang |
| 2 | `deskripsi` produk tidak di-purify (stored XSS) | 🔴 Tinggi | Kecil |
| 3 | Tidak ada rate limiting (login, kontak, checkout, tracking, AI) | 🔴 Tinggi | Kecil |
| 4 | `trustProxies(at: '*')` | 🟠 Sedang | Kecil |
| 5 | Baca `.env` manual di GeminiService/GroqService | 🟠 Sedang | Kecil |
| 6 | Default role DB = admin | 🟠 Sedang | Kecil |
| 7 | Dependency `laravel-permission` tidak terpakai | 🟠 Sedang | Kecil (opsional) |
| 8 | Tidak ada index kolom pencarian | 🟢 Rendah | Kecil |
| 9 | Nomor pesanan predictable | 🟢 Rendah | — (mitigasi via #3) |
| 10 | `database.sqlite` ikut ter-bundle | 🟢 Info | — (sudah aman) |

## Sudah Baik (tidak perlu diubah)
- Upload gambar (produk, galeri, TinyMCE) di-decode ulang & di-encode ke WebP via Intervention Image — efektif membuang payload berbahaya dalam file gambar.
- `Purifier::clean()` sudah diterapkan pada `konten` artikel (input & AI-generated content).
- `PenggunaController` mencegah admin menurunkan role/menghapus akun sendiri.
- `OrderController::store()` (admin) menghitung ulang harga dari DB, tidak percaya input form.
- Pemisahan middleware `auth` vs `role:admin` pada route sensitif (setting, pengguna, kontak, orders, bank) sudah tepat.
- Ikon SVG statis di halaman galeri publik tidak dari input user, aman meski dirender `{!! !!}`.

## Belum Bisa Dinilai (file tidak disertakan)
- `.env` production (isi asli, apakah ada secret yang keliru ter-commit)
- `composer.json`/`composer.lock` — versi dependency & hasil `composer audit`
- Test suite (kalau ada) untuk validasi regresi setelah perbaikan

---

## Hasil Pengujian Penetrasi (Black-Box SQL Injection)
**Tanggal**: 2026-08-04 · **Target**: aplikasi berjalan (local Docker, `http://localhost:8098`)
**Metode**: payload tautologi (`' OR '1'='1`), komentar (`' OR 1=1-- -`), UNION, time-based (`SLEEP(3)`), wildcard (`%`, `_`). Deteksi: error SQL/SQLSTATE, delay ≥2.5s, verifikasi penyimpanan literal di DB.

| Endpoint | Metode | Hasil | Verifikasi |
|---|---|---|---|
| `/kontak` | POST | ✅ AMAN | Semua payload tersimpan literal, honeypot tolak submit <1 detik |
| `/login` | POST | ✅ AMAN | Semua payload gagal login, tanpa bypass auth |
| `/tracking` | GET | ✅ AMAN | Semua payload → 404 "tidak ditemukan", tanpa error/delay |
| `/cari` (search) | GET | ✅ AMAN | Semua payload → 200 normal, tanpa error/delay |
| `/checkout` | POST | ✅ AMAN | Payload di `customer_name`/`customer_address`/`items.nama` tersimpan literal; `produk_id`/`variant_id` di-cast int (harga dari DB); `variant_id` tak valid ditolak 422 |
| `admin/ai-artikel/{action}` | POST | ✅ AMAN (rate limit) | Throttle `5,60` terbukti: req #1–5 → HTTP 200 (panggilan Groq nyata), req #6 → HTTP 429 |

### ⚠️ Temuan baru dari pengujian: Stored XSS via checkout (sudah diperbaiki)
**Lokasi**: `resources/views/admin/order/index.blade.php:378-382` (`renderConfirm()`), `resources/views/layouts/public.blade.php:1014` (`cekPesanan()`)
**Alur serangan**: `checkout()` menyimpan `customer_name`/`customer_wa`/`customer_address` tanpa sanitasi (PublicController.php:181-183) → data mentah disajikan `/admin/orders/{id}/confirm` → JS `renderConfirm()` memasukkan `${o.customer_name}` dsb. ke `innerHTML` → **stored XSS dengan hak admin** saat admin membuka modal "Proses" (klik ⚙️). Versi publik (tracking modal) self-XSS severity rendah.
**Bukti**: order test dengan `customer_name=<img src=x onerror=alert(1)>` & `customer_address=<svg onload=alert(2)>` tersimpan mentah dan muncul mentah di JSON `/admin/orders/{id}/confirm`.
**Perbaikan (diterapkan)**: helper `esc()` (escape `& < > " '`) ditambahkan di kedua blade dan semua interpolasi data user dibungkus sebelum masuk `innerHTML`; `cekresi.com/...` kini `encodeURIComponent`. Data di DB tetap tersimpan apa adanya (hanya output yang di-escape).

**Catatan tambahan**:
- Rate limiter berfungsi: `/checkout` (10/menit) sempat mengembalikan 429 saat pengujian beruntun; `admin/ai-artikel` (5/jam) mengembalikan 429 tepat di request ke-6 — sesuai target PRD "maksimal 5 generate konten per jam".
- Test `admin/ai-artikel` memakai akun admin sementara (`admin@sqli.test`) yang dibuat & dihapus setelahnya; memicu 5 panggilan Groq nyata (kuota dipakai, tapi hasil sesuai throttle).
- Semua data pengujian (order test #8–13, kontak test, akun admin temp) sudah dihapus setelah pengujian.
- Semua query memakai parameterized binding / Eloquent `find()` + `(int)` cast; tidak ditemukan `DB::raw`/`whereRaw` di controller/model.
