# Bảo mật Database

## SQL Injection

```php
<?php
// ❌ NGUY HIỂM: Dữ liệu người dùng trực tiếp vào SQL
$name = $_GET['name']; // Hacker nhập: ' OR 1=1 --
$pdo->query("SELECT * FROM users WHERE name = '$name'");
// → SELECT * FROM users WHERE name = '' OR 1=1 --'
// → Trả về TẤT CẢ users!

// ✅ AN TOÀN: Dùng Prepared Statement
$stmt = $pdo->prepare('SELECT * FROM users WHERE name = ?');
$stmt->execute([$_GET['name']]);
```

## Validate & Sanitize Input

```php
<?php
// Validate email
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
if ($email === false) {
    die('Email không hợp lệ');
}

// Sanitize — loại bỏ ký tự nguy hiểm
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);

// Validate số
$age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1, 'max_range' => 150],
]);
```

## Password Hashing

```php
<?php
// Tạo hash (khi đăng ký)
$password = 'mat_khau_123';
$hash = password_hash($password, PASSWORD_BCRYPT);
// $2y$10$...

// Xác minh (khi đăng nhập)
$inputPassword = $_POST['password'];
if (password_verify($inputPassword, $hash)) {
    echo 'Đăng nhập thành công!';
} else {
    echo 'Sai mật khẩu!';
}
```

> ⚠️ **Không bao giờ** lưu mật khẩu dạng plain text. Luôn dùng `password_hash()`.

## Checklist bảo mật

- ✅ Dùng Prepared Statements cho mọi truy vấn
- ✅ Validate & sanitize tất cả input
- ✅ Hash password với `password_hash()`
- ✅ Dùng HTTPS
- ✅ Giới hạn quyền database user
- ✅ Không hiển thị lỗi chi tiết cho user