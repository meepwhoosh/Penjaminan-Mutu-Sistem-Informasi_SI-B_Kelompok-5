# 🐾 Adopt A Buddy — Sistem Informasi Adopsi Hewan  
### ⭐ Proyek Penjaminan Sistem Informasi | Laravel

Selamat datang di repositori **Adopt A Buddy**, sebuah sistem informasi yang dirancang untuk mempermudah proses **adopsi hewan peliharaan** secara aman, terstruktur, dan terverifikasi.  
Proyek ini dibuat sebagai bagian dari mata kuliah **Penjaminan Sistem Informasi**.

---

## 🚀 Tentang Proyek  
**Adopt A Buddy** adalah aplikasi berbasis web yang bertujuan menyediakan platform bagi calon adopter dan shelter/penyedia hewan. Sistem memastikan informasi yang ditampilkan **akurat**, **aman**, dan **mudah diakses** melalui penerapan prinsip **quality assurance (QA)** di setiap tahap pengembangan.

### ✨ Fitur Utama  
- 🐶 **Manajemen Hewan** (input, update, ketersediaan adopsi)  
- 👤 **Registrasi & Login** (user & admin)  
- 📄 **Formulir Adopsi**  
- 📊 **Monitoring dan Validasi** proses adopsi  
- 🔐 **Keamanan data** pengguna dan hewan  
- 📱 **Antarmuka responsif dan ramah pengguna**  

---

## 🛠️ Teknologi yang Digunakan  

| Teknologi | Keterangan |
|----------|------------|
| **Laravel 10** | Framework utama aplikasi |
| **MySQL** | Database |
| **Blade Template** | Frontend |
| **Bootstrap / Tailwind** | UI styling |
| **GitHub** | Version control |
| **Composer & NPM** | Package management |

---

## 👥 Anggota Kelompok & Role  

| Nama | NIM | Peran |
|------|------|--------|
| **Sofia Ismar Hermansyah** | F52123052 | 🎯 Project Manager |
| **Annisa Diandra Wahani** | F52123053 | 🎨 UI/UX Designer |
| **Dede Al Fandi** | F52123058 | 🧠 Back-End Developer |
| **Dian Wulandari** | F52123060 | 💻 Front-End Developer |
| **Aura Rahmadani** | F52123061 | 🗄️ Database Engineer |

---

## 📂 Struktur Direktori

```bash
├── app/
│   ├── Http/
│   ├── Models/
│   ├── Controllers/
├── resources/
│   ├── views/
│   ├── css/
│   └── js/
├── public/
├── database/
│   ├── migrations/
│   └── seeders/
└── routes/
    └── web.php
````

---

## 🔧 Cara Menjalankan Proyek

1. **Clone repositori**

   ```bash
   git clone https://github.com/username/adopt-a-buddy.git
   cd adopt-a-buddy
   ```

2. **Install dependensi**

   ```bash
   composer install
   npm install
   npm run dev
   ```

3. **Salin file environment**

   ```bash
   cp .env.example .env
   ```

4. **Generate app key**

   ```bash
   php artisan key:generate
   ```

5. **Atur konfigurasi database, lalu migrate**

   ```bash
   php artisan migrate --seed
   ```

6. **Jalankan aplikasi**

   ```bash
   php artisan serve
   ```

---

## 🧪 Penjaminan Kualitas (Quality Assurance)

Proyek ini menerapkan QA melalui:

* ✔️ Validasi input di setiap form
* ✔️ Otentikasi & otorisasi (role user/admin)
* ✔️ Pengujian fungsi dasar (unit & manual testing)
* ✔️ Perlindungan keamanan (CSRF, SQL Injection, hashing password)
* ✔️ Dokumentasi pengembangan & hasil pengujian

---

## 🤝 Kontribusi

Kontribusi sangat terbuka!
Silakan buat **pull request** atau ajukan **issue** apabila menemukan bug atau ide fitur baru.

---

## 📜 Lisensi

Proyek ini dikembangkan untuk tujuan akademik dan pembelajaran.

---

## 💛 Terima Kasih

Terima kasih telah mengunjungi repositori **Adopt A Buddy**!
Semoga proyek ini bermanfaat, informatif, dan memberikan pengalaman terbaik bagi pengguna.

---
