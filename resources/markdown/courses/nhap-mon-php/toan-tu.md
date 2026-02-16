# Toán tử trong PHP

## Toán tử số học

```php
<?php
$a = 10;
$b = 3;

echo $a + $b;   // 13  Cộng
echo $a - $b;   // 7   Trừ
echo $a * $b;   // 30  Nhân
echo $a / $b;   // 3.33 Chia
echo $a % $b;   // 1   Chia lấy dư
echo $a ** $b;  // 1000 Lũy thừa
```

## Toán tử so sánh

| Toán tử | Ý nghĩa | Ví dụ |
|---------|---------|-------|
| `==` | Bằng (giá trị) | `5 == '5'` → `true` |
| `===` | Bằng (giá trị + kiểu) | `5 === '5'` → `false` |
| `!=` | Khác | `5 != 3` → `true` |
| `<>` | Khác | `5 <> 3` → `true` |
| `!==` | Khác (kiểu) | `5 !== '5'` → `true` |
| `<=>` | Spaceship | `1 <=> 2` → `-1` |

> ⚠️ Luôn ưu tiên `===` thay vì `==` để tránh lỗi do ép kiểu ngầm.

## Toán tử logic

```php
<?php
$a = true;
$b = false;

var_dump($a && $b);   // false  (AND)
var_dump($a || $b);   // true   (OR)
var_dump(!$a);         // false  (NOT)
```

## Toán tử Null Coalescing `??`

```php
<?php
$username = $_GET['user'] ?? 'Khách';
// Nếu $_GET['user'] tồn tại và không null → dùng nó
// Ngược lại → 'Khách'

$config = $custom ?? $default ?? 'fallback';
```