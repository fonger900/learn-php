# Array Destructuring & Thao tác nâng cao

## Destructuring

```php
<?php
$coords = [10.762622, 106.660172];
[$lat, $lng] = $coords;
echo "Vĩ độ: $lat, Kinh độ: $lng";

// Với key
$person = ['name' => 'An', 'age' => 25, 'city' => 'HCM'];
['name' => $name, 'city' => $city] = $person;
echo "$name sống tại $city"; // An sống tại HCM
```

## array_combine & array_column

```php
<?php
$keys = ['name', 'age', 'city'];
$values = ['An', 25, 'HCM'];
$person = array_combine($keys, $values);
// ['name' => 'An', 'age' => 25, 'city' => 'HCM']

$students = [
    ['name' => 'An', 'score' => 9],
    ['name' => 'Bình', 'score' => 7],
    ['name' => 'Chi', 'score' => 8],
];

$names = array_column($students, 'name');
// ['An', 'Bình', 'Chi']

$byName = array_column($students, 'score', 'name');
// ['An' => 9, 'Bình' => 7, 'Chi' => 8]
```

## Compact & Extract

```php
<?php
$title = 'PHP cơ bản';
$level = 'beginner';
$data = compact('title', 'level');
// ['title' => 'PHP cơ bản', 'level' => 'beginner']

extract($data);
echo $title; // PHP cơ bản
```

## Bài tập

1. Viết hàm tìm phần tử xuất hiện nhiều nhất trong mảng
2. Viết hàm gộp 2 mảng kết hợp, giá trị mảng 2 ghi đè mảng 1
3. Viết hàm nhóm mảng sinh viên theo điểm (giỏi/khá/TB)