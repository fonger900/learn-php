# Hàm ẩn danh & Arrow Functions

## Hàm ẩn danh (Closure)

```php
<?php
$greet = function (string $name): string {
    return "Xin chào, $name!";
};

echo $greet('An'); // Xin chào, An!
```

## use — truy cập biến bên ngoài

```php
<?php
$prefix = 'Mr.';

$format = function (string $name) use ($prefix): string {
    return "$prefix $name";
};

echo $format('An'); // Mr. An
```

## Arrow Functions (PHP 7.4+)

```php
<?php
// Arrow function tự động capture biến từ scope cha
$multiplier = 3;
$multiply = fn(int $n): int => $n * $multiplier;

echo $multiply(5); // 15

// Rất hữu ích với array functions
$prices = [100000, 250000, 50000];
$withVAT = array_map(fn($p) => $p * 1.1, $prices);
// [110000, 275000, 55000]
```

## Callback functions

```php
<?php
function applyDiscount(array $prices, callable $calculator): array
{
    return array_map($calculator, $prices);
}

$prices = [100, 200, 300];

// Giảm 10%
$discounted = applyDiscount($prices, fn($p) => $p * 0.9);
// [90, 180, 270]

// Giảm cố định 20
$discounted = applyDiscount($prices, fn($p) => max(0, $p - 20));
// [80, 180, 280]
```

## First-class callable syntax (PHP 8.1+)

```php
<?php
$lengths = array_map(strlen(...), ['PHP', 'Laravel', 'Hi']);
// [3, 7, 2]

$numbers = [3, 1, 4, 1, 5];
usort($numbers, strcmp(...)); // So sánh string
```