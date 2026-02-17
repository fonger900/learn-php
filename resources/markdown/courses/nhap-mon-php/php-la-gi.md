# PHP là gì?

## Giới thiệu

PHP (Hypertext Preprocessor) là một ngôn ngữ lập trình kịch bản phía server (server-side scripting language) được thiết kế đặc biệt cho phát triển web. PHP được tạo ra bởi Rasmus Lerdorf vào năm 1994 và hiện đang được phát triển bởi The PHP Development Team.

## Tại sao học PHP?

### 1. Phổ biến và được sử dụng rộng rãi

- Hơn 77% websites trên internet sử dụng PHP
- Các nền tảng lớn như WordPress, Facebook, Wikipedia đều dùng PHP
- Cộng đồng developer lớn và năng động

### 2. Dễ học cho người mới bắt đầu

```php
<?php
echo "Hello, World!";
?>
```

Chỉ với 3 dòng code, bạn đã có thể tạo ra một chương trình PHP đầu tiên!

### 3. Miễn phí và Open Source

- Hoàn toàn miễn phí
- Mã nguồn mở, có thể tùy chỉnh
- Nhiều framework và thư viện hỗ trợ

### 4. Tích hợp tốt với Database

```php
<?php
// Kết nối MySQL dễ dàng
$conn = new mysqli("localhost", "user", "password", "database");

// Truy vấn dữ liệu
$result = $conn->query("SELECT * FROM users");
?>
```

### 5. Hỗ trợ đa nền tảng

- Chạy trên Windows, Linux, macOS
- Tương thích với hầu hết web servers (Apache, Nginx, IIS)
- Hỗ trợ nhiều databases (MySQL, PostgreSQL, MongoDB, etc.)

## PHP có thể làm gì?

### 1. Xử lý Form

```php
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    echo "Xin chào, $name! Email của bạn là: $email";
}
?>
```

### 2. Tạo nội dung động

```php
<?php
$hour = date('H');

if ($hour < 12) {
    echo "Chào buổi sáng!";
} elseif ($hour < 18) {
    echo "Chào buổi chiều!";
} else {
    echo "Chào buổi tối!";
}
?>
```

### 3. Làm việc với Database

```php
<?php
// Lấy danh sách sản phẩm từ database
$products = $db->query("SELECT * FROM products WHERE active = 1");

foreach ($products as $product) {
    echo "<h3>{$product['name']}</h3>";
    echo "<p>Giá: {$product['price']} VNĐ</p>";
}
?>
```

### 4. Xử lý File

```php
<?php
// Đọc file
$content = file_get_contents('data.txt');

// Ghi file
file_put_contents('output.txt', 'Nội dung mới');

// Upload file
move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/file.jpg');
?>
```

### 5. Tạo API

```php
<?php
header('Content-Type: application/json');

$data = [
    'status' => 'success',
    'message' => 'Dữ liệu đã được lấy thành công',
    'data' => [
        'id' => 1,
        'name' => 'Sản phẩm A'
    ]
];

echo json_encode($data);
?>
```

## Phiên bản PHP

### PHP 7.x (2015-2022)
- Cải thiện hiệu suất gấp 2 lần so với PHP 5
- Type declarations
- Null coalescing operator (`??`)
- Spaceship operator (`<=>`)

### PHP 8.x (2020-nay)
- JIT Compiler
- Named arguments
- Attributes
- Match expressions
- Union types
- Constructor property promotion

```php
<?php
// PHP 8 features
class User
{
    // Constructor property promotion
    public function __construct(
        public string $name,
        public string $email,
        public int $age
    ) {}
}

// Named arguments
$user = new User(
    name: 'John Doe',
    email: 'john@example.com',
    age: 25
);

// Match expression
$message = match($user->age) {
    0...17 => 'Trẻ em',
    18...59 => 'Người lớn',
    default => 'Người cao tuổi'
};
?>
```

## Cách PHP hoạt động

### 1. Client gửi request

```
Browser → HTTP Request → Web Server
```

### 2. Server xử lý PHP

```
Web Server → PHP Interpreter → Execute PHP Code
```

### 3. Trả về HTML

```
PHP Output → Web Server → HTTP Response → Browser
```

### Ví dụ minh họa

```php
<!-- index.php -->
<!DOCTYPE html>
<html>
<head>
    <title>PHP Demo</title>
</head>
<body>
    <h1>Thời gian hiện tại</h1>
    <p>
        <?php
        echo date('d/m/Y H:i:s');
        ?>
    </p>
    
    <h2>Danh sách số từ 1 đến 10</h2>
    <ul>
        <?php
        for ($i = 1; $i <= 10; $i++) {
            echo "<li>Số $i</li>";
        }
        ?>
    </ul>
</body>
</html>
```

## PHP vs JavaScript

| Đặc điểm | PHP | JavaScript |
|----------|-----|------------|
| Chạy ở đâu | Server-side | Client-side (và server với Node.js) |
| Syntax | Giống C | Giống C/Java |
| Mục đích chính | Backend, xử lý server | Frontend, tương tác UI |
| Database | Tích hợp sẵn | Cần thư viện |

## Công cụ cần thiết

### 1. Web Server
- Apache
- Nginx
- PHP Built-in Server

### 2. PHP Interpreter
- PHP 8.2+ (khuyến nghị)

### 3. Database (tùy chọn)
- MySQL/MariaDB
- PostgreSQL
- SQLite

### 4. IDE/Editor
- VS Code
- PhpStorm
- Sublime Text

### 5. Local Development Environment
- XAMPP
- MAMP
- Laravel Valet
- Docker

## Ứng dụng thực tế

### 1. Content Management Systems (CMS)
- WordPress (43% websites toàn cầu)
- Drupal
- Joomla

### 2. E-commerce
- WooCommerce
- Magento
- PrestaShop

### 3. Frameworks
- Laravel (phổ biến nhất)
- Symfony
- CodeIgniter
- Yii

### 4. Social Networks
- Facebook (ban đầu)
- Wikipedia
- Slack

## Tương lai của PHP

PHP vẫn đang phát triển mạnh mẽ với:

- Cải thiện hiệu suất liên tục
- Thêm features hiện đại
- Cộng đồng lớn và active
- Nhiều framework mạnh mẽ
- Hỗ trợ tốt cho cloud và microservices

## Kết luận

PHP là một ngôn ngữ mạnh mẽ, dễ học và có nhiều cơ hội việc làm. Với sự phát triển của PHP 8.x, ngôn ngữ này đã trở nên hiện đại hơn bao giờ hết.

Trong các bài học tiếp theo, chúng ta sẽ:
- Cài đặt môi trường PHP
- Viết chương trình PHP đầu tiên
- Học cú pháp cơ bản
- Làm việc với database
- Xây dựng ứng dụng thực tế

## Bài tập

1. Tìm hiểu về 3 websites lớn sử dụng PHP
2. So sánh PHP với một ngôn ngữ backend khác (Python, Ruby, Node.js)
3. Đọc về các tính năng mới trong PHP 8.2
