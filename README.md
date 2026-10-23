# Blog Ödevi (Laravel + MySQL)

Kullanıcıların okuyucu hesabı oluşturabildiği kişisel blog. Kayıt olan hesaplar makaleleri okuyabilir; makale yayımlama yalnızca blog sahibine açıktır.

## Gerekenler

- PHP 8.3 veya üzeri
- Composer 2
- MySQL Server
- DataGrip (MySQL veritabanını yönetmek için)

## DataGrip'te veritabanını oluştur

MySQL bağlantısını açıp sorgu konsolunda şu SQL'i çalıştır:

```sql
CREATE DATABASE kisisel_blog CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci;
```

## Projeyi çalıştır

Proje klasöründe terminal aç ve sırasıyla çalıştır:

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
```

`.env` dosyasında `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` ve `DB_PASSWORD` değerlerini kendi MySQL bilgilerine göre düzenle. Bu dosya GitHub'a yüklenmez. Sahip hesabı için `BLOG_OWNER_USERNAME` ve `BLOG_OWNER_PASSWORD` değerlerini de ilk seferde değiştir.

Ardından:

```powershell
php artisan migrate --seed
php artisan serve
```

Tarayıcıda http://127.0.0.1:8000 adresini aç. `migrate --seed` tabloları oluşturur ve sahip hesabını ekler.

## Hesaplar

- Sahip girişi: `.env` içindeki `BLOG_OWNER_USERNAME` ve `BLOG_OWNER_PASSWORD`.
- Diğer kişiler `/register` sayfasından kayıt olabilir. Bu hesaplar yalnızca makaleleri okuyabilir.
- Makale oluşturma sayfası `/makale/yeni`; yalnızca sahip hesabı erişebilir.

Yeni tablolar: `users` (kullanıcılar) ve `articles` (makaleler). `database/migrations` içindeki Laravel migration dosyalarıyla yönetilir.
