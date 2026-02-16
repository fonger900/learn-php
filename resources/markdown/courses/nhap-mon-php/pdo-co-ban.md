# PDO — PHP Data Objects

## Kết nối database

```php
<?php
try {
    $pdo = new PDO(
        dsn: 'mysql:host=localhost;dbname=myapp;charset=utf8mb4',
        username: 'root',
        password: '',
        options: [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ],
    );
    echo 'Kết nối thành công!';
} catch (PDOException $e) {
    die('Lỗi kết nối: ' . $e->getMessage());
}
```

## Truy vấn đơn giản

```php
<?php
// SELECT nhiều dòng
$stmt = $pdo->query('SELECT * FROM users');
$users = $stmt->fetchAll();

foreach ($users as $user) {
    echo "{$user['name']} - {$user['email']}\n";
}

// SELECT một dòng
$stmt = $pdo->query('SELECT COUNT(*) as total FROM users');
$result = $stmt->fetch();
echo "Tổng: {$result['total']}";
```

## Prepared Statements (QUAN TRỌNG!)

```php
<?php
// ⚠️ KHÔNG BAO GIỜ làm thế này (SQL Injection!)
// $pdo->query("SELECT * FROM users WHERE id = $id");

// ✅ Dùng prepared statement
$stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
$stmt->execute(['email' => 'an@test.com']);
$user = $stmt->fetch();
```

> ⚠️ **Luôn dùng Prepared Statements** để tránh SQL Injection — lỗ hổng bảo mật nguy hiểm nhất.