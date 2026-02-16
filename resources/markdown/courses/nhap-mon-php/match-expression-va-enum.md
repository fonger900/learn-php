# Match Expression & Enum

## match nâng cao

```php
<?php
$value = 42;

$result = match (true) {
    $value < 0 => 'Âm',
    $value === 0 => 'Không',
    $value <= 10 => 'Nhỏ',
    $value <= 100 => 'Trung bình',
    default => 'Lớn',
};

echo $result; // Trung bình
```

## match với no-match error

```php
<?php
$color = 'tím';

// UnhandledMatchError nếu không có case phù hợp
// Luôn thêm default để an toàn
$hex = match ($color) {
    'đỏ' => '#FF0000',
    'xanh' => '#00FF00',
    default => '#000000',
};
```

## Enum (PHP 8.1+)

```php
<?php
enum Status {
    case Active;
    case Inactive;
    case Pending;
}

$s = Status::Active;
echo $s->name; // "Active"
```

## Backed Enum

```php
<?php
enum Color: string {
    case Red = 'đỏ';
    case Green = 'xanh lá';
    case Blue = 'xanh dương';
}

$c = Color::Red;
echo $c->value;             // đỏ
echo Color::from('đỏ')->name; // Red

// tryFrom trả về null nếu không tìm thấy
$found = Color::tryFrom('tím'); // null
```

## Enum với method

```php
<?php
enum Suit: string {
    case Hearts = '♥';
    case Diamonds = '♦';
    case Clubs = '♣';
    case Spades = '♠';

    public function isRed(): bool
    {
        return match ($this) {
            self::Hearts, self::Diamonds => true,
            default => false,
        };
    }
}

echo Suit::Hearts->isRed(); // true
```