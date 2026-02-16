# Biến và Kiểu Dữ Liệu

## Khai báo biến

Biến trong PHP bắt đầu bằng dấu `$`, không cần khai báo kiểu.

```php
<?php
$ten = 'Nguyễn Văn A';   // string
$tuoi = 25;               // integer
$diemTB = 8.5;            // float
$isStudent = true;        // boolean
$diaChi = null;           // null
```

## Các kiểu dữ liệu

| Kiểu | Ví dụ | Mô tả |
|------|-------|-------|
| `string` | `'Xin chào'` | Chuỗi ký tự |
| `int` | `42` | Số nguyên |
| `float` | `3.14` | Số thực |
| `bool` | `true` / `false` | Giá trị logic |
| `array` | `[1, 2, 3]` | Mảng |
| `null` | `null` | Không có giá trị |
| `object` | `new DateTime()` | Đối tượng |

## Kiểm tra kiểu dữ liệu

```php
<?php
$x = 42;
echo gettype($x);        // "integer"
var_dump($x);             // int(42)
echo is_int($x);          // true
```

## Nháy đơn vs nháy kép

```php
<?php
$ten = 'PHP';
echo 'Xin chào $ten';    // Xin chào $ten (không parse)
echo "Xin chào $ten";    // Xin chào PHP (parse biến)
echo "2 + 3 = {$x}";     // Dùng {} cho biểu thức phức tạp
```

## Hằng số

```php
<?php
define('SITE_NAME', 'Học PHP');
const MAX_USERS = 100;

echo SITE_NAME;  // Học PHP
echo PHP_VERSION; // Hằng có sẵn
```