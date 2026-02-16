# Làm việc với Database: PDO cơ bản

Trong PHP, **PDO (PHP Data Objects)** là thư viện chuẩn và an toàn nhất để kết nối và làm việc với cơ sở dữ liệu (MySQL, SQLite, PostgreSQL...).

---

## 1. Tại sao nên dùng PDO?
- **Hỗ trợ đa cơ sở dữ liệu:** Bạn có thể đổi từ MySQL sang PostgreSQL mà không cần sửa nhiều code.
- **Bảo mật (SQL Injection):** Hỗ trợ Prepared Statements để ngăn chặn các cuộc tấn công đánh cắp dữ liệu.
- **Lập trình hướng đối tượng:** Cung cấp giao diện sạch sẽ và hiện đại.

---

## 2. Kết nối Database

```php
<?php
$host = '127.0.0.1';
$db   = 'my_database';
$user = 'root';
$pass = 'password';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
     $pdo = new PDO($dsn, $user, $pass, [
         PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
         PDO::ATTR_EMULATE_PREPARES   => false,
     ]);
     echo "Kết nối thành công!";
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
```

---

## 3. Truy vấn dữ liệu (SELECT)

### Prepared Statements (An toàn nhất)
Đừng bao giờ truyền trực tiếp biến của người dùng vào câu lệnh SQL. Hãy dùng dấu hỏi (`?`) hoặc tên định danh (`:name`).

```php
<?php
// Cách dùng dấu hỏi
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute(['hoang@example.com']);
$user = $stmt->fetch();

// Cách dùng tên định danh
$stmt = $pdo->prepare("SELECT * FROM users WHERE age > :age");
$stmt->execute(['age' => 18]);
$users = $stmt->fetchAll();
```

---

## 4. Thêm, Sửa, Xóa (INSERT, UPDATE, DELETE)

```php
<?php
// INSERT
$sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
$pdo->prepare($sql)->execute([
    'name' => 'Hoàng',
    'email' => 'hoang@example.com'
]);

// UPDATE
$sql = "UPDATE users SET name = ? WHERE id = ?";
$pdo->prepare($sql)->execute(['Nguyễn Văn Hoàng', 1]);

// DELETE
$sql = "DELETE FROM users WHERE id = ?";
$pdo->prepare($sql)->execute([1]);
```

---

## 🛡️ Phòng chống SQL Injection
SQL Injection xảy ra khi mã độc được chèn vào câu truy vấn. PDO giải quyết vấn đề này bằng cách:
1. Gửi bản thiết kế SQL đến server trước (`prepare`).
2. Gửi dữ liệu riêng biệt sau (`execute`).
Server sẽ không bao giờ thực thi dữ liệu như là một phần của lệnh SQL.

---

## 🎯 Bài tập thực hành
Hãy thiết kế một bảng `posts` gồm: `id`, `title`, `content`.
1. Viết code PHP kết nối đến database.
2. Viết hàm `createPost($title, $content)` sử dụng PDO để lưu bài viết vào database.
