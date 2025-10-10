# 🚀 Training Project

<div align="center">
  <img src="public/images/Banner.png" alt="Training Project Banner" width="100%">

  <p><strong>Aplikasi web Training hasil tugas PKL di PT. Dirgantara</strong></p>
  <p>Dibangun dengan Laravel 12 untuk manajemen pelatihan, sertifikat, dan riwayat peserta</p>

  <br>

  [![Laravel Version](https://img.shields.io/badge/Laravel-12-red?logo=laravel)](https://laravel.com)
  [![PHP Version](https://img.shields.io/badge/PHP-8.2+-blue?logo=php)](https://php.net)
  [![MySQL](https://img.shields.io/badge/Database-MySQL-4479A1?logo=mysql)](https://mysql.com)
  [![License](https://img.shields.io/badge/License-MIT-green)](LICENSE)
  <br>
  [![Commit Activity](https://img.shields.io/github/commit-activity/t/Yusril0956/Training-Project?label=Total%20Commits)](https://github.com/Yusril0956/Training-Project/commits)
  [![Last Commit](https://img.shields.io/github/last-commit/Yusril0956/Training-Project?label=Last%20Commit)](https://github.com/Yusril0956/Training-Project/commits)
  [![Contributors](https://img.shields.io/github/contributors/Yusril0956/Training-Project?label=Contributors)](https://github.com/Yusril0956/Training-Project/graphs/contributors)
</div>

---

## 📋 Table of Contents

- [🎯 About](#-about)
- [✨ Features](#-features)
- [🛠️ Tech Stack](#️-tech-stack)
- [👥 Contributors](#-contributors)
- [📋 Requirements](#-requirements)
- [🚀 Installation](#-installation)
- [🔧 Configuration](#-configuration)
- [🎮 Usage](#-usage)
- [🔍 API Documentation](#-api-documentation)
- [🛠️ Troubleshooting](#️-troubleshooting)
- [🤝 Contributing](#-contributing)
- [📄 License](#-license)

---

## 🎯 About

Training Project adalah aplikasi web yang dikembangkan sebagai bagian dari tugas PKL di **PT. Dirgantara**. Aplikasi ini dirancang untuk memfasilitasi manajemen pelatihan internal perusahaan, termasuk pengelolaan peserta, sertifikat, tugas, dan riwayat pelatihan.

Dibangun dengan framework **Laravel terbaru** untuk memastikan performa dan keamanan yang optimal, serta menggunakan **Livewire** untuk interaksi real-time yang smooth.

---

## ✨ Features

### 👨‍💼 Admin Features
- ✅ **User Management** - CRUD operations untuk pengguna dengan role-based access
- ✅ **Training Management** - Buat, edit, dan kelola jadwal pelatihan
- ✅ **Certificate Generation** - Generate dan unduh sertifikat PDF otomatis
- ✅ **Task Management** - Buat tugas, kelola submission, dan berikan feedback
- ✅ **Attendance Tracking** - Monitoring kehadiran peserta
- ✅ **Notification System** - Sistem notifikasi real-time
- ✅ **Dashboard Analytics** - Statistik real-time dan reporting

### 👨‍🎓 User Features
- ✅ **Training Registration** - Daftar dan ikuti pelatihan
- ✅ **Task Submission** - Upload tugas dan lihat feedback
- ✅ **Certificate Download** - Unduh sertifikat setelah lulus
- ✅ **Progress Tracking** - Monitor progress pembelajaran
- ✅ **Feedback System** - Berikan feedback untuk pelatihan

---

## 🛠️ Tech Stack

<div align="center">

| Component | Technology |
|-----------|------------|
| **Backend** | ![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?logo=php) ![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel) |
| **Frontend** | ![HTML5](https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white) ![CSS3](https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=white) ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?logo=javascript&logoColor=black) |
| **Database** | ![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white) |
| **Real-time** | ![Livewire](https://img.shields.io/badge/Livewire-4B5L5Y?logo=laravel&logoColor=white) |
| **PDF Generation** | ![DomPDF](https://img.shields.io/badge/DomPDF-FF6B35?logo=adobe-acrobat-reader&logoColor=white) |
| **UI Framework** | ![Tabler](https://img.shields.io/badge/Tabler-206BC4?logo=bootstrap&logoColor=white) |

</div>

### Dependencies
- **Laravel Framework** - Full-stack framework
- **Livewire** - Real-time frontend interactions
- **DomPDF** - PDF certificate generation
- **Tabler UI** - Modern admin interface
- **Alpine.js** - Lightweight JavaScript framework

---

## 👥 Contributors

<div align="center">

| [<img src="https://github.com/Reqi2007.png?size=100" width="100px;"><br /><sub><b>Refan</b></sub>](https://github.com/Reqi2007)<br />💻 Fullstack Developer | [<img src="https://github.com/Yusril0956.png?size=100" width="100px;"><br /><sub><b>Yusril</b></sub>](https://github.com/Yusril0956)<br />💻 Fullstack Developer | [<img src="https://github.com/ehan4426-pixel.png?size=100" width="100px;"><br /><sub><b>Raihan</b></sub>](https://github.com/ehan4426-pixel)<br />🤝 Support Developer | [<img src="https://github.com/vein13046-ui.png?size=100" width="100px;"><br /><sub><b>Daelingka</b></sub>](https://github.com/vein13046-ui)<br />🤝 Support Developer |
| :---: | :---: | :---: | :---: |

</div>

---

## 📋 Requirements

Sebelum menjalankan aplikasi, pastikan sistem Anda memenuhi persyaratan berikut:

### System Requirements
- **PHP**: `>= 8.2`
- **Composer**: Latest version
- **Node.js & NPM**: Latest LTS version (opsional)
- **Database**: MySQL 8.0+ atau SQLite 3.0+
- **Web Server**: Apache/Nginx atau built-in PHP server

### PHP Extensions
```
- BCMath
- Ctype
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PDO
- Tokenizer
- XML
```

---

## 🚀 Installation

### 1. Clone Repository
```bash
git clone https://github.com/Yusril0956/Training-Project.git
cd Training-Project
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Install Node Dependencies
```bash
npm install
```

### 4. Install Alpine Js
```bash
npm install alpinejs
```

### 5. Environment Configuration
```bash
cp .env.example .env
```

Edit `.env` file dengan konfigurasi database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=training_project
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Generate Application Key
```bash
php artisan key:generate
```

### 7. Database Setup
```bash
php artisan migrate
php artisan db:seed
```

### 8. Storage Link
```bash
php artisan storage:link
```

### 9. Build Assets (Optional)
```bash
npm run build
# atau untuk development
npm run dev
```

### 10. Require Livewire
```bash
composer require livewire/livewire
php artisan livewire:publish --assets
```

### 11. Require DomPDF
```bash
composer require barryvdh/laravel-dompdf
php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"
```

### 12. Start Application
```bash
php artisan serve
```

Akses aplikasi di: `http://127.0.0.1:8000`

---

## 🔧 Configuration

### Environment Variables
```env
# Application
APP_NAME="Training Project"
APP_ENV=local
APP_KEY=base64:your_app_key
APP_DEBUG=true
APP_URL=http://localhost

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=training_project
DB_USERNAME=root
DB_PASSWORD=

# Mail Configuration (Optional)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Default Accounts
Setelah seeding, Anda dapat login dengan akun berikut:

| Role | Email | Password |
|------|-------|----------|
| Super Admin | admin@dirgantara.com | admin123 |
| Admin | admin2@dirgantara.com | admin123 |
| User | user@dirgantara.com | user123 |

---

## 🎮 Usage

### For Administrators
1. **Login** dengan akun admin
2. **Dashboard** - Lihat statistik dan navigasi
3. **User Management** - Kelola pengguna dan roles
4. **Training Management** - Buat dan kelola pelatihan
5. **Certificate Generation** - Generate sertifikat untuk peserta

### For Users
1. **Register/Login** ke aplikasi
2. **Browse Trainings** - Lihat pelatihan tersedia
3. **Enroll** dalam pelatihan
4. **Complete Tasks** - Kerjakan dan submit tugas
5. **Download Certificate** - Unduh sertifikat setelah lulus

---

## 🔍 API Documentation

Aplikasi ini menyediakan REST API endpoints untuk integrasi eksternal. Dokumentasi lengkap dapat diakses melalui:

- **Postman Collection**: `docs/api_collection.json`
- **API Documentation**: `docs/api.md`

### Sample API Endpoints
```http
GET    /api/trainings
GET    /api/trainings/{id}
POST   /api/trainings
PUT    /api/trainings/{id}
DELETE /api/trainings/{id}
```

---

## 🛠️ Troubleshooting

### Common Issues

#### ❌ `vendor/autoload.php` not found
```bash
composer install
```

#### ❌ `No application encryption key has been specified`
```bash
php artisan key:generate
```

#### ❌ `Database connection error`
- Pastikan database credentials di `.env` benar
- Jalankan `php artisan migrate` jika belum

#### ❌ `Class not found` errors
```bash
composer dump-autoload
```

#### ❌ `Permission denied` on storage
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

#### ❌ `Livewire not working`
```bash
npm run dev
# atau
npm run build
```

#### ❌ `Vite manifest not found`
```bash
npm run dev
# atau
npm run build
```

### Debug Mode
Untuk debugging, aktifkan debug mode di `.env`:
```env
APP_DEBUG=true
```

### Clear Cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

---

## 🤝 Contributing

Kami sangat menyambut kontribusi dari komunitas! 🚀

### How to Contribute
1. **Fork** repository ini
2. **Create** branch fitur baru (`git checkout -b feature/AmazingFeature`)
3. **Commit** perubahan Anda (`git commit -m 'Add some AmazingFeature'`)
4. **Push** ke branch (`git push origin feature/AmazingFeature`)
5. **Open** Pull Request

### Development Guidelines
- Ikuti PSR-12 coding standards
- Gunakan meaningful commit messages
- Test your changes thoroughly
- Update documentation if needed

### Issues & Feature Requests
- Gunakan GitHub Issues untuk melaporkan bug
- Sertakan langkah-langkah untuk mereproduksi bug
- Berikan informasi sistem dan versi yang digunakan

---

## 📄 License

Distributed under the MIT License. See `LICENSE` for more information.

---

<div align="center">

**Made with ❤️ by PKL Team at PT. Dirgantara**

[![GitHub stars](https://img.shields.io/github/stars/Yusril0956/Training-Project?style=social)](https://github.com/Yusril0956/Training-Project/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/Yusril0956/Training-Project?style=social)](https://github.com/Yusril0956/Training-Project/network/members)

---

> **💡 Tip**: Jangan lupa jalankan `php artisan migrate --seed` sebelum testing aplikasi!

</div>
