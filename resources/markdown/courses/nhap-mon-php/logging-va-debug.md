# Logging & Debug

## error_log

```php
<?php
// Ghi vào PHP error log
error_log('Xảy ra lỗi tại checkout');
error_log('User ID: 123 - Lỗi thanh toán');

// Ghi vào file cụ thể
error_log("Error at " . date('Y-m-d H:i:s') . "\n", 3, '/var/log/app.log');
```

## Debug tools

```php
<?php
$user = ['name' => 'An', 'roles' => ['admin', 'editor']];

// var_dump — chi tiết nhất
var_dump($user);

// print_r — dễ đọc hơn
print_r($user);

// debug_backtrace — xem call stack
function a() { b(); }
function b() { print_r(debug_backtrace()); }
a();
```

## Set Error Reporting

```php
<?php
// Development
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Production
error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');
```

## Custom Error Handler

```php
<?php
set_error_handler(function (int $errno, string $errstr, string $errfile, int $errline): bool {
    $message = sprintf("[%s] %s in %s:%d", date('Y-m-d H:i:s'), $errstr, $errfile, $errline);
    error_log($message . "\n", 3, 'app-errors.log');
    return true; // true = đã xử lý, không cần handler mặc định
});

set_exception_handler(function (Throwable $e): void {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'Đã xảy ra lỗi. Vui lòng thử lại sau.';
});
```