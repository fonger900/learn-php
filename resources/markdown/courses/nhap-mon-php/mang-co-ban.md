# Mảng cơ bản

## Mảng chỉ số (Indexed Array)

```php
<?php
$fruits = ['Táo', 'Cam', 'Xoài'];
$fruits[] = 'Lê';       // Thêm phần tử

echo $fruits[0];         // Táo
echo count($fruits);     // 4
```

## Mảng kết hợp (Associative Array)

```php
<?php
$student = [
    'name' => 'Nguyễn An',
    'age' => 20,
    'gpa' => 8.5,
];

echo $student['name'];   // Nguyễn An
$student['email'] = 'an@example.com'; // Thêm key mới
```

## Mảng đa chiều

```php
<?php
$classRoom = [
    ['Nguyễn An', 9.0],
    ['Trần Bình', 8.5],
    ['Lê Chi', 7.0],
];

echo $classRoom[0][0]; // Nguyễn An
echo $classRoom[1][1]; // 8.5
```

## Kiểm tra mảng

```php
<?php
$data = ['a' => 1, 'b' => null];

isset($data['a']);         // true
isset($data['b']);         // false (null = not set)
array_key_exists('b', $data); // true (key tồn tại dù giá trị null)
in_array(1, $data);        // true
```