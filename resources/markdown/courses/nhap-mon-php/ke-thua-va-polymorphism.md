# Kế thừa & Đa hình

## Kế thừa (Inheritance)

```php
<?php
class Animal
{
    public function __construct(
        protected string $name,
        protected int $age,
    ) {}

    public function speak(): string
    {
        return "$this->name kêu...";
    }
}

class Dog extends Animal
{
    public function speak(): string
    {
        return "$this->name: Gâu gâu!";
    }

    public function fetch(): string
    {
        return "$this->name đang nhặt bóng";
    }
}

class Cat extends Animal
{
    public function speak(): string
    {
        return "$this->name: Meo meo!";
    }
}

$dog = new Dog('Bobby', 3);
$cat = new Cat('Mimi', 2);

echo $dog->speak(); // Bobby: Gâu gâu!
echo $cat->speak(); // Mimi: Meo meo!
```

## Đa hình (Polymorphism)

```php
<?php
function makeThemSpeak(Animal ...$animals): void
{
    foreach ($animals as $animal) {
        echo $animal->speak() . "\n";
    }
}

makeThemSpeak(
    new Dog('Bobby', 3),
    new Cat('Mimi', 2),
);
// Bobby: Gâu gâu!
// Mimi: Meo meo!
```

## final

```php
<?php
class Payment
{
    // Không cho override method này
    final public function process(): void
    {
        $this->validate();
        $this->charge();
    }
}
```