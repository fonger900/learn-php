# Vòng lặp

## Giới thiệu

Vòng lặp (loops) cho phép thực thi một đoạn code nhiều lần. PHP cung cấp nhiều loại vòng lặp khác nhau cho các tình huống khác nhau.

## For Loop

Sử dụng khi biết trước số lần lặp.

```php
<?php
// Cú pháp: for (khởi tạo; điều kiện; bước nhảy)
for ($i = 0; $i < 5; $i++) {
    echo "Lần lặp thứ $i<br>";
}

// In số từ 1 đến 10
for ($i = 1; $i <= 10; $i++) {
    echo $i . " ";
}

// Đếm ngược
for ($i = 10; $i >= 1; $i--) {
    echo $i . " ";
}

// Bước nhảy 2
for ($i = 0; $i <= 10; $i += 2) {
    echo $i . " "; // 0 2 4 6 8 10
}
?>
```

## While Loop

Lặp khi điều kiện còn đúng.

```php
<?php
$i = 0;
while ($i < 5) {
    echo "Lần lặp thứ $i<br>";
    $i++;
}

// Đọc file từng dòng
$file = fopen("data.txt", "r");
while (!feof($file)) {
    $line = fgets($file);
    echo $line;
}
fclose($file);
?>
```

## Do-While Loop

Thực thi ít nhất một lần, sau đó kiểm tra điều kiện.

```php
<?php
$i = 0;
do {
    echo "Lần lặp thứ $i<br>";
    $i++;
} while ($i < 5);

// Menu chương trình
do {
    echo "1. Thêm\n";
    echo "2. Sửa\n";
    echo "3. Xóa\n";
    echo "0. Thoát\n";
    $choice = readline("Chọn: ");
} while ($choice != 0);
?>
```

## Foreach Loop

Dùng để duyệt qua mảng.

```php
<?php
// Indexed array
$fruits = ["Apple", "Banana", "Orange"];

foreach ($fruits as $fruit) {
    echo $fruit . "<br>";
}

// Với index
foreach ($fruits as $index => $fruit) {
    echo "$index: $fruit<br>";
}

// Associative array
$user = [
    "name" => "John",
    "email" => "john@example.com",
    "age" => 25
];

foreach ($user as $key => $value) {
    echo "$key: $value<br>";
}

// Multi-dimensional array
$users = [
    ["name" => "John", "age" => 25],
    ["name" => "Jane", "age" => 30]
];

foreach ($users as $user) {
    echo "{$user['name']} - {$user['age']}<br>";
}
?>
```

## Break và Continue

```php
<?php
// Break - Thoát khỏi vòng lặp
for ($i = 0; $i < 10; $i++) {
    if ($i === 5) {
        break; // Dừng khi i = 5
    }
    echo $i . " "; // 0 1 2 3 4
}

// Continue - Bỏ qua lần lặp hiện tại
for ($i = 0; $i < 10; $i++) {
    if ($i % 2 === 0) {
        continue; // Bỏ qua số chẵn
    }
    echo $i . " "; // 1 3 5 7 9
}

// Break với nested loops
for ($i = 0; $i < 3; $i++) {
    for ($j = 0; $j < 3; $j++) {
        if ($i === 1 && $j === 1) {
            break 2; // Thoát cả 2 vòng lặp
        }
        echo "($i, $j) ";
    }
}
?>
```

## Ví dụ thực tế

### 1. Tạo bảng cửu chương

```php
<?php
for ($i = 1; $i <= 10; $i++) {
    echo "Bảng cửu chương $i:<br>";
    for ($j = 1; $j <= 10; $j++) {
        $result = $i * $j;
        echo "$i x $j = $result<br>";
    }
    echo "<br>";
}
?>
```

### 2. Tính tổng mảng

```php
<?php
$numbers = [10, 20, 30, 40, 50];
$sum = 0;

foreach ($numbers as $number) {
    $sum += $number;
}

echo "Tổng: $sum"; // 150
?>
```

### 3. Tìm số nguyên tố

```php
<?php
function isPrime($n) {
    if ($n < 2) return false;
    
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i === 0) {
            return false;
        }
    }
    
    return true;
}

// In số nguyên tố từ 1 đến 100
for ($i = 1; $i <= 100; $i++) {
    if (isPrime($i)) {
        echo $i . " ";
    }
}
?>
```

## Best Practices

```php
<?php
// ✅ Sử dụng foreach cho mảng
$items = [1, 2, 3, 4, 5];
foreach ($items as $item) {
    echo $item;
}

// ✅ Tránh vòng lặp vô hạn
$i = 0;
while ($i < 10) {
    echo $i;
    $i++; // Đừng quên tăng biến đếm!
}

// ✅ Sử dụng break/continue hợp lý
foreach ($users as $user) {
    if (!$user->isActive()) {
        continue;
    }
    // Process active users
}
?>
```

## Bài tập

1. In hình tam giác bằng dấu *
2. Tính giai thừa của một số
3. Đảo ngược một chuỗi
4. Tìm số Fibonacci thứ n
