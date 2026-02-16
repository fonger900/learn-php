# PHP 8.x: Những tính năng đột phá

PHP 8.0, 8.1 và 8.2 mang lại những thay đổi lớn nhất trong lịch sử ngôn ngữ này, biến PHP thành một ngôn ngữ cực kỳ hiện đại, nhanh và an toàn.

---

## 1. Union Types (Kết hợp kiểu dữ liệu)
Thay vì chỉ nhận 1 kiểu, nay bạn có thể khai báo một biến nhận nhiều kiểu dữ liệu khác nhau.

```php
<?php
function process(int|float $number) {
    return $number * 2;
}
```

---

## 2. Nullsafe Operator (`?->`)
Giúp bạn gọi các phương thức lồng nhau mà không cần kiểm tra `if ($obj !== null)` liên tục. Nếu một mắt xích bị null, toàn bộ chuỗi sẽ trả về null thay vì báo lỗi.

```php
<?php
// PHP 7
$country = null;
if ($user !== null) {
    $profile = $user->getProfile();
    if ($profile !== null) {
        $country = $profile->country;
    }
}

// PHP 8
$country = $user?->getProfile()?->country;
```

---

## 3. Constructor Property Promotion
Giúp giảm 80% code thừa khi khai báo Class.

```php
<?php
// PHP 8
class User {
    public function __construct(
        public string $name,
        public string $email,
        private int $age
    ) {}
}
```

---

## 4. Enums (PHP 8.1)
Thay vì dùng các hằng số string hay int dễ sai sót, Enums giúp bạn định nghĩa tập hợp các giá trị cố định một cách an toàn.

```php
<?php
enum PostStatus: string {
    case Draft = 'draft';
    case Published = 'published';
    case Archived = 'archived';
}

function updateStatus(PostStatus $status) {
    echo "Trạng thái mới: " . $status->value;
}
```

---

## 5. Readonly Properties (PHP 8.2)
Cho phép bạn khai báo thuộc tính chỉ được ghi 1 lần duy nhất (trong constructor) và không thể thay đổi sau đó.

```php
<?php
class Configuration {
    public readonly string $apiKey;

    public function __construct(string $key) {
        $this->apiKey = $key;
    }
}
```

---

## 🚀 Tại sao bạn nên dùng PHP 8?
1. **Tốc độ:** JIT (Just-In-Time) compiler giúp các tác vụ tính toán nặng nhanh hơn đáng kể.
2. **An toàn:** Bắt lỗi ngay từ lúc viết code nhờ hệ thống kiểu dữ liệu chặt chẽ.
3. **Gọn gàng:** Cú pháp mới giúp bạn viết ít code hơn nhưng làm được nhiều việc hơn.

---

## 🧭 Lời khuyên
Nếu bạn đang bắt đầu một dự án mới, hãy luôn chọn phiên bản PHP mới nhất có thể (hiện tại là PHP 8.2 hoặc 8.3) để tận dụng tối đa các cải tiến này.
