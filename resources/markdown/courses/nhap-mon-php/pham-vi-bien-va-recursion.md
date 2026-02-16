# Phạm vi biến & Đệ quy

## Phạm vi biến (Variable Scope)

```php
<?php
$global = 'Tôi là biến toàn cục';

function demo(): void
{
    // echo $global; // ❌ Không truy cập được
    global $global;
    echo $global; // ✅ Dùng global keyword
}

// Cách tốt hơn: truyền qua tham số
function betterDemo(string $value): void
{
    echo $value;
}
```

## Biến tĩnh (Static)

```php
<?php
function counter(): int
{
    static $count = 0;
    $count++;
    return $count;
}

echo counter(); // 1
echo counter(); // 2
echo counter(); // 3
```

## Đệ quy (Recursion)

```php
<?php
// Tính giai thừa
function factorial(int $n): int
{
    if ($n <= 1) {
        return 1;
    }
    return $n * factorial($n - 1);
}

echo factorial(5); // 120 (5 × 4 × 3 × 2 × 1)
```

## Ví dụ: Duyệt cây thư mục

```php
<?php
function listFiles(string $dir, int $depth = 0): void
{
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;

        $path = "$dir/$item";
        $indent = str_repeat('  ', $depth);

        if (is_dir($path)) {
            echo "$indent 📁 $item\n";
            listFiles($path, $depth + 1);
        } else {
            echo "$indent 📄 $item\n";
        }
    }
}

listFiles('/path/to/project');
```

> 💡 Đệ quy rất mạnh nhưng cần có **điều kiện dừng** để tránh lặp vô hạn.