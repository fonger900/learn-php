# CRUD với PDO

## CREATE

```php
<?php
$stmt = $pdo->prepare(
    'INSERT INTO products (name, price, stock) VALUES (:name, :price, :stock)'
);
$stmt->execute([
    'name' => 'Laptop Dell',
    'price' => 15990000,
    'stock' => 25,
]);

$newId = $pdo->lastInsertId();
echo "Đã thêm sản phẩm ID: $newId";
```

## READ

```php
<?php
// Tìm theo ID
$stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
$stmt->execute([1]);
$product = $stmt->fetch();

// Tìm nhiều với điều kiện
$stmt = $pdo->prepare('SELECT * FROM products WHERE price < ? ORDER BY price DESC LIMIT ?');
$stmt->execute([20000000, 10]);
$products = $stmt->fetchAll();
```

## UPDATE

```php
<?php
$stmt = $pdo->prepare('UPDATE products SET price = :price, stock = :stock WHERE id = :id');
$stmt->execute([
    'price' => 14990000,
    'stock' => 20,
    'id' => 1,
]);

echo "Đã cập nhật {$stmt->rowCount()} sản phẩm";
```

## DELETE

```php
<?php
$stmt = $pdo->prepare('DELETE FROM products WHERE id = ?');
$stmt->execute([1]);

echo "Đã xóa {$stmt->rowCount()} sản phẩm";
```

## Transaction

```php
<?php
try {
    $pdo->beginTransaction();

    $pdo->prepare('UPDATE accounts SET balance = balance - ? WHERE id = ?')
        ->execute([500000, 1]);
    $pdo->prepare('UPDATE accounts SET balance = balance + ? WHERE id = ?')
        ->execute([500000, 2]);

    $pdo->commit();
    echo 'Chuyển tiền thành công';
} catch (Exception $e) {
    $pdo->rollBack();
    echo 'Lỗi: ' . $e->getMessage();
}
```