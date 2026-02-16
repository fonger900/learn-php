# Câu lệnh điều kiện

## if / elseif / else

```php
<?php
$diem = 8.5;

if ($diem >= 9) {
    echo 'Xuất sắc';
} elseif ($diem >= 7) {
    echo 'Khá';
} elseif ($diem >= 5) {
    echo 'Trung bình';
} else {
    echo 'Yếu';
}
```

## Toán tử ba ngôi (Ternary)

```php
<?php
$tuoi = 20;
$loai = ($tuoi >= 18) ? 'Người lớn' : 'Trẻ em';
echo $loai; // Người lớn
```

## switch

```php
<?php
$ngay = 'Thứ Hai';

switch ($ngay) {
    case 'Thứ Hai':
    case 'Thứ Ba':
        echo 'Đầu tuần';
        break;
    case 'Thứ Bảy':
    case 'Chủ Nhật':
        echo 'Cuối tuần';
        break;
    default:
        echo 'Giữa tuần';
}
```

## match (PHP 8+)

```php
<?php
$statusCode = 404;

$message = match ($statusCode) {
    200 => 'OK',
    301 => 'Chuyển hướng',
    404 => 'Không tìm thấy',
    500 => 'Lỗi server',
    default => 'Không xác định',
};

echo $message; // Không tìm thấy
```

> 💡 `match` dùng so sánh `===` (strict), khác với `switch` dùng `==`.