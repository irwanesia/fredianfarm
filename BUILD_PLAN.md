# Build Plan — Fredian Farm

> File ini mencatat setiap tahapan build secara berurutan.
> Setiap langkah: plan → execute → update → next.

---

## Status Pekerjaan

| No | Tahap | Status |
|----|-------|--------|
| 1 | Dockerfile + entrypoint.sh | done |
| 2 | Integrasi ke docker-compose.yml | done |
| 3 | Build container & Laravel install | done |
| 4 | Install Composer packages | done |
| 5 | Install NPM packages & Vite setup | done |
| 6 | Tabler integration (layout public + admin) | done |
| 7 | Database migrations (12 tabel) | done |
| 8 | Models & relationships | done |
| 9 | TinyMCE + image upload handler | done |
| 10 | CRUD Produk + Kategori Produk | done |
| 11 | CRUD Artikel + Kategori Artikel (dengan AI generator) | done |
| 12 | Galeri, Testimoni, FAQ, Banner, Media Sosial CRUD | done |
| 13 | Settings page (site info, social media) | done |
| 14 | Public pages (Tabler layout) | pending |
| 15 | SEO: sitemap, slug, meta, schema.org | pending |
| 16 | Final testing & polish | pending |

---

## Log Progress

| Tanggal | Langkah | Catatan |
|---------|---------|---------|
| 18 Jul 2026 | 1 | Dockerfile + entrypoint.sh dibuat — ikut pola project lain di repo |
| 18 Jul 2026 | 2 | Service fredianfarm ditambahkan ke docker-compose.yml (port 8098, DB: mysql_core) |
| 18 Jul 2026 | 3 | Image built, Laravel 13 installed via composer di container, .env di-set untuk MySQL, DB fredianfarm_db dibuat, migrasi default berjalan, HTTP 200 OK di localhost:8098 |
| 18 Jul 2026 | 4 | 10 Composer packages terinstall: medialibrary, sitemap, sluggable, honeypot, permission, activitylog, intervention/image, livewire, purifier, debugbar |
| 18 Jul 2026 | 5+6 | NPM packages (Tabler, Alpine, Swiper, Choices, ApexCharts, TinyMCE, LightGallery) terinstall. Layout public & admin dengan Tabler dibuat dan berfungsi (HTTP 200, CSS/JS loaded). Warna branding Fredian Farm (#2E7D32, #8D6E63, #F9A825) diintegrasikan. |
| 18 Jul 2026 | 7 | 12 tabel database + spatie permissions migration berjalan. Total 16 tabel (termasuk users, cache, jobs default). |
| 18 Jul 2026 | 8 | 12 Models + relationships (Sluggable, MediaLibrary traits) |

---

## Detail Setiap Tahap

*(akan diisi saat tiap tahap dimulai)*
