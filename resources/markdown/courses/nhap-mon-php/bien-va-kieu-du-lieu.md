# Biến và các kiểu dữ liệu

## Biến trong PHP

### Khai báo biến

Trong PHP, biến bắt đầu bằng ký tự `$` và không cần khai báo kiểu dữ liệu.

```php
<?php
$name = "John Doe";
$age = 25;
$price = 99.99;
$isActive = true;
?>
```

### Quy tắc đặt tên biến

```php
<?php
// ✅ Hợp lệ
$userName = "John";
$user_name = "John";
$userName2 = "John";
$_userName = "John";

// ❌ Không hợp lệ
$2userName = "John";  // Không bắt đầu bằng số
$user-name = "John";  // Không dùng dấu gạch ngang
$user name = "John";  // Không có khoảng trắng
?>
```

### Biến phân biệt chữ hoa/thường

```php
<?php
$name = "John";
$Name = "Jane";
$NAME = "Bob";

echo $name;  // John
echo $Name;  // Jane
echo $NAME;  // Bob
?>
```

## Các kiểu dữ liệu

### 1. String (Chuỗi)

```php
<?php
// Single quotes
$name = 'John Doe';

// Double quotes (có thể chứa biến)
$greeting = "Hello, $name!";

// Heredoc
$html = <<<HTML
<div>
    <h1>$name</h1>
    <p>Welcome to PHP</p>
</div>
HTML;

// Nowdoc (không parse biến)
$text = <<<'TEXT'
This is $name
TEXT;

echo $greeting;  // Hello, John Doe!
?>
```

### 2. Integer (Số nguyên)

```php
<?php
$decimal = 123;
$negative = -456;
$octal = 0123;      // Hệ bát phân
$hex = 0x1A;        // Hệ thập lục phân
$binary = 0b1010;   // Hệ nhị phân

// PHP 7.4+: Numeric separator
$million = 1_000_000;

var_dump($decimal);  // int(123)
?>
```

### 3. Float (Số thực)

```php
<?php
$price = 99.99;
$scientific = 1.5e3;  // 1500
$negative = -45.67;

// Lưu ý về độ chính xác
$a = 0.1 + 0.2;
echo $a;  // 0.3 (có thể không chính xác tuyệt đối)

// So sánh float
$epsilon = 0.00001;
if (abs($a - 0.3) < $epsilon) {
    echo "Bằng nhau";
}
?>
```

### 4. Boolean

```php
<?php
$isActive = true;
$isDeleted = false;

// Các giá trị được coi là false
$false1 = false;
$false2 = 0;
$false3 = 0.0;
$false4 = "";
$false5 = "0";
$false6 = null;
$false7 = [];

// Tất cả giá trị khác là true
if ($isActive) {
    echo "User is active";
}
?>
```

### 5. Array (Mảng)

```php
<?php
// Indexed array
$fruits = ["Apple", "Banana", "Orange"];
$numbers = array(1, 2, 3, 4, 5);

// Associative array
$user = [
    "name" => "John Doe",
    "email" => "john@example.com",
    "age" => 25
];

// Multi-dimensional array
$users = [
    ["name" => "John", "age" => 25],
    ["name" => "Jane", "age" => 30]
];

// Truy cập phần tử
echo $fruits[0];        // Apple
echo $user["name"];     // John Doe
echo $users[0]["age"];  // 25
?>
```

### 6. Object (Đối tượng)

```php
<?php
class User
{
    public $name;
    public $email;
    
    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }
    
    public function greet()
    {
        return "Hello, {$this->name}!";
    }
}

$user = new User("John Doe", "john@example.com");
echo $user->greet();  // Hello, John Doe!
?>
```

### 7. NULL

```php
<?php
$var = null;

// Biến chưa được gán giá trị
$undefinedVar;

// Biến đã bị unset
$deletedVar = "value";
unset($deletedVar);

// Kiểm tra null
if (is_null($var)) {
    echo "Variable is null";
}

// Null coalescing operator (PHP 7+)
$name = $username ?? "Guest";
?>
```

### 8. Resource

```php
<?php
// File handle
$file = fopen("data.txt", "r");

// Database connection
$conn = mysqli_connect("localhost", "user", "pass", "db");

// cURL handle
$ch = curl_init("https://api.example.com");

// Đóng resource
fclose($file);
mysqli_close($conn);
curl_close($ch);
?>
```

## Kiểm tra kiểu dữ liệu

