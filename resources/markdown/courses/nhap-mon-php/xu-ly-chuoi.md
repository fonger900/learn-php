# Xử lý Chuỗi

## Tạo chuỗi

```php
<?php
$single = 'Nháy đơn - không parse biến';
$double = "Nháy kép - parse $single";

// Heredoc (giống nháy kép)
$heredoc = <<<EOD
Đây là heredoc.
Có thể viết nhiều dòng.
Parse biến: $single
EOD;

// Nowdoc (giống nháy đơn)
$nowdoc = <<<'EOD'
Không parse biến: $single
EOD;
```

## Nối chuỗi

```php
<?php
$ho = 'Nguyễn';
$ten = 'An';

// Cách 1: Toán tử nối
$fullName = $ho . ' ' . $ten;

// Cách 2: Nội suy (interpolation)
$fullName = "$ho $ten";

// Cách 3: sprintf
$fullName = sprintf('%s %s', $ho, $ten);
```

## Các hàm chuỗi thường dùng

| Hàm | Mô tả | Ví dụ |
|-----|--------|-------|
| `strlen()` | Độ dài | `strlen('PHP')` → `3` |
| `strtoupper()` | Chữ hoa | `strtoupper('php')` → `'PHP'` |
| `strtolower()` | Chữ thường | `strtolower('PHP')` → `'php'` |
| `trim()` | Xóa khoảng trắng | `trim(' hi ')` → `'hi'` |
| `substr()` | Cắt chuỗi | `substr('Hello', 0, 3)` → `'Hel'` |
| `str_replace()` | Thay thế | `str_replace('a', 'b', 'abc')` → `'bbc'` |
| `strpos()` | Tìm vị trí | `strpos('Hello', 'lo')` → `3` |
| `explode()` | Tách thành mảng | `explode(',', 'a,b,c')` → `['a','b','c']` |
| `implode()` | Nối mảng thành chuỗi | `implode('-', [1,2])` → `'1-2'` |