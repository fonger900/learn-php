# Tính năng mới trong PHP 8.x

## Named Arguments (8.0)

```php
<?php
function createUser(string $name, string $email, string $role = 'user'): array
{
    return compact('name', 'email', 'role');
}

$user = createUser(name: 'An', email: 'an@test.com', role: 'admin');
```

## Match Expression (8.0)

```php
<?php
$status = match ($code) {
    200 => 'OK',
    404 => 'Not Found',
    500 => 'Server Error',
    default => 'Unknown',
};
```

## Nullsafe Operator (8.0)

```php
<?php
// Trước PHP 8
$country = null;
if ($user !== null && $user->address !== null) {
    $country = $user->address->country;
}

// PHP 8+
$country = $user?->address?->country;
```

## Enums (8.1)

```php
<?php
enum Status: string
{
    case Active = 'active';
    case Inactive = 'inactive';
}

$s = Status::Active;
echo $s->value; // active
```

## Readonly Properties (8.1) & Classes (8.2)

```php
<?php
// 8.1: readonly property
class Point
{
    public function __construct(
        public readonly float $x,
        public readonly float $y,
    ) {}
}

// 8.2: readonly class
readonly class Coordinate
{
    public function __construct(
        public float $latitude,
        public float $longitude,
    ) {}
}
```

## Fibers (8.1)

```php
<?php
$fiber = new Fiber(function (): void {
    $value = Fiber::suspend('Xin chào');
    echo "Nhận: $value";
});

$result = $fiber->start();    // "Xin chào"
$fiber->resume('Thế giới');   // "Nhận: Thế giới"
```

## Intersection & DNF Types (8.1, 8.2)

```php
<?php
// Intersection: phải là CẢ hai kiểu
function process(Iterator&Countable $collection): void { }

// DNF (8.2): (A&B)|C
function handle((Renderable&Stringable)|string $input): void { }
```

## Bước tiếp theo 🚀

Chúc mừng bạn đã hoàn thành khóa học PHP cơ bản! Hãy tiếp tục với:

1. **Laravel** — Framework PHP phổ biến nhất
2. **Testing** — PHPUnit, Pest
3. **API Development** — RESTful API với Laravel
4. **DevOps** — Docker, CI/CD, deployment