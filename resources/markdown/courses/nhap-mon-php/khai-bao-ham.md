# Hàm (Functions)

## Khai báo hàm cơ bản

```php
<?php
function greet(string $name): string
{
    return "Xin chào, $name!";
}

echo greet('An'); // Xin chào, An!
```

## Tham số mặc định

```php
<?php
function createUser(string $name, string $role = 'member'): string
{
    return "$name ($role)";
}

echo createUser('An');            // An (member)
echo createUser('Bình', 'admin'); // Bình (admin)
```

## Named Arguments (PHP 8+)

```php
<?php
function buildQuery(
    string $table,
    int $limit = 10,
    int $offset = 0,
    string $orderBy = 'id',
): string {
    return "SELECT * FROM $table ORDER BY $orderBy LIMIT $limit OFFSET $offset";
}

// Gọi với named arguments — rõ ràng hơn
echo buildQuery(
    table: 'users',
    orderBy: 'name',
    limit: 20,
);
```

## Variadic parameters

```php
<?php
function sum(int ...$numbers): int
{
    return array_sum($numbers);
}

echo sum(1, 2, 3, 4, 5); // 15

$nums = [10, 20, 30];
echo sum(...$nums);       // 60 (spread)
```

## Kiểu trả về

```php
<?php
function divide(float $a, float $b): float|false
{
    if ($b === 0.0) {
        return false;
    }
    return $a / $b;
}

function processData(): void
{
    // Không trả về giá trị
}

function findUser(): ?User
{
    // Trả về User hoặc null
}
```