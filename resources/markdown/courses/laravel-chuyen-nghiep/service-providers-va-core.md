# Service Providers & Khám phá Core của Laravel

Để thực sự làm chủ Laravel, bạn phải hiểu cách framework này khởi động (bootstrap) và vai trò của **Service Providers**. Đây chính là "điểm kết nối" giữa ứng dụng của bạn và các dịch vụ cốt lõi của Laravel.

---

## 1. Vòng đời yêu cầu (Request Lifecycle)

Trước khi code của bạn trong Controller chạy, Laravel trải qua các bước sau:
1. **public/index.php**: Điểm bắt đầu, nạp Autoloader từ Composer.
2. **bootstrap/app.php**: Khởi tạo instance của Application.
3. **HTTP/Console Kernels**: Gửi Request vào hệ thống.
4. **Service Providers**: Laravel duyệt qua danh sách các Provider và chạy phương thức `register()` sau đó là `boot()`.

---

## 2. Service Providers là gì?

Service Providers là nơi trung tâm để cấu hình ứng dụng. Bạn đăng ký (bind) các dịch vụ vào **Service Container** tại đây.

### Phương thức `register()`
Chỉ dùng để **bind** các thành phần vào Container. Đừng bao giờ thực hiện các logic nghiệp vụ hoặc gọi các service khác tại đây vì chúng có thể chưa được nạp.

```php
public function register(): void
{
    $this->app->singleton(Connection::class, function (Application $app) {
        return new Connection(config('services.api.key'));
    });
}
```

### Phương thức `boot()`
Được gọi sau khi **tất cả** các provider khác đã được đăng ký. Tại đây bạn có thể truy cập vào mọi dịch vụ đã được bind.

```php
public function boot(): void
{
    // Ví dụ: Đăng ký một View Composer hoặc một Custom Validation Rule
    Validator::extend('phone_number', function ($attribute, $value, $parameters, $validator) {
        return preg_match('/^([0-9\s\-\+\(\)]*)$/', $value);
    });
}
```

---

## 3. Khi nào cần tạo Service Provider riêng?

- Khi bạn cần tích hợp một thư viện bên thứ ba (SDK của thanh toán, Giao hàng).
- Khi bạn muốn tổ chức các logic khởi tạo phức tạp ra khỏi `AppServiceProvider`.
- Khi bạn xây dựng các Package mở rộng cho Laravel.

```bash
php artisan make:provider PaymentServiceProvider
```

---

## 4. Hợp đồng (Interfaces / Contracts)

Sử dụng Contracts giúp ứng dụng của bạn không bị phụ thuộc chặt chẽ vào một implementation cụ thể.

```php
// Binding Interface với một Class cụ thể trong Provider
$this->app->bind(
    \App\Contracts\SmsServiceInterface::class,
    \App\Services\TwilioSmsService::class
);
```

---

## 🧭 Lời khuyên chuyên gia
- **Singleton vs Bind:** Sử dụng `singleton` nếu bạn muốn Laravel chỉ tạo một instance duy nhất của class trong suốt vòng đời của request (giúp tiết kiệm bộ nhớ).
- **Deferred Providers:** Nếu provider của bạn chỉ đăng ký các binding vào container, hãy cân nhắc sử dụng `DeferrableProvider` để tăng hiệu năng (chỉ nạp khi cần thiết).

---

## 🎯 Thử thách
1. Tạo một `SmsServiceProvider`.
2. Định nghĩa một `SmsInterface` với phương thức `send()`.
3. Tạo hai class `TwilioService` và `ZaloService` thực thi interface đó.
4. Thử hoán đổi chúng trong Provider và xem ứng dụng tự động thay đổi như thế nào.
