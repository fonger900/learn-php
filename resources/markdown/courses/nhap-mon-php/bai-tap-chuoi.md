# Bài tập Xử lý Chuỗi

## Bài 1: Đếm từ

```php
<?php
function demTu(string $str): int
{
    return str_word_count($str);
}

echo demTu('PHP là ngôn ngữ tuyệt vời'); // 5
```

## Bài 2: Chuyển slug

```php
<?php
function toSlug(string $str): string
{
    $str = mb_strtolower($str);
    $str = preg_replace('/[^a-z0-9\s-]/', '', $str);
    $str = preg_replace('/[\s-]+/', '-', $str);

    return trim($str, '-');
}

echo toSlug('Học PHP Cơ Bản!'); // hc-php-c-bn
```

## Bài 3: Validate email

```php
<?php
function validateEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

var_dump(validateEmail('test@gmail.com'));  // true
var_dump(validateEmail('invalid-email'));   // false
```

## Bài 4: Ẩn số điện thoại

```php
<?php
function hidePhone(string $phone): string
{
    $clean = preg_replace('/\D/', '', $phone);

    return substr($clean, 0, 3) . '****' . substr($clean, -3);
}

echo hidePhone('0912 345 678'); // 091****678
```

## Thử thách

1. Viết hàm đảo ngược chuỗi Unicode (hỗ trợ tiếng Việt)
2. Viết hàm đếm nguyên âm trong chuỗi tiếng Việt
3. Viết hàm chuyển đổi `camelCase` sang `snake_case`