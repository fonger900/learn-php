# Quản lý Dependencies với Composer

Trong phát triển phần mềm hiện đại, chúng ta hiếm khi viết mọi thứ từ đầu. **Composer** là công cụ quản lý thư viện (dependencies) chuẩn cho PHP, giúp bạn cài đặt và quản lý các công viện bên thứ ba một cách dễ dàng.

---

## 1. Composer là gì?
Composer không phải là trình quản lý gói giống như `apt` hay `yum` của Linux. Nó quản lý theo từng dự án (local).
- Bạn khai báo thư viện cần dùng trong file `composer.json`.
- Composer sẽ tải chúng về và đặt vào thư mục `vendor/`.

---

## 2. Các câu lệnh cơ bản

### Cài đặt thư viện mới
```bash
composer require guzzlehttp/guzzle
```
*Lệnh này sẽ tải thư viện Guzzle (dùng để gửi HTTP Request) và thêm nó vào dự án.*

### Cài đặt tất cả thư viện (khi mới clone code về)
```bash
composer install
```

### Cập nhật các thư viện lên bản mới nhất
```bash
composer update
```

---

## 3. File `composer.json` và `composer.lock`

- **composer.json**: Chứa danh sách các thư viện và phiên bản bạn mong muốn (ví dụ: `^8.0`).
- **composer.lock**: Lưu chính xác phiên bản đang được cài đặt thực tế. Hãy luôn commit file này lên Git để đảm bảo mọi thành viên trong team dùng chung một phiên bản.

---

## 4. Tự động tải lớp (Autoloading)

Đây là tính năng tuyệt vời nhất của Composer. Bạn không cần phải `require` từng file PHP thủ công nữa.

```php
<?php
require 'vendor/autoload.php';

// Bây giờ bạn có thể dùng bất kỳ thư viện nào đã cài
$client = new \GuzzleHttp\Client();
```

---

## 🌟 Tại sao phải học Composer?
1. **Tiếp cận kho thư viện khổng lồ:** Truy cập hàng trăm nghìn thư viện trên [Packagist.org](https://packagist.org).
2. **Nền tảng của Framework:** Toàn bộ các Framework lớn như **Laravel**, Symfony đều dựa trên Composer.
3. **Tiêu chuẩn PSR-4:** Giúp tổ chức thư mục dự án chuyên nghiệp và khoa học.

---

## 🎯 Thử thách
1. Hãy cài đặt Composer lên máy tính của bạn.
2. Tạo một thư mục mới, chạy `composer init` và thử cài đặt một thư viện bất kỳ (ví dụ: `fakerphp/faker`).
