# 🚀 Training Project

![Banner](public/images/Banner.png)

Aplikasi web Training hasil tugas PKL di PT. Dirgantara, dibangun dengan Laravel 12 untuk manajemen pelatihan, sertifikat, dan riwayat peserta.

[![Laravel Version](https://img.shields.io/badge/Laravel-12-red?logo=laravel)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.2+-blue?logo=php)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green)](LICENSE)
[![Commit Activity](https://img.shields.io/github/commit-activity/t/Yusril0956/Training-Project?label=Total%20Commits)](https://github.com/Yusril0956/Training-Project/commits)
[![Last Commit](https://img.shields.io/github/last-commit/Yusril0956/Training-Project?label=Last%20Commit)](https://github.com/Yusril0956/Training-Project/commits)
[![Contributors](https://img.shields.io/github/contributors/Yusril0956/Training-Project?label=Contributors)](https://github.com/Yusril0956/Training-Project/graphs/contributors)

---

## 📑 Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Fitur Utama](#-fitur-utama)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Screenshot](#-screenshot)
- [Kontributor](#-kontributor)
- [Prasyarat](#-prasyarat)
- [Instalasi & Setup](#-instalasi--setup)
  - [Clone Repository](#clone-repository)
  - [Persiapan Database](#persiapan-database)
  - [Install Dependencies](#install-dependencies)
  - [Generate Key & Link Storage](#generate-key--link-storage)
  - [Jalankan Aplikasi](#jalankan-aplikasi)
- [Penggunaan](#-penggunaan)
- [Troubleshooting](#-troubleshooting)
- [Kontribusi](#-kontribusi)
- [Lisensi](#-lisensi)

---

## 📖 Tentang Proyek

Training Project adalah aplikasi web yang dikembangkan sebagai bagian dari tugas PKL di PT. Dirgantara. Aplikasi ini dirancang untuk memfasilitasi manajemen pelatihan internal perusahaan, termasuk pengelolaan peserta, sertifikat, tugas, dan riwayat pelatihan. Dibangun dengan framework Laravel terbaru untuk memastikan performa dan keamanan yang optimal.

---

## ✨ Fitur Utama

- **Manajemen Pengguna**: Registrasi, login, dan pengelolaan profil pengguna dengan role-based access.
- **Manajemen Pelatihan**: Buat, edit, dan kelola jadwal pelatihan serta detailnya.
- **Sertifikat**: Generate dan unduh sertifikat dalam format PDF untuk peserta yang menyelesaikan pelatihan.
- **Tugas & Penugasan**: Buat tugas, kumpulkan submission, dan berikan feedback.
- **Kehadiran**: Tracking kehadiran peserta dalam pelatihan.
- **Notifikasi**: Sistem notifikasi untuk update pelatihan dan tugas.
- **Dashboard**: Tampilan dashboard untuk admin dan peserta dengan statistik real-time.
- **Feedback**: Sistem feedback untuk evaluasi pelatihan.

---

## 🛠️ Teknologi yang Digunakan

![HTML5](https://img.shields.io/badge/Code-HTML5-orange?logo=html5)
![CSS3](https://img.shields.io/badge/Style-CSS3-blue?logo=css3)
![JavaScript](https://img.shields.io/badge/Logic-JavaScript-yellow?logo=javascript)
![PHP](https://img.shields.io/badge/Backend-PHP-777BB4?logo=php)
![Laravel](https://img.shields.io/badge/Framework-Laravel-red?logo=laravel)
![MySQL](https://img.shields.io/badge/Database-MySQL-4479A1?logo=mysql)
![DomPDF](https://img.shields.io/badge/PDF-DomPDF-FF6B35?logo=adobe-acrobat-reader)

---

## 📸 Screenshot

### Dashboard Utama
![Dashboard](public/images/default-training.jpg)

### Halaman Sertifikat
![Sertifikat](public/images/SertifikatPenghargaan.png)

---

## 👨‍💻 Kontributor

<table>
  <tr>
    <td align="center">
      <a href="https://github.com/Reqi2007">
        <img src="https://github.com/Reqi2007.png?size=100" width="100" alt="Refan"/>
        <br/>
        <sub><b>Refan</b></sub>
      </a>
      <br/>💻 Fullstack Developer
    </td>
    <td align="center">
      <a href="https://github.com/Yusril0956">
        <img src="https://github.com/Yusril0956.png?size=100" width="100" alt="Yusril"/>
        <br/>
        <sub><b>Yusril</b></sub>
      </a>
      <br/>💻 Fullstack Developer
    </td>
    <td align="center">
      <a href="https://github.com/ehan4426-pixel">
        <img src="https://github.com/ehan4426-pixel.png?size=100" width="100" alt="Raihan"/>
        <br/>
        <sub><b>Raihan</b></sub>
      </a>
      <br/>🤝 Support Developer
    </td>
    <td align="center">
      <a href="https://github.com/vein13046-ui">
        <img src="https://github.com/vein13046-ui.png?size=100" width="100" alt="Daelingka"/>
        <br/>
        <sub><b>Daelingka</b></sub>
      </a>
      <br/>🤝 Support Developer
    </td>
  </tr>
</table>

---

## 📋 Prasyarat

Sebelum menjalankan aplikasi, pastikan sistem Anda memenuhi persyaratan berikut:

- **PHP**: Versi 8.2 atau lebih tinggi
- **Composer**: Untuk manajemen dependensi PHP
- **Node.js & NPM**: Untuk asset frontend (opsional)
- **Database**: MySQL atau SQLite
- **Web Server**: Apache atau Nginx (untuk production)

---

## 🚀 Instalasi & Setup

### Clone Repository

```bash
git clone https://github.com/Yusril0956/Training-Project.git
cd Training-Project
```

### Persiapan Database

1. Rename atau sesuaikan file `.env.example` menjadi `.env`.
2. Pilih database:
   - **MySQL**: Atur `DB_CONNECTION=mysql`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.
   - **SQLite**: Atur `DB_CONNECTION=sqlite` lalu buat file `database/database.sqlite`.

### Install Dependencies

```bash
composer install
npm install   # jika ada asset frontend
```

### Generate Key & Link Storage

```bash
php artisan key:generate
php artisan storage:link
```

### Migrasi & Seed

```bash
php artisan migrate
php artisan db:seed
```

### Jalankan Aplikasi

```bash
php artisan serve
```

Akses di `http://127.0.0.1:8000`.

---

## 📖 Penggunaan

1. **Login**: Gunakan akun admin atau peserta yang telah di-seed.
2. **Dashboard**: Lihat statistik dan navigasi menu.
3. **Manajemen Pelatihan**: Buat pelatihan baru, tambah peserta, dan kelola jadwal.
4. **Sertifikat**: Generate sertifikat untuk peserta yang lulus.
5. **Tugas**: Buat tugas, lihat submission, dan berikan nilai.

---

## 🛠️ Troubleshooting

- **Error `vendor/autoload.php` not found**
  ```bash
  composer install
  # atau jika tidak ada composer.lock
  composer update
  ```
- **Error login admin**
  Pastikan seed berhasil dijalankan:
  ```bash
  php artisan migrate --seed
  ```
- **Missing APP_KEY**
  ```bash
  php artisan key:generate
  ```
- **Cache issues**
  ```bash
  php artisan config:clear
  php artisan cache:clear
  ```
- **Upload gambar tidak muncul**
  ```bash
  php artisan storage:link
  ```
- **Generate PDF sertifikat**
  ```bash
  composer require barryvdh/laravel-dompdf
  php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"
  ```

---

## 🤝 Kontribusi

Kami menyambut kontribusi dari komunitas! Untuk berkontribusi:

1. Fork repository ini.
2. Buat branch fitur baru (`git checkout -b feature/AmazingFeature`).
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`).
4. Push ke branch (`git push origin feature/AmazingFeature`).
5. Buat Pull Request.

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

> Jangan lupa jalankan semua artisan command sebelum testing. Semoga membantu! 🌟