```php
<?php
$var = "Hello";

// Kiểm tra kiểu cụ thể
is_string($var);   // true
is_int($var);      // false
is_float($var);    // false
is_bool($var);     // false
is_array($var);    // false
is_object($var);   // false
is_null($var);     // false
is_resource($var); // false

// Lấy kiểu dữ liệu
gettype($var);     // string

// var_dump - hiển thị chi tiết
var_dump($var);    // string(5) "Hello"
?>
```

## Ép kiểu (Type Casting)

```php
<?php
// Ép kiểu tường minh
$str = "123";
$int = (int)$str;        // 123
$float = (float)$str;    // 123.0
$bool = (bool)$str;      // true
$array = (array)$str;    // ["123"]

// Ép kiểu với hàm
$int2 = intval("456");   // 456
$float2 = floatval("78.9"); // 78.9
$str2 = strval(123);     // "123"

// Ví dụ thực tế
$price = "99.99";
$total = (float)$price * 2;  // 199.98

$userInput = "0";
if ((bool)$userInput) {
    echo "True";
} else {
    echo "False";  // Sẽ in ra False
}
?>
```

## Type Juggling (Tự động chuyển đổi)

```php
<?php
// PHP tự động chuyển đổi kiểu
$result = "10" + 5;      // 15 (string -> int)
$result = "10.5" + 2;    // 12.5 (string -> float)
$result = "10 apples" + 5; // 15 (lấy số ở đầu)

// So sánh
"10" == 10;   // true (so sánh giá trị)
"10" === 10;  // false (so sánh giá trị và kiểu)

// Nối chuỗi
$result = "Hello" . " " . "World";  // Hello World
$result = "Number: " . 123;         // Number: 123
?>
```

## Type Declarations (PHP 7+)

```php
<?php
// Khai báo kiểu tham số
function add(int $a, int $b): int
{
    return $a + $b;
}

// Khai báo kiểu return
function getName(): string
{
    return "John Doe";
}

// Nullable types (PHP 7.1+)
function findUser(?int $id): ?User
{
    if ($id === null) {
        return null;
    }
    return User::find($id);
}

// Union types (PHP 8+)
function process(int|float $number): int|float
{
    return $number * 2;
}

// Mixed type (PHP 8+)
function getValue(): mixed
{
    return "anything";
}
?>
```

## Hằng số (Constants)

```php
<?php
// Định nghĩa hằng số
define("SITE_NAME", "My Website");
const MAX_USERS = 100;

// Sử dụng
echo SITE_NAME;  // My Website

// Hằng số magic
echo __FILE__;      // Đường dẫn file hiện tại
echo __LINE__;      // Số dòng hiện tại
echo __DIR__;       // Thư mục hiện tại
echo __FUNCTION__;  // Tên hàm hiện tại
echo __CLASS__;     // Tên class hiện tại
echo __METHOD__;    // Tên method hiện tại

// Class constants
class Config
{
    public const VERSION = "1.0.0";
    private const API_KEY = "secret";
}

echo Config::VERSION;  // 1.0.0
?>
```

## Variable Variables

```php
<?php
$var = "name";
$$var = "John";

echo $name;  // John

// Ví dụ thực tế
$field = "email";
$user = [
    "name" => "John",
    "email" => "john@example.com"
];

echo $user[$field];  // john@example.com
?>
```

## Best Practices

```php
<?php
// ✅ Sử dụng type declarations
function calculateTotal(float $price, int $quantity): float
{
    return $price * $quantity;
}

// ✅ Sử dụng strict types
declare(strict_types=1);

// ✅ Khởi tạo biến trước khi dùng
$total = 0;
foreach ($items as $item) {
    $total += $item->price;
}

// ✅ Sử dụng null coalescing
$username = $_GET['username'] ?? 'guest';

// ✅ Đặt tên biến có ý nghĩa
$userEmail = "john@example.com";  // Good
$e = "john@example.com";          // Bad
?>
```

## Bài tập

1. Tạo các biến với tất cả các kiểu dữ liệu và in ra màn hình
2. Viết hàm chuyển đổi nhiệt độ từ Celsius sang Fahrenheit với type declarations
3. Tạo một mảng associative chứa thông tin sinh viên và in ra các thông tin
4. Thực hành với null coalescing operator và nullsafe operator

```php
<?php
// Bài tập 1: Giải pháp mẫu
$string = "Hello PHP";
$integer = 42;
$float = 3.14;
$boolean = true;
$array = [1, 2, 3];
$null = null;

var_dump($string, $integer, $float, $boolean, $array, $null);
?>
```
