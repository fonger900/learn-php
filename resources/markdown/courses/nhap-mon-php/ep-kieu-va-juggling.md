# Ép kiểu (Type Casting)

## Ép kiểu tự động (Type Juggling)

PHP tự động chuyển đổi kiểu khi cần:

```php
<?php
$result = '10' + 5;       // 15 (string → int)
$result = '10.5' + 1;     // 11.5 (string → float)
$result = true + true;    // 2 (bool → int)
```

## Ép kiểu thủ công (Type Casting)

```php
<?php
$str = '42';
$int = (int) $str;         // 42
$float = (float) '3.14';   // 3.14
$bool = (bool) 0;           // false
$array = (array) 'hello';   // ['hello']
$str = (string) 100;        // '100'
```

## Bảng ép kiểu sang boolean

| Giá trị | Kết quả |
|---------|---------|
| `0`, `0.0` | `false` |
| `''`, `'0'` | `false` |
| `[]` (mảng rỗng) | `false` |
| `null` | `false` |
| Mọi giá trị khác | `true` |

## Strict Types (PHP 7+)

```php
<?php
declare(strict_types=1);

function add(int $a, int $b): int {
    return $a + $b;
}

echo add(2, 3);     // 5
// add('2', 3);      // TypeError! Vì strict_types = 1
```

> 💡 Dùng `declare(strict_types=1)` ở đầu file để PHP kiểm tra kiểu nghiêm ngặt.