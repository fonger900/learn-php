# Hàm Chuỗi Nâng Cao

## str_contains, str_starts_with, str_ends_with (PHP 8+)

```php
<?php
$email = 'user@example.com';

echo str_contains($email, '@');        // true
echo str_starts_with($email, 'user');  // true
echo str_ends_with($email, '.com');    // true
```

## sprintf & number_format

```php
<?php
$price = 1234567.89;

echo sprintf('Giá: %s VNĐ', number_format($price, 0, ',', '.'));
// Giá: 1.234.568 VNĐ

echo sprintf('Tên: %-20s | Điểm: %05.2f', 'An', 8.5);
// Tên: An                   | Điểm: 08.50
```

## Multibyte strings (xử lý tiếng Việt)

```php
<?php
$str = 'Xin chào Việt Nam';

echo strlen($str);       // 21 (bytes, sai!)
echo mb_strlen($str);    // 17 (ký tự, đúng!)

echo mb_strtoupper($str);         // XIN CHÀO VIỆT NAM
echo mb_substr($str, 9, 4);       // Việt
echo mb_detect_encoding($str);    // UTF-8
```

> ⚠️ Luôn dùng hàm `mb_*` khi xử lý tiếng Việt hoặc Unicode.

## Biểu thức chính quy (Regex)

```php
<?php
$phone = '0912 345 678';

// Kiểm tra SĐT Việt Nam
if (preg_match('/^0\d{9,10}$/', str_replace(' ', '', $phone))) {
    echo 'SĐT hợp lệ';
}

// Tìm tất cả số
preg_match_all('/\d+/', 'Năm 2026, tháng 2, ngày 16', $matches);
print_r($matches[0]); // ['2026', '2', '16']

// Thay thế
echo preg_replace('/\s+/', '-', 'Học PHP Cơ Bản');
// Học-PHP-Cơ-Bản
```