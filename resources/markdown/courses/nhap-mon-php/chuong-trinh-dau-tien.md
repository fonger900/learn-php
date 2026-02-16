# Chương trình PHP đầu tiên

## Cấu trúc cơ bản

```php
<?php
// Đây là comment một dòng

/*
 * Đây là comment
 * nhiều dòng
 */

echo 'Xin chào thế giới!';     // Xuất chuỗi
echo '<br>';                     // Xuống dòng HTML
echo "Hôm nay là ngày đẹp trời"; // Chuỗi dùng dấu nháy kép
```

## echo vs print

```php
<?php
echo 'Nhanh hơn', ' và ', 'nhận nhiều đối số';  // echo nhận nhiều tham số
print 'Chỉ nhận một đối số';                     // print trả về 1
```

## PHP trong HTML

```php
<!DOCTYPE html>
<html>
<body>
    <h1><?php echo 'Tiêu đề từ PHP'; ?></h1>
    <p>Hôm nay là: <?= date('d/m/Y') ?></p>
</body>
</html>
```

> 💡 `<?= ... ?>` là cú pháp rút gọn của `<?php echo ... ?>`.

## Bài tập

1. Tạo file `hello.php` in ra tên và tuổi của bạn
2. Tạo trang HTML có PHP hiển thị ngày giờ hiện tại