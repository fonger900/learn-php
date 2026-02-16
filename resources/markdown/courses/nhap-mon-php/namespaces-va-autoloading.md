# Namespaces & Autoloading

## Namespaces

```php
<?php
// file: src/Models/User.php
namespace App\Models;

class User
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
    ) {}
}
```

```php
<?php
// file: src/Services/AuthService.php
namespace App\Services;

use App\Models\User;

class AuthService
{
    public function register(string $name, string $email): User
    {
        return new User($name, $email);
    }
}
```

## use và alias

```php
<?php
use App\Models\User;
use App\Models\Post;
use App\Services\AuthService as Auth;
use function App\Helpers\format_currency;
use const App\Config\MAX_UPLOAD_SIZE;
```

## PSR-4 Autoloading

```json
// composer.json
{
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}
```

Quy tắc PSR-4:
- `App\Models\User` → `src/Models/User.php`
- `App\Services\AuthService` → `src/Services/AuthService.php`
- Tên file = tên class
- Namespace = cấu trúc thư mục

```bash
# Sau khi thay đổi autoload, chạy:
composer dump-autoload
```