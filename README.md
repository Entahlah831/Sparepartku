
## Set Up awal

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- git clone <link-repo>.
- composer install.
- cp .env.example .env (untuk config project).
- php artisan key:generate  (WAJIB).
- Php artisan serve (buat run nya).

## Config .env

Setelah membuat copy dari .env.example dari command sebelumnya ada beberapa yang harus diubah menyesuaikan database karena file env tidak termasuk pada repo ini

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_tim  <-- Ganti ini sesuai nama database
DB_USERNAME=root
DB_PASSWORD=                   <-- Isi jika ada password

## Rules
- Setiap hendak komit harap lapor grup terlebih dahulu atas perubahan apa yang dilakukan