# Smart Manufacturing Dashboard

Web-based Smart Manufacturing Dashboard untuk monitoring mesin produksi, pencatatan aktivitas produksi, serta penyajian laporan hasil produksi pada lingkungan manufaktur.

Project ini dibuat untuk Technical Test **PT Electrindo Inti Dinamika** dengan tujuan membangun sistem monitoring produksi berbasis web yang dapat membantu manajemen melihat kondisi mesin, aktivitas operator, dan histori produksi.

---

# 🚀 Features

## Authentication

Sistem autentikasi pengguna untuk membatasi akses aplikasi.

Fitur:

- Login pengguna
- Logout pengguna
- Proteksi halaman menggunakan middleware authentication


---

# Machine Management

Modul untuk mengelola data mesin produksi.

Fitur:

- Melihat daftar mesin
- Menambahkan data mesin
- Mengubah data mesin
- Menghapus data mesin
- Melihat informasi status dan temperatur mesin


Status mesin yang tersedia:

- Running
- Idle
- Maintenance
- Error


---

# Operator Management

Modul untuk mengelola data operator produksi.

Fitur:

- Melihat daftar operator
- Menambahkan operator
- Mengubah data operator
- Mengaktifkan / menonaktifkan operator


---

# Production Management

Modul untuk melakukan pencatatan aktivitas produksi.

Data produksi yang dicatat:

- Mesin produksi
- Operator yang bertugas
- Jumlah hasil produksi
- Status mesin
- Temperatur mesin
- Shift produksi
- Waktu produksi


Ketika data produksi dibuat, sistem akan memperbarui kondisi mesin berdasarkan data produksi terakhir.


---

# Smart Manufacturing Dashboard

Dashboard monitoring untuk menampilkan informasi performa produksi.

Informasi yang tersedia:

- Total mesin
- Jumlah mesin Running
- Jumlah mesin Idle
- Jumlah mesin Maintenance
- Jumlah mesin Error
- Jumlah operator aktif
- Total produksi hari ini
- Grafik produksi berdasarkan waktu
- Monitoring aktivitas produksi terbaru


---

# Production Report

Modul laporan produksi untuk melihat histori hasil produksi.

Fitur:

- Melihat histori produksi
- Filter berdasarkan tanggal produksi
- Melihat detail produksi
- Menampilkan informasi mesin dan operator terkait


---

# 🛠 Technology Stack

## Backend

- PHP 8.2+
- Laravel Framework 12
- MySQL
- Eloquent ORM


## Frontend

- Laravel Blade Template
- HTML5
- CSS3
- JavaScript
- Bootstrap
- jQuery
- Chart.js


## Library / Package

- Yajra DataTables
- Carbon


## Development Tools

- Composer
- Node.js
- NPM
- Vite
- Git


---

# 📋 Requirement

Sebelum menjalankan project, pastikan sudah memiliki:

- PHP >= 8.2
- Composer
- MySQL / MariaDB
- Node.js >= 18
- NPM