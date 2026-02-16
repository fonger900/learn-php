# Xử lý lỗi với Exception

## Cơ bản

```php
<?php
try {
    $result = 10 / 0;
} catch (DivisionByZeroError $e) {
    echo 'Lỗi: ' . $e->getMessage();
} finally {
    echo 'Luôn chạy dù có lỗi hay không';
}
```

## Bắt nhiều loại exception

```php
<?php
try {
    $data = json_decode(file_get_contents('config.json'), true, 512, JSON_THROW_ON_ERROR);
    $connection = new PDO($data['dsn']);
} catch (JsonException $e) {
    echo "JSON không hợp lệ: {$e->getMessage()}";
} catch (PDOException $e) {
    echo "Lỗi database: {$e->getMessage()}";
} catch (Exception $e) {
    echo "Lỗi chung: {$e->getMessage()}";
}
```

## Throw exception

```php
<?php
function withdraw(float $balance, float $amount): float
{
    if ($amount <= 0) {
        throw new InvalidArgumentException('Số tiền phải > 0');
    }
    if ($amount > $balance) {
        throw new RuntimeException('Số dư không đủ');
    }
    return $balance - $amount;
}

try {
    echo withdraw(1000000, 2000000);
} catch (RuntimeException $e) {
    echo $e->getMessage(); // Số dư không đủ
}
```

## Hierarchy của Exception

```
Throwable
├── Error (lỗi nội bộ PHP)
│   ├── TypeError
│   ├── ValueError
│   └── DivisionByZeroError
└── Exception (lỗi ứng dụng)
    ├── RuntimeException
    ├── InvalidArgumentException
    ├── LogicException
    └── PDOException
```