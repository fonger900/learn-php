# Đọc và Ghi File

## Đọc file

```php
<?php
// Đọc toàn bộ file thành chuỗi
$content = file_get_contents('data.txt');

// Đọc thành mảng (mỗi dòng = 1 phần tử)
$lines = file('data.txt', FILE_IGNORE_NEW_LINES);

// Đọc từng dòng
$fp = fopen('data.txt', 'r');
while (($line = fgets($fp)) !== false) {
    echo trim($line) . "\n";
}
fclose($fp);
```

## Ghi file

```php
<?php
// Ghi đè toàn bộ
file_put_contents('log.txt', "Dòng mới\n");

// Ghi thêm (append)
file_put_contents('log.txt', "Thêm dòng\n", FILE_APPEND);

// Dùng fopen
$fp = fopen('output.txt', 'w'); // 'w' = ghi đè, 'a' = append
fwrite($fp, "Xin chào\n");
fclose($fp);
```

## Kiểm tra file

```php
<?php
file_exists('data.txt');    // File có tồn tại?
is_file('data.txt');        // Có phải file?
is_dir('uploads');          // Có phải thư mục?
is_readable('data.txt');    // Có thể đọc?
is_writable('data.txt');    // Có thể ghi?
filesize('data.txt');       // Kích thước (bytes)
```