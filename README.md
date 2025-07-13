<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## 📦 Requirements

Pastikan kamu sudah menginstall:
- PHP >= 8.1
- Composer
- MySQL / MariaDB
- Postman (Optional) untuk test API atau melalui browser

## 🚀 Cara Menjalankan Proyek
Lakukan langkah-langkah berikut untuk menjalankan projek:
1. Clone Repository
   - Unduh langsung dengan format .zip atau
   - Paste baris ini "**git clone https://github.com/UsriYusron/technical-test-usri-yusron**" di dalam folder htdocs (xampp/wampp) atau www (laragon) dengan CMD"
   - Masuk ke dalam VsCode atau IDE lainnya didalam folder project
     
2. Install Dependency
   - Buka terminal VsCode ( CTRL + ` )
   - composer install
     
4. Copy File .env
   - cp .env.example .env atau
   - Buat file baru dengan nama .env
     
5. Generate Key
   - php artisan key:generate

6. Konfigurasi Database
   - Edit file .env sesuaikan dengan database lokal kamu

7. Jalankan Migrasi & Seeder
   - php artisan migrate --seed

8. Jalankan Server
   - php artisan serve

## 🔐 Authentication

- Untuk login, gunakan endpoint:
  
  **POST** /api/login
  
        Body:
              {
              "username": "admin",
              "password": "pastibisa"
            }

- Untuk logout, gunakan endpoint:
  
  **POST** /api/logout

- Semua endpoint selain login & register harus menggunakan Bearer Token dari login.

## 📬 API Endpoint

Baca dokumentasi lengkapnya: https://documenter.getpostman.com/view/38072301/2sB34fo25x#0cba4378-a4c3-4805-97b6-a7948ff164a8

| Method | Endpoint            | Deskripsi                   |
| ------ | ------------------- | --------------------------- |
| GET    | /api/divisions      | List semua divisi           |
| GET    | /api/employees      | List pegawai (filtering)    |
| POST   | /api/employees      | Tambah pegawai baru         |
| PUT    | /api/employees/{id} | Edit pegawai                |
| DELETE | /api/employees/{id} | Hapus pegawai               |
| POST   | /api/login          | Login (ambil token Sanctum) |
| POST   | /api/logout         | Logout                      |

end point untuk bonus soal

| Method |     Endpoint        |                     Deskripsi                   |
| ------ | ------------------- | ------------------------------------------------|
| GET    | /api/nilaiRT        | List semua nilai RT                             |
| GET    | /api/nilaiST        | List semua nilai ST Berdasarkan ketentuan       |

## ✍ Catatan

*** Tidak ada cara lain untuk deploy projek backend secara gratis, jadi jika ingin memastikan projek berjalan dengan baik lakukan di local ***


## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
