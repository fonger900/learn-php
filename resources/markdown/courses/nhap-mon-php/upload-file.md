# Upload File

## Form HTML

```html
<form method="POST" action="upload.php" enctype="multipart/form-data">
    <input type="file" name="avatar">
    <button type="submit">Tải lên</button>
</form>
```

## Xử lý upload trong PHP

```php
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['avatar'];

    // Kiểm tra lỗi
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die('Lỗi upload: ' . $file['error']);
    }

    // Validate
    $allowed = ['image/jpeg', 'image/png', 'image/webp'];
    if (!in_array($file['type'], $allowed)) {
        die('Chỉ chấp nhận JPEG, PNG, WebP');
    }

    $maxSize = 5 * 1024 * 1024; // 5MB
    if ($file['size'] > $maxSize) {
        die('File quá lớn (tối đa 5MB)');
    }

    // Lưu file với tên an toàn
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = uniqid('avatar_') . '.' . $ext;
    $dest = __DIR__ . '/uploads/' . $newName;

    move_uploaded_file($file['tmp_name'], $dest);
    echo "Upload thành công: $newName";
}
```

> ⚠️ Không bao giờ tin tưởng tên file từ người dùng. Luôn tạo tên file mới.