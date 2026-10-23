# Blog Ödevi — IntelliJ IDEA + DataGrip

## Gerekenler
- JDK 17 veya üzeri
- IntelliJ IDEA
- MySQL Server (DataGrip tek başına sunucu değildir)
- MySQL'e bağlanacak DataGrip bağlantısı

## 1. DataGrip'te veritabanını oluştur
MySQL bağlantısını aç, sorgu konsoluna aşağıdaki komutu yaz ve `Ctrl+Enter` ile çalıştır:

```sql
CREATE DATABASE kisisel_blog CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci;
```

Ardından Database Explorer'da bağlantıya sağ tıkla, **Refresh** yap ve `kisisel_blog` şemasını seç.

## 2. IntelliJ IDEA'da projeyi aç ve çalıştır
1. IntelliJ'de **File → Open** seçip bu `blogodevi` klasörünü aç. `pom.xml` proje kökünde olmalı.
2. Maven yüklemesi isterse **Load/Sync** düğmesine bas ve tamamlanmasını bekle. İlk yüklemede internet gerekir.
3. `src/main/resources/application.example.properties` dosyasını kopyalayıp kopyanın adını `application.properties` yap. Yeni dosyada `MYSQL_PAROLANI_BURAYA_YAZ` yazan yeri kendi MySQL parolanla değiştir. `application.properties` GitHub'a gönderilmez; parolan gizli kalır.
4. `src/main/java/com/ornek/blog/BlogApplication.java` dosyasını aç ve yeşil ▶ simgesine bas.
5. Tarayıcıda http://localhost:8080 adresini aç.

İlk açılışta makaleler için tablo otomatik oluşturulur. DataGrip'te `kisisel_blog` şemasını Refresh edince `article` tablosunu görebilirsin.

## Sahip hesabı
- Kullanıcı adı: `sahibi`
- Şifre: `blog1234`

Blogda makaleler herkes tarafından okunabilir. Ziyaretçiler `http://localhost:8080/register` adresinden okuyucu hesabı oluşturabilir. Bu hesaplar makale ekleyemez; `/makale/yeni` sayfası yalnızca blog sahibine açıktır. Giriş için `http://localhost:8080/login` adresine git.

- Kullanıcı adı: `sahibi`
- Şifre: `blog1234`

Yeni okuyucu hesapları ve parolalarının BCrypt özeti MySQL'deki `blog_user` tablosunda tutulur. Blog sahibi ilk çalıştırmada oluşturulur. Varsayılan sahip hesabı `sahibi` / `blog1234` şeklindedir. Bu proje sınıf ödevi için örnek bir başlangıçtır.
