```markdown
# 🚀 Training Project

Aplikasi web Training hasil tugas PKL di PT. Dirgantara, dibangun dengan Laravel 12 untuk manajemen pelatihan, sertifikat, dan riwayat peserta.

[![Commit Activity](https://img.shields.io/github/commit-activity/t/Yusril0956/Training-Project?label=Total%20Commits)](https://github.com/Yusril0956/Training-Project/commits)  
[![Last Commit](https://img.shields.io/github/last-commit/Yusril0956/Training-Project?label=Last%20Commit)](https://github.com/Yusril0956/Training-Project/commits)  
[![Contributors](https://img.shields.io/github/contributors/Yusril0956/Training-Project?label=Contributors)](https://github.com/Yusril0956/Training-Project/graphs/contributors)

---

## 📑 Table of Contents

- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)  
- [Kontributor](#-kontributor)  
- [Instalasi & Setup](#-instalasi--setup)  
  - [Clone Repository](#clone-repository)  
  - [Persiapan Database](#persiapan-database)  
  - [Install Dependencies](#install-dependencies)  
  - [Generate Key & Link Storage](#generate-key--link-storage)  
  - [Jalankan Aplikasi](#jalankan-aplikasi)  
- [Troubleshooting](#-troubleshooting)  

---

## 🛠️ Teknologi yang Digunakan

![HTML5](https://img.shields.io/badge/Code-HTML5-orange?logo=html5)  
![CSS3](https://img.shields.io/badge/Style-CSS3-blue?logo=css3)  
![JavaScript](https://img.shields.io/badge/Logic-JavaScript-yellow?logo=javascript)  
![PHP](https://img.shields.io/badge/Backend-PHP-777BB4?logo=php)  
![Laravel](https://img.shields.io/badge/Framework-Laravel-red?logo=laravel)

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

## 🚀 Instalasi & Setup

### Clone Repository

```bash
git clone https://github.com/Yusril0956/Training-Project.git
cd Training-Project
```

### Persiapan Database

1. Rename atau sesuaikan file `.env.example` menjadi `.env`.  
2. Pilih database:
   - **MySQL**: atur `DB_CONNECTION=mysql`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.  
   - **SQLite**: atur `DB_CONNECTION=sqlite` lalu buat file `database/database.sqlite`.  

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

> Jangan lupa jalankan semua artisan command sebelum testing. Semoga membantu!  

```
