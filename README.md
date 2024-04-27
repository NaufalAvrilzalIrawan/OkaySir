# Installasi Aplikasi Okay Sir
# Software yang dibutuhkan
XAMPP
Terminal
Web browser
# Langkah-langkah
Buka folder Kasir01 dan buka terminal untuk melakukan `composer install`
Lalu nyalakan Apache dan MySQL XAMPP dan lakukan `php artisan migrate` dan juga `php artisan db:seed --class=AdminSeeder`
Untuk menjalankan aplikasi lakukan `php artisan serve` dan bukalan `localhost:8000/login`
Akun admin adalah "Admin@gmail.com" dan password "12345678"