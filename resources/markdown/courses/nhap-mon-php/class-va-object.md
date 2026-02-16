# Class và Object

## Khai báo Class

```php
<?php
class Product
{
    public string $name;
    public float $price;
    private int $stock;

    public function __construct(string $name, float $price, int $stock = 0)
    {
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
    }

    public function getFormattedPrice(): string
    {
        return number_format($this->price, 0, ',', '.') . ' VNĐ';
    }

    public function isInStock(): bool
    {
        return $this->stock > 0;
    }
}

$phone = new Product('iPhone 15', 25990000, 50);
echo $phone->name;               // iPhone 15
echo $phone->getFormattedPrice(); // 25.990.000 VNĐ
```

## Visibility (Phạm vi truy cập)

| Từ khóa | Class | Kế thừa | Bên ngoài |
|---------|-------|---------|-----------|
| `public` | ✅ | ✅ | ✅ |
| `protected` | ✅ | ✅ | ❌ |
| `private` | ✅ | ❌ | ❌ |

## Constructor Property Promotion (PHP 8+)

```php
<?php
class User
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        private string $password,
    ) {}
}

$user = new User('An', 'an@test.com', 'secret');
echo $user->name; // An
```