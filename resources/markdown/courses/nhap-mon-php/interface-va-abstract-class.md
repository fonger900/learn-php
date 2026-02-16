# Interface & Abstract Class

## Interface

```php
<?php
interface Payable
{
    public function calculateTotal(): float;
    public function getDescription(): string;
}

interface Shippable
{
    public function getWeight(): float;
    public function getShippingCost(): float;
}

class PhysicalProduct implements Payable, Shippable
{
    public function __construct(
        private string $name,
        private float $price,
        private float $weight,
    ) {}

    public function calculateTotal(): float
    {
        return $this->price + $this->getShippingCost();
    }

    public function getDescription(): string
    {
        return $this->name;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function getShippingCost(): float
    {
        return $this->weight * 15000; // 15k/kg
    }
}
```

## Abstract Class

```php
<?php
abstract class Shape
{
    abstract public function area(): float;

    // Phương thức cụ thể — class con được dùng luôn
    public function describe(): string
    {
        return sprintf('%s có diện tích %.2f', static::class, $this->area());
    }
}

class Circle extends Shape
{
    public function __construct(private float $radius) {}

    public function area(): float
    {
        return M_PI * $this->radius ** 2;
    }
}

class Rectangle extends Shape
{
    public function __construct(
        private float $width,
        private float $height,
    ) {}

    public function area(): float
    {
        return $this->width * $this->height;
    }
}

$circle = new Circle(5);
echo $circle->describe(); // Circle có diện tích 78.54
```

> 💡 **Interface** = "hợp đồng" (chỉ khai báo). **Abstract class** = "bản thiết kế" (có thể có code).