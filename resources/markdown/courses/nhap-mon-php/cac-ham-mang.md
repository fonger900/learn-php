# Các hàm mảng quan trọng

## Thêm / Xóa

```php
<?php
$arr = [1, 2, 3];

array_push($arr, 4);       // [1, 2, 3, 4]
array_pop($arr);            // [1, 2, 3] — xóa cuối
array_unshift($arr, 0);    // [0, 1, 2, 3] — thêm đầu
array_shift($arr);          // [1, 2, 3] — xóa đầu
```

## Sắp xếp

| Hàm | Mô tả |
|-----|--------|
| `sort()` | Tăng dần theo giá trị |
| `rsort()` | Giảm dần theo giá trị |
| `asort()` | Tăng dần, giữ key |
| `ksort()` | Tăng dần theo key |
| `usort()` | Sắp xếp tùy chỉnh |

```php
<?php
$scores = [85, 92, 78, 95, 88];
sort($scores);
print_r($scores); // [78, 85, 88, 92, 95]

usort($scores, fn($a, $b) => $b - $a); // Giảm dần
```

## Lọc, map, reduce

```php
<?php
$numbers = [1, 2, 3, 4, 5, 6, 7, 8];

// Lọc số chẵn
$even = array_filter($numbers, fn($n) => $n % 2 === 0);
// [2, 4, 6, 8]

// Nhân đôi
$doubled = array_map(fn($n) => $n * 2, $numbers);
// [2, 4, 6, 8, 10, 12, 14, 16]

// Tổng
$sum = array_reduce($numbers, fn($carry, $n) => $carry + $n, 0);
// 36
```

## Spread operator

```php
<?php
$first = [1, 2, 3];
$second = [4, 5, 6];
$merged = [...$first, ...$second]; // [1, 2, 3, 4, 5, 6]
```