# Composer

Composer là công cụ quản lý dependencies (thư viện) cho PHP.

## Cài đặt Composer

```bash
# Mac
brew install composer

# Hoặc tải từ getcomposer.org
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
```

## Khởi tạo project

```bash
composer init
```

## Cài đặt packages

```bash
# Cài package
composer require guzzlehttp/guzzle

# Cài package cho development
composer require --dev phpunit/phpunit

# Cài từ composer.lock
composer install

# Cập nhật packages
composer update
```

## Sử dụng

```php
<?php
// Chỉ cần require autoload 1 lần
require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();
$response = $client->get('https://api.github.com/repos/laravel/laravel');
$data = json_decode($response->getBody(), true);

echo "Stars: {$data['stargazers_count']}";
```

## Các packages phổ biến

| Package | Mô tả |
|---------|--------|
| `laravel/framework` | Framework web #1 |
| `guzzlehttp/guzzle` | HTTP client |
| `phpunit/phpunit` | Unit testing |
| `monolog/monolog` | Logging |
| `carbon/carbon` | Xử lý ngày giờ |
| `vlucas/phpdotenv` | Đọc file .env |

> 💡 Luôn commit `composer.lock` vào Git để đảm bảo mọi người dùng cùng phiên bản.