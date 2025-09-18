# 🚀 Training Project

Projekan tugas PKL di PT.Dirgantara membuat aplikasi atau web Training menggunakan bahasa pemerograman Laravel 12  

![GitHub commit activity](https://img.shields.io/github/commit-activity/t/Yusril0956/Training-Project?label=Total%20Commits)
![GitHub last commit](https://img.shields.io/github/last-commit/Yusril0956/Training-Project?label=Last%20Commit)
![GitHub contributors](https://img.shields.io/github/contributors/Yusril0956/Training-Project?label=Contributors)

---

## 🛠️ Teknologi yang Digunakan

![HTML5](https://img.shields.io/badge/Code-HTML5-orange?logo=html5)
![CSS3](https://img.shields.io/badge/Style-CSS3-blue?logo=css3)
![JavaScript](https://img.shields.io/badge/Logic-JavaScript-yellow?logo=javascript)
![PHP](https://img.shields.io/badge/Backend-PHP-777BB4?logo=php)
![Laravel](https://img.shields.io/badge/Framework-Laravel-red?logo=laravel)

---

## 👨‍💻 Kontributor

Terima kasih kepada semua kontributor proyek ini! 🎉  

<table>
  <tr>
    <td align="center">
      <a href="https://github.com/Reqi2007">
        <img src="https://github.com/Reqi2007.png?size=100" width="100px;" alt=""/>
        <br /><sub><b>Refan</b></sub>
      </a>
      <br />💻 Fullstack Developer
    </td>
    <td align="center">
      <a href="https://github.com/Yusril0956">
        <img src="https://github.com/Yusril0956.png?size=100" width="100px;" alt=""/>
        <br /><sub><b>Yusril</b></sub>
      </a>
      <br />💻 Fullstack Developer
    </td>
    <td align="center">
      <a href="https://github.com/ehan4426-pixel">
        <img src="https://github.com/ehan4426-pixel.png?size=100" width="100px;" alt=""/>
        <br /><sub><b>Raihan</b></sub>
      </a>
      <br />🤝 Support Developer
    </td>
    <td align="center">
      <a href="https://github.com/vein13046-ui">
        <img src="https://github.com/vein13046-ui.png?size=100" width="100px;" alt=""/>
        <br /><sub><b>Daelingka</b></sub>
      </a>
      <br />🤝 Support Developer
    </td>
  </tr>
</table>

---

---

# Toturial pasang di Vscode

Login dulu ke git hub

git config --global --unset user.name

git config --global --unset user.email


clone repo dengan cara

Ctrl + Shift + p

ketik Git:clone

masukan link https://github.com/Yusril0956/Training-Project.git

---

### Cara mengatasi Error vendor/autoload.php

composer -v

masuk ke folder laravel

composer install

Jika composer lock tidak ada gunakan: composer update

---

### Cara mengatasi error login admin

php artisan migrate

php artisan db:seed

---

#### Untuk membuat database di sqlite atau mysql ada di .env

jika ingin mysql hapus tanda #

jika ingin sqlite tambah file ksong bernama database.sqlite di database

setelah itu php artisan migrate

---

### untuk mengatasi error APP_KEY

php artisan key:Generate

---
---

### clear cache laravel

php artisan config:clear

php artisan cache:clear

php artisan config:clear

---

# NOTE: jangan lupa jalankan artisan nya

php artisan serve


### Fix gambar tidak bisa di upload

php artisan storage:link