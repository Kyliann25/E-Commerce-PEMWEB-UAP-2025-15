# HUBBUB - Streetwear Lifestyle Brand

## About Hubbub

HUBBUB is a streetwear lifestyle brand proudly originated from Lampung, Indonesia. Our brand represents energy, confidence, and the fearless spirit of expressing your personal identity through fashion.

We are built with the ambition to bring local creativity into the international spotlight by presenting urban fashion pieces inspired by Lampung culture blended with a modern and bold aesthetic.

Established in 2024, HUBBUB continues to collaborate with local artists and creative communities to create meaningful designs that reflect the voice of Indonesian youth.

## Features

-   **E-Commerce System**: Complete shopping flow from product browsing to checkout.
-   **Role-Based Access Control (RBAC)**: Secure access for Admins, Sellers (Stores), and Customers.
-   **Seller Dashboard**: Manage products, orders, and store profile.
-   **Admin Panel**: User and store verification/management.
-   **Wallet System**: Top-up balance and pay using virtual accounts.
-   **Virtual Account Payment**: Simulated payment gateway for seamless transactions.
-   **Responsive Design**: Modern UI/UX built with Tailwind CSS.

## Technologies Used

-   **Backend**: Laravel 12
-   **Frontend**: Blade Templates, Tailwind CSS
-   **Database**: MySQL

## Setup Instructions

1. Clone the repository.
2. Run `composer install`.
3. Copy `.env.example` to `.env` and configure your database.
4. Run `php artisan key:generate`.
5. Run `php artisan migrate --seed` to setup database and initial data.
6. Run `npm install && npm run build`.
7. Run `npm run dev` in a separate terminal.
8. Run `php artisan serve` to start the application.

## Team Members

| Nama                  | NIM             |
| :-------------------- | :-------------- |
| Zaki Julian Rosidin   | 245150607111022 |
| Muhammad Muzaki Iksar | 245150607111026 |

---

# **Ujian Praktikum Pemrograman Web Aplikasi E-Commerce (Laravel)**

## **Konteks Proyek**

Kalian diberikan sebuah repositori proyek Laravel 12 yang sudah dilengkapi dengan:

1. Starter Kit **Laravel Breeze** untuk basic autentikasi.
2. Semua file **Migrations** yang diperlukan untuk membuat struktur database e-commerce (tabel users, products, transactions, stores, etc.).

**Tugas utama Kalian** adalah membangun web aplikasi full-stack E-Commerce yang fungsional (CRUD) berdasarkan skema database yang disediakan, dengan implementasi khusus pada Role Based Access Control (RBAC) dan Flow Pembayaran.

## **Struktur Database**

![alt text](arsitektur-database.png)

## **Persyaratan Teknis & Setup Awal**

1. **Framework:** Laravel 12\.
2. Jalankan **`composer install`** untuk menginstal seluruh dependensi PHP yang dibutuhkan.
3. Salin file **`.env.example`** menjadi **`.env`**, lalu edit pengaturan database sesuai server database Kalian
4. Jalankan **`php artisan key:generate`** untuk menghasilkan application key baru
5. **Database:** Terapkan semua _file_ _migration_ yang telah disediakan (**`php artisan migrate`**).
6. **Seeder:** Kalian **wajib** membuat _Database Seeder_ untuk membuat data awal. Silahkan lakukan langkah ini pada folder `database/seeders` dan buat file seeder sesuai tabel dengan data yang diperlukan, minimal:
    - Satu pengguna dengan role: 'admin'.
    - Dua pengguna dengan role: 'member'.
    - Satu Toko (stores) yang dimiliki oleh salah satu member.
    - Lima Kategori Produk (product_categories).
    - Sepuluh Produk (products) yang dijual oleh Toko tersebut.
7. Jalankan **`php artisan serve`** untuk menjalankan development server
8. Buka terminal lain dan jalankan **`npm install && npm run build`** untuk menginstal package Node yang diperlukan.
9. Jalankan **`npm run dev`** untuk meng-compile asset dalam mode development
10. Buka browser dan akses [**http://localhost:**](http://localhost:8000)`{PORT}` untuk melihat aplikasi

## **Tantangan Khusus (_Challenge_)**

Implementasi Kalian harus mencakup tiga tantangan inti berikut:

### **1\. Role Based Access Control (RBAC)**

Batasi akses ke halaman tertentu berdasarkan peran pengguna.

| Peran (users.role)  | Akses ke Halaman   | Aturan Akses                                                                |
| :------------------ | :----------------- | :-------------------------------------------------------------------------- |
| **Admin**           | Halaman Admin.     | Akses penuh ke menu admin.                                                  |
| **Seller/Penjual**  | Dasbor Penjual.    | Wajib memiliki role: 'member' **DAN** wajib memiliki entri di tabel stores. |
| **Member/Customer** | Halaman Pelanggan. | Akses ke halaman pembelian dan riwayat.                                     |

###

### **2\. Implementasi Sistem Keuangan (User Wallet & VA)**

Kalian harus membuat **Tabel Baru** bernama **user_balances** (untuk _user wallet_/saldo) dan mengimplementasikan dua skema pembayaran:

| Skema Pembayaran                          | Flow Penggunaan                                                                                                                  |
| :---------------------------------------- | :------------------------------------------------------------------------------------------------------------------------------- |
| **Opsi A: Bayar dengan Saldo (_Wallet_)** | Pelanggan dapat _Topup_ Saldo terlebih dahulu (melalui VA). Saat _checkout_, saldo user_balances akan langsung dipotong.         |
| **Opsi B: Bayar Langsung (Transfer VA)**  | Saat _checkout_ produk, sistem akan membuat kode **Virtual Account (VA) yang unik** yang terkait langsung dengan transaction_id. |

###

### **3\. Halaman Pembayaran Terpusat (_Dedicated Payment Page_)**

Buat satu halaman/fitur untuk memproses konfirmasi pembayaran VA dari Opsi A (_Topup_) dan Opsi B (Pembelian Langsung).

-   **Flow:** Pengguna mengakses halaman Payment \-\> Masukkan Kode VA \-\> Sistem menampilkan detail (jumlah yang harus dibayar) \-\> Pengguna memasukkan nominal transfer (simulasi) \-\> Konfirmasi Pembayaran.
-   Jika sukses, sistem akan:
    -   **Untuk Topup:** Menambahkan saldo ke user_balances.
    -   **Untuk Pembelian:** Mengubah transactions.payment_status menjadi paid **dan** menambahkan dana ke store_balances penjual.

## **Fitur yang Harus Diimplementasikan (Berdasarkan Halaman)**

Implementasikan fungsionalitas CRUD untuk setiap peran:

### **I. Halaman Pengguna (Customer Side)**

| Halaman                              | Fungsionalitas Wajib                                                                                                                                                                            |
| :----------------------------------- | :---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Homepage** (/)                     | Menampilkan daftar **semua produk** yang tersedia. **Filter** berdasarkan product_categories.                                                                                                   |
| **Halaman Produk** (/product/{slug}) | Menampilkan detail produk, semua product_images, nama store, product_reviews, dan tombol **"Beli"**.                                                                                            |
| **Checkout** (/checkout)             | Proses pengisian alamat, pemilihan _shipping_ (shipping_type, kalkulasi shipping_cost), pemilihan Opsi Pembayaran (Saldo / Transfer VA). Membuat entri di transactions dan transaction_details. |
| **Riwayat Transaksi** (/history)     | Melihat daftar transactions yang pernah dilakukan. Dapat melihat detail produk yang dibeli (transaction_details).                                                                               |
| **Topup Saldo** (/wallet/topup)      | Mengajukan _topup_ saldo pribadi. Menghasilkan VA unik.                                                                                                                                         |

###

### **II. Halaman Toko (Seller Dashboard)**

Halaman ini hanya dapat diakses oleh _Member_ yang sudah mendaftar sebagai Toko.

| Halaman                                     | Fungsionalitas Wajib                                                                              |
| :------------------------------------------ | :------------------------------------------------------------------------------------------------ |
| **Pendaftaran Toko** (/store/register)      | CRUD untuk membuat profil Toko (mengisi stores.name, logo, about, dll.).                          |
| **Manajemen Toko** (/seller/profile)        | CRUD untuk mengelola (update/delete) data Toko dan detail rekening bank.                          |
| **Manajemen Kategori** (/seller/categories) | **CRUD** untuk product_categories.                                                                |
| **Manajemen Produk** (/seller/products)     | **CRUD** untuk products dan product_images (termasuk penKalianan is_thumbnail).                   |
| **Manajemen Pesanan** (/seller/orders)      | Melihat daftar pesanan masuk (transactions). Mengubah status pesanan dan mengisi tracking_number. |
| **Saldo Toko** (/seller/balance)            | Melihat saldo saat ini (store_balances.balance) dan riwayat saldo (store_balance_histories).      |
| **Penarikan Dana** (/seller/withdrawals)    | Mengajukan Penarikan dana (membuat entri di withdrawals) dan melihat riwayat withdrawals.         |

###

### **III. Halaman Admin (Admin Only)**

Halaman ini hanya dapat diakses oleh pengguna dengan role: 'admin'.

| Halaman                                   | Fungsionalitas Wajib                                                                                                                                              |
| :---------------------------------------- | :---------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Verifikasi Toko** (/admin/verification) | Melihat daftar Toko yang belum terverifikasi (is_verified: false). Fitur untuk **Memverifikasi** atau **Menolak** pendaftaran toko (mengubah stores.is_verified). |
| **Manajemen User & Store** (/admin/users) | Melihat dan mengelola daftar semua users dan stores yang terdaftar.                                                                                               |

## **Penilaian**

Persentase nilai dilakukan berdasarkan indikator berikut

-   Tampilan 15%
-   Presentasi Projek 20% (jika nanti memungkinkan)
-   Penerapan MVC \+ Efisiensi code 15%
-   Kelengkapan Project sesuai kriteria 50%

Penilaian akan dilakukan berdasarkan commit nya. Semakin banyak dan kompleks yang dilakukan per individu dalam kelompok, bobot nilai yang diberikan akan semakin besar dan berlaku sebaliknya.

## **Informasi Tambahan**

1. Silahkan fork repositori ini, lalu mulai kerjakan di laptop masing masing dan jangan lupa invite partner kelompok ke dalam repositori.
2. Berikan penjelasan aplikasi yang kalian buat sebagaimana readme pada repositori ini dan jangan lupa sertakan nama dan NIM anggota kelompok pada file [readme.md](http://readme.md)
3. Dipersilahkan membuat improvisasi pada codingan, library, dan sumber apapun yang dibutuhkan selama tidak merubah arsitektur aplikasi yang diberikan pada poin diatas.
4. Jika ada yang kurang dipahami dari perintah soal yang diberikan, feel free untuk menghubungi kami.

---

![alt text](<No Problem Running GIF by ProBit Global.gif>)

Semangatt, badai pasti berlalu

xxx
