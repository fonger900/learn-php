# Magic Methods

## Các magic methods thường dùng

| Method | Khi nào được gọi |
|--------|------------------|
| `__construct()` | Tạo object |
| `__destruct()` | Hủy object |
| `__toString()` | Ép sang string |
| `__get($name)` | Truy cập property không tồn tại |
| `__set($name, $value)` | Gán property không tồn tại |
| `__isset($name)` | `isset()` trên property |
| `__call($name, $args)` | Gọi method không tồn tại |
| `__invoke()` | Gọi object như function |

## Ví dụ

```php
<?php
class Config
{
    private array $data = [];

    public function __set(string $name, mixed $value): void
    {
        $this->data[$name] = $value;
    }

    public function __get(string $name): mixed
    {
        return $this->data[$name] ?? null;
    }

    public function __isset(string $name): bool
    {
        return isset($this->data[$name]);
    }

    public function __toString(): string
    {
        return json_encode($this->data, JSON_UNESCAPED_UNICODE);
    }
}

$config = new Config();
$config->appName = 'Học PHP';  // __set
echo $config->appName;          // __get → Học PHP
echo isset($config->appName);   // __isset → true
echo $config;                   // __toString → {"appName":"Học PHP"}
```

## __invoke — Object như function

```php
<?php
class Validator
{
    public function __construct(private int $min, private int $max) {}

    public function __invoke(int $value): bool
    {
        return $value >= $this->min && $value <= $this->max;
    }
}

$ageValidator = new Validator(0, 150);
echo $ageValidator(25);  // true
echo $ageValidator(200); // false
```