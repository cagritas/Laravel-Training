# Laravel Eğitim Playground Notları

`LaravelEgitim` deposunda bugüne kadar işlediğimiz tüm komutları, püf noktalarını ve örnekleri bu belgeye topladık. Böylece malzemeyi doğrudan GitHub Wiki sayfalarına aktarabilir, görsel öğelerle zenginleştirebilirsiniz.

## 1. Ortamı Hazırlama

1. Projeyi kurup uygulama anahtarını üretin.

   ```bash
   composer create-project laravel/laravel LaravelEgitim
   cd LaravelEgitim
   cp .env.example .env
   php artisan key:generate
   ```

2. `.env` içinde veritabanı bağlantısını yapın ve mevcut migrasyonları çalıştırın.

   ```bash
   php artisan migrate
   ```

3. Yüklenen görsellerin tarayıcıya servis edilebilmesi için public disk linkini atın.

   ```bash
   php artisan storage:link
   ```

4. Geliştirme sunucusunu kaldırın (veya Sail/Valet kullanın).

   ```bash
   php artisan serve
   ```

> İpucu: CRUD örneklerini denerken `php artisan tinker` açık kalsın; modelleri ve tabloları oradan hızlıca inceleyebilirsiniz.

## 2. Rotalar ve Controller Pratikleri

- Tüm HTTP uçları `routes/web.php` içinde:
  - `/test/{name}` rotası `ExampleController::show` metoduna gider; Blade tarafında `resources/views/example.blade.php` çalışır.
  - `/web`, `/form`, `/upload` gibi sayfalarda `->name('...')` kullanılarak tertipli isimlendirilmiş rotalar oluşturuldu.
  - `/form-result` POST isteği `Route::middleware('form.guard')` ile sarıldı; yasaklı kelimeler controllera ulaşmadan bloklanıyor.
  - Query Builder (`DatabaseOperationsController`) ve Eloquent (`ModelOperationsController`) demoları için toplu rota grupları mevcut.

Wiki için `php artisan route:list --path=` çıktısının ekran görüntüsünü ve her rota → controller tablosunu ekleyin.

## 3. Blade Layout ve Landing Sayfası

- `resources/views/layouts/site.blade.php` sayfanın omurgası. Google Font yükleme, tasarım değişkenleri, `partials/navigation` ve `partials/footer` dahildir.
- `resources/views/pages/home.blade.php`, `WebPageController::showLandingPage` metodundan gelen `$headline` / `$subheading` değerlerini Hero bölümüne basar, `$features` dizisini kartlara dönüştürür ve `route('form')`, `route('upload.page')` linkleriyle etkileşimli modüllere yönlendirir.
- `resources/views/welcome.blade.php` dosyası bir “playground hub” olarak güncellendi; kartlar üzerinden her modüle giden CTA’lar hazır.

Görsel önerisi: Hero + navigation bileşenini yakalayan bir ekran görüntüsü alıp wiki giriş sayfasına koyun.

## 4. Korumalı Form Akışı

1. `FormController` basit bir form döndürür (`resources/views/form.blade.php`), `@csrf` ve `textarea` bulunur.
2. `app/Http/Middleware/FormSubmissionGuard.php` sınıfı `message` alanı `apple` olduğunda isteği geri çevirir. Oluşturmak için:

   ```bash
   php artisan make:middleware FormSubmissionGuard
   ```

3. `app/Http/Kernel.php` dosyasında `'form.guard' => FormSubmissionGuard::class` alias’ı tanımlanmıştır.
4. POST handler sadece `$request->input('message')` döndürür; örnek odaklıdır.

Wiki’de tarayıcı → middleware → controller akışını gösteren küçük bir diyagram ve `$errors` kullanımıyla validasyon mesajları nasıl gösterilir anlatılabilir.

## 5. Query Builder Operasyonları

- `app/Http/Controllers/DatabaseOperationsController.php` insert/update/delete/select örnekleri barındırır.
- Altyapı migrasyonu `database/migrations/2025_11_11_174330_create_information_entries_table.php` dosyasıdır (`content` alanı + timestamps).
- Faydalı komutlar:

  ```bash
  php artisan tinker
  >>> DB::table('information_entries')->get();
  php artisan migrate:fresh
  ```

Dokümantasyonda `DB::listen` çıktısını göstererek hangi SQL’in çalıştığını anlatabilirsiniz.

## 6. Eloquent CRUD Rehberi

- `app/Models/InformationEntry.php` tablo adını (`information_entries`) ve `$fillable` dizisini sabitler.
- `ModelOperationsController` içinde `listEntries`, `add`, `updateRecord`, `delete` metodları sırasıyla `find`, `create`, `update`, `delete` API’lerini sergiler.
- Tarayıcıya gönderilen “Record created!” gibi mesajlar kullanıcı geri bildirimini hızlandırır.

Wiki egzersizi: `InformationEntry::find(2)` satırını `firstOrFail()` ile değiştirip exception yakalama örneği verin.

## 7. İletişim Formu Modülü

- Migrasyon: `database/migrations/2025_11_16_071936_iletisim.php` (`contact_requests` tablosu, `full_name`, `email`, `phone_number`, `message` sütunları).
- Model: `app/Models/ContactRequest.php` `$fillable` listesiyle toplu atamaya izin verir.
- Controller: `app/Http/Controllers/ContactRequestController.php` GET isteğinde `resources/views/contact.blade.php` formunu döndürür, POST’ta `ContactRequest::create` ile kayıt açar ve `with('status', ...)` mesajı gönderir.
- Rotalar: `/contact` GET → `contact.form`, `/contact` POST → `contact.submit`.

Genişletme fikri: `ContactRequest::latest()->paginate(10)` ile basit bir yönetici listesi ekleyin.

## 8. Resim Yükleme ve Galeri

- Controller: `app/Http/Controllers/UploadImage.php`
  - `showForm()` → `resources/views/upload.blade.php`
  - `upload()` → `image|max:2048` kuralı ile doğrular, `storage/app/public/images` içine kaydeder ve `back()->with('success', ... )` ile geribildirim verir.
  - `ListImages()` → `Storage::files('public/images')` ile dosyaları toplayıp galeriye aktarır.
- Galeri: `resources/views/list_images.blade.php`, `Storage::url($file)` sayesinde `public/storage` linkinden gelen görselleri gösterir.
- Gerekli komutlar:

  ```bash
  php artisan storage:link
  php artisan tinker
  >>> Storage::disk('public')->files('images');
  ```

Wiki’de “Sık Karşılaşılan Sorunlar” başlığına `storage/app/public/images` klasörünü temizleme veya yazma izinlerini düzeltme ipuçlarını ekleyebilirsiniz.

## 9. Kullanıcı Kayıt Doğrulaması

- `app/Http/Controllers/RegisterUser.php`
  - `index()` → `resources/views/register.blade.php`
  - `register()` → `name`, `email`, `password` alanlarını doğrular (`confirmed`, `min:8`, `unique:users`) ve normalde `User::create` ile kayıt açacağını belirten yorum satırı içerir (hash için `Hash::make` notunu vurgulayın).
- Blade: `resources/views/register.blade.php` hata mesajlarını (`$errors`) listeler ve `route('register.submit')` adresine POST eder. `confirmed` kuralı için `password_confirmation` inputu eklemeyi unutmayın.
- Migrasyon: `database/migrations/2025_11_16_115134_user.php` örnek bir `user` tablosu tanımlar.

Wiki önerisi: bu modüle `php artisan make:mail` ile karşılama e-postası ekleme pratiği yazın.

## 10. Sık Kullanılan Artisan Komutları

| Komut | Açıklama |
| --- | --- |
| `php artisan route:list` | Hangi rota hangi controllera gidiyor hızlıca kontrol edin. |
| `php artisan make:controller UploadImage` | Özelleşmiş controller iskeletleri üretir (`--invokable` opsiyonunu hatırlatın). |
| `php artisan make:model InformationEntry -m` | Model ve migrasyonu aynı anda açar. |
| `php artisan make:middleware FormSubmissionGuard` | Özel istek filtreleri ve guard katmanları üretir. |
| `php artisan migrate`, `migrate:fresh`, `migrate:rollback` | Şema yönetimi ve temiz başlama senaryoları. |
| `php artisan storage:link` | `public/storage` symlink’i kurar; görsel servis edilmesini sağlar. |
| `php artisan tinker` | Modelleri/DB’yi REPL üzerinden kontrol edin, hızlı veri ekleyin. |

Komut tablosunu wiki’ye doğrudan koyup yanında kısa GIF’ler paylaşmanız görsellik katacaktır.

## 11. GitHub Wiki’ye Aktarırken

1. **Ana Sayfa** – `/web`, `/form`, `/contact`, `/upload`, `/images`, `/register` linklerini sunan bir özet.
2. **Rotalar & Middleware** – Bölüm 2 + 4, `routes/web.php` ve `Kernel.php` ekran görüntüleriyle.
3. **Veri Katmanı** – Bölüm 5, 6, 7’yi birleştirip küçük bir ER diyagramı ekleyin.
4. **Medya & Depolama** – Bölüm 8’in tamamı, `public/storage` bağlantısının görseliyle.
5. **Kullanıcı Akışları** – Bölüm 3 ve 9’u aynı sayfada toparlayın; tasarım + backend ekipleri aynı bağlamı paylaşsın.
6. **Komut Rehberi** – Bölüm 10’u tablo halinde taşıyın.

Her sayfada terminal çıktısı, Postman isteği veya VS Code ekran görüntüsü gibi görseller kullanarak “çok görselli” bir wiki tonu yakalayın. İleride yapılacak geliştirmeler (e-posta, pagination, auth) için yapılacaklar listesi ekleyerek belgeyi mini bir yol haritasına dönüştürebilirsiniz.

