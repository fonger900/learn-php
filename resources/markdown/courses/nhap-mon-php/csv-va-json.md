# CSV và JSON

## Đọc CSV

```php
<?php
$fp = fopen('students.csv', 'r');
$header = fgetcsv($fp); // Dòng tiêu đề

$students = [];
while (($row = fgetcsv($fp)) !== false) {
    $students[] = array_combine($header, $row);
}
fclose($fp);

// $students = [['name' => 'An', 'score' => '9'], ...]
```

## Ghi CSV

```php
<?php
$data = [
    ['Tên', 'Điểm', 'Xếp loại'],
    ['An', 9, 'Giỏi'],
    ['Bình', 7, 'Khá'],
];

$fp = fopen('output.csv', 'w');
// BOM cho Excel đọc UTF-8 tiếng Việt
fwrite($fp, "\xEF\xBB\xBF");
foreach ($data as $row) {
    fputcsv($fp, $row);
}
fclose($fp);
```

## JSON

```php
<?php
// Encode
$data = ['name' => 'An', 'skills' => ['PHP', 'Laravel']];
$json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
file_put_contents('data.json', $json);

// Decode
$content = file_get_contents('data.json');
$parsed = json_decode($content, true); // true = trả về array
echo $parsed['name']; // An
```

> 💡 Dùng `JSON_UNESCAPED_UNICODE` để giữ nguyên tiếng Việt trong JSON.