# IceScoop (CodeIgniter 3 + MySQL)

E-commerce es krim dengan UI pink modern, role user/admin, katalog, keranjang, checkout dengan map, ongkir berbasis berat, tracking pesanan, blog, notifikasi, review, event donasi, chat, dan analitik finansial.

## Setup

1) Buat database MySQL bernama `icescoop` (via phpMyAdmin).
2) Import SQL:
   - `sql/schema.sql`
   - `sql/seed.sql`
3) Konfigurasi koneksi DB (jika perlu) di `application/config/database.php`.
4) Pastikan base URL sesuai (default: `http://localhost/icescoop/`) di `application/config/config.php`.
5) Pastikan folder upload writeable: `public/assets/img/uploads`.

## Jalankan

- Akses frontend: `http://localhost/icescoop/`
- Login admin: email `admin@icescoop.local`, password `admin` (ganti hash di seed untuk real use). Masuk via `/login` lalu otomatis redirect ke `/admin` jika role admin.

## Fitur utama
- Katalog dengan filter/pencarian, Most Popular & Discount.
- Keranjang & Checkout (Leaflet map, tag Rumah/Kantor). Ongkir 5k/kg dibulatkan ke atas.
- Tracking order (Placed → Processed → Shipped → Out for delivery → Delivered).
- Blog & Review produk (moderasi admin).
- Notifikasi dasar (polling endpoint `/notifications/pull`).
- Chat user–admin sederhana.
- Admin dashboard: Products CRUD, Orders (ubah status), Blog CRUD, Banners, Events, Finance (input expense + ringkas revenue dari order), Reviews moderation, Chat.

## Catatan keamanan
- CSRF aktif, XSS filtering global, password hash `password_hash`.
- Throttle login sederhana (MAX_LOGIN_ATTEMPTS).
- Validasi upload gambar pada admin products/banners.

## TODO/Improvement
- Tambah Chart.js untuk grafik.
- Perbaiki relasi nama user/produk pada tabel admin (tampilkan nama lengkap).
- Tambah pagination di semua listing admin.
- Ubah storage session ke database untuk skala lebih besar.
