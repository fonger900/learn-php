# Vòng lặp

## for

```php
<?php
for ($i = 1; $i <= 5; $i++) {
    echo "Lần $i\n";
}
```

## while

```php
<?php
$count = 0;
while ($count < 3) {
    echo "Đếm: $count\n";
    $count++;
}
```

## do...while

```php
<?php
$num = 1;
do {
    echo "$num ";
    $num++;
} while ($num <= 5);
// Luôn chạy ít nhất 1 lần
```

## foreach (duyệt mảng)

```php
<?php
$fruits = ['Táo', 'Cam', 'Xoài'];

foreach ($fruits as $fruit) {
    echo "$fruit\n";
}

// Với key
$scores = ['Toán' => 9, 'Văn' => 7, 'Anh' => 8];
foreach ($scores as $mon => $diem) {
    echo "$mon: $diem\n";
}
```

## break và continue

```php
<?php
for ($i = 1; $i <= 10; $i++) {
    if ($i === 5) {
        continue; // Bỏ qua số 5
    }
    if ($i === 8) {
        break;    // Dừng khi đến 8
    }
    echo "$i ";
}
// Kết quả: 1 2 3 4 6 7
```

## Bài tập

1. In bảng cửu chương từ 2 đến 9
2. Tìm tất cả số nguyên tố nhỏ hơn 100