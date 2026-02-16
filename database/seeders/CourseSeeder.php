<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $course = Course::create([
            'title' => 'Nhập môn PHP',
            'slug' => 'nhap-mon-php',
            'description' => 'Khóa học PHP toàn diện dành cho người mới bắt đầu đến trung cấp. Tìm hiểu về cú pháp, cấu trúc điều khiển, hàm, mảng, xử lý file, lập trình hướng đối tượng, database, và các tính năng PHP hiện đại.',
            'level' => 'beginner',
        ]);

        $this->seedModule1($course);
        $this->seedModule2($course);
        $this->seedModule3($course);
        $this->seedModule4($course);
        $this->seedModule5($course);
        $this->seedModule6($course);
        $this->seedModule7($course);
        $this->seedModule8($course);
        $this->seedModule9($course);
        $this->seedModule10($course);
        $this->seedModule11($course);
        $this->seedModule12($course);
    }

    private function seedModule1(Course $course): void
    {
        $module = Module::create([
            'course_id' => $course->id,
            'title' => 'Giới thiệu về PHP',
            'order' => 1,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'PHP là gì?',
            'slug' => 'php-la-gi',
            'content' => <<<'EOT'
# PHP là gì?

PHP (Hypertext Preprocessor) là một ngôn ngữ lập trình kịch bản **mã nguồn mở**, được thiết kế chuyên biệt cho phát triển web.

## Tại sao nên học PHP?

| Ưu điểm | Mô tả |
|----------|--------|
| Dễ học | Cú pháp đơn giản, thân thiện với người mới |
| Phổ biến | Hơn 77% website sử dụng PHP |
| Hệ sinh thái lớn | Laravel, WordPress, Symfony, Drupal |
| Cộng đồng mạnh | Tài liệu phong phú, hỗ trợ nhiệt tình |
| Cơ hội việc làm | Nhu cầu tuyển dụng cao tại Việt Nam |

## Chương trình PHP đầu tiên

```php
<?php
echo 'Xin chào, PHP!';
```

PHP chạy trên **server** (server-side), tạo ra HTML rồi gửi đến trình duyệt. Đây là điểm khác biệt so với JavaScript chạy trên trình duyệt (client-side).

> 💡 File PHP luôn có phần mở rộng `.php` và bắt đầu bằng thẻ `<?php`.
EOT,
            'order' => 1,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Cài đặt môi trường',
            'slug' => 'cai-dat-moi-truong',
            'content' => <<<'EOT'
# Cài đặt môi trường

## Các công cụ phổ biến

| Công cụ | Hệ điều hành | Ưu điểm |
|---------|-------------|---------|
| XAMPP | Windows/Linux/Mac | Dễ cài, đầy đủ Apache + MySQL + PHP |
| Laragon | Windows | Nhẹ, nhanh, hỗ trợ Laravel tốt |
| Homebrew | Mac | `brew install php` |
| Docker | Tất cả | Chuyên nghiệp, tách biệt môi trường |

## Cài đặt XAMPP

1. Tải XAMPP từ [apachefriends.org](https://www.apachefriends.org/)
2. Cài đặt và khởi động Apache
3. Tạo file `test.php` trong thư mục `htdocs`

## Kiểm tra cài đặt

```bash
php -v
# PHP 8.4.x (cli) ...
```

## PHP tích hợp sẵn Web Server

```bash
# Khởi động server tại thư mục hiện tại
php -S localhost:8080

# Mở trình duyệt → http://localhost:8080
```

> 💡 PHP có web server tích hợp sẵn, rất tiện cho việc học và phát triển.
EOT,
            'order' => 2,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Chương trình đầu tiên',
            'slug' => 'chuong-trinh-dau-tien',
            'content' => <<<'EOT'
# Chương trình PHP đầu tiên

## Cấu trúc cơ bản

```php
<?php
// Đây là comment một dòng

/*
 * Đây là comment
 * nhiều dòng
 */

echo 'Xin chào thế giới!';     // Xuất chuỗi
echo '<br>';                     // Xuống dòng HTML
echo "Hôm nay là ngày đẹp trời"; // Chuỗi dùng dấu nháy kép
```

## echo vs print

```php
<?php
echo 'Nhanh hơn', ' và ', 'nhận nhiều đối số';  // echo nhận nhiều tham số
print 'Chỉ nhận một đối số';                     // print trả về 1
```

## PHP trong HTML

```php
<!DOCTYPE html>
<html>
<body>
    <h1><?php echo 'Tiêu đề từ PHP'; ?></h1>
    <p>Hôm nay là: <?= date('d/m/Y') ?></p>
</body>
</html>
```

> 💡 `<?= ... ?>` là cú pháp rút gọn của `<?php echo ... ?>`.

## Bài tập

1. Tạo file `hello.php` in ra tên và tuổi của bạn
2. Tạo trang HTML có PHP hiển thị ngày giờ hiện tại
EOT,
            'order' => 3,
        ]);
    }

    private function seedModule2(Course $course): void
    {
        $module = Module::create([
            'course_id' => $course->id,
            'title' => 'Cú pháp cơ bản',
            'order' => 2,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Biến và các kiểu dữ liệu',
            'slug' => 'bien-va-kieu-du-lieu',
            'content' => <<<'EOT'
# Biến và Kiểu Dữ Liệu

## Khai báo biến

Biến trong PHP bắt đầu bằng dấu `$`, không cần khai báo kiểu.

```php
<?php
$ten = 'Nguyễn Văn A';   // string
$tuoi = 25;               // integer
$diemTB = 8.5;            // float
$isStudent = true;        // boolean
$diaChi = null;           // null
```

## Các kiểu dữ liệu

| Kiểu | Ví dụ | Mô tả |
|------|-------|-------|
| `string` | `'Xin chào'` | Chuỗi ký tự |
| `int` | `42` | Số nguyên |
| `float` | `3.14` | Số thực |
| `bool` | `true` / `false` | Giá trị logic |
| `array` | `[1, 2, 3]` | Mảng |
| `null` | `null` | Không có giá trị |
| `object` | `new DateTime()` | Đối tượng |

## Kiểm tra kiểu dữ liệu

```php
<?php
$x = 42;
echo gettype($x);        // "integer"
var_dump($x);             // int(42)
echo is_int($x);          // true
```

## Nháy đơn vs nháy kép

```php
<?php
$ten = 'PHP';
echo 'Xin chào $ten';    // Xin chào $ten (không parse)
echo "Xin chào $ten";    // Xin chào PHP (parse biến)
echo "2 + 3 = {$x}";     // Dùng {} cho biểu thức phức tạp
```

## Hằng số

```php
<?php
define('SITE_NAME', 'Học PHP');
const MAX_USERS = 100;

echo SITE_NAME;  // Học PHP
echo PHP_VERSION; // Hằng có sẵn
```
EOT,
            'order' => 1,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Toán tử',
            'slug' => 'toan-tu',
            'content' => <<<'EOT'
# Toán tử trong PHP

## Toán tử số học

```php
<?php
$a = 10;
$b = 3;

echo $a + $b;   // 13  Cộng
echo $a - $b;   // 7   Trừ
echo $a * $b;   // 30  Nhân
echo $a / $b;   // 3.33 Chia
echo $a % $b;   // 1   Chia lấy dư
echo $a ** $b;  // 1000 Lũy thừa
```

## Toán tử so sánh

| Toán tử | Ý nghĩa | Ví dụ |
|---------|---------|-------|
| `==` | Bằng (giá trị) | `5 == '5'` → `true` |
| `===` | Bằng (giá trị + kiểu) | `5 === '5'` → `false` |
| `!=` | Khác | `5 != 3` → `true` |
| `<>` | Khác | `5 <> 3` → `true` |
| `!==` | Khác (kiểu) | `5 !== '5'` → `true` |
| `<=>` | Spaceship | `1 <=> 2` → `-1` |

> ⚠️ Luôn ưu tiên `===` thay vì `==` để tránh lỗi do ép kiểu ngầm.

## Toán tử logic

```php
<?php
$a = true;
$b = false;

var_dump($a && $b);   // false  (AND)
var_dump($a || $b);   // true   (OR)
var_dump(!$a);         // false  (NOT)
```

## Toán tử Null Coalescing `??`

```php
<?php
$username = $_GET['user'] ?? 'Khách';
// Nếu $_GET['user'] tồn tại và không null → dùng nó
// Ngược lại → 'Khách'

$config = $custom ?? $default ?? 'fallback';
```
EOT,
            'order' => 2,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Ép kiểu và Juggling',
            'slug' => 'ep-kieu-va-juggling',
            'content' => <<<'EOT'
# Ép kiểu (Type Casting)

## Ép kiểu tự động (Type Juggling)

PHP tự động chuyển đổi kiểu khi cần:

```php
<?php
$result = '10' + 5;       // 15 (string → int)
$result = '10.5' + 1;     // 11.5 (string → float)
$result = true + true;    // 2 (bool → int)
```

## Ép kiểu thủ công (Type Casting)

```php
<?php
$str = '42';
$int = (int) $str;         // 42
$float = (float) '3.14';   // 3.14
$bool = (bool) 0;           // false
$array = (array) 'hello';   // ['hello']
$str = (string) 100;        // '100'
```

## Bảng ép kiểu sang boolean

| Giá trị | Kết quả |
|---------|---------|
| `0`, `0.0` | `false` |
| `''`, `'0'` | `false` |
| `[]` (mảng rỗng) | `false` |
| `null` | `false` |
| Mọi giá trị khác | `true` |

## Strict Types (PHP 7+)

```php
<?php
declare(strict_types=1);

function add(int $a, int $b): int {
    return $a + $b;
}

echo add(2, 3);     // 5
// add('2', 3);      // TypeError! Vì strict_types = 1
```

> 💡 Dùng `declare(strict_types=1)` ở đầu file để PHP kiểm tra kiểu nghiêm ngặt.
EOT,
            'order' => 3,
        ]);
    }

    private function seedModule3(Course $course): void
    {
        $module = Module::create([
            'course_id' => $course->id,
            'title' => 'Cấu trúc điều khiển',
            'order' => 3,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Câu lệnh điều kiện',
            'slug' => 'cau-lenh-dieu-kien',
            'content' => <<<'EOT'
# Câu lệnh điều kiện

## if / elseif / else

```php
<?php
$diem = 8.5;

if ($diem >= 9) {
    echo 'Xuất sắc';
} elseif ($diem >= 7) {
    echo 'Khá';
} elseif ($diem >= 5) {
    echo 'Trung bình';
} else {
    echo 'Yếu';
}
```

## Toán tử ba ngôi (Ternary)

```php
<?php
$tuoi = 20;
$loai = ($tuoi >= 18) ? 'Người lớn' : 'Trẻ em';
echo $loai; // Người lớn
```

## switch

```php
<?php
$ngay = 'Thứ Hai';

switch ($ngay) {
    case 'Thứ Hai':
    case 'Thứ Ba':
        echo 'Đầu tuần';
        break;
    case 'Thứ Bảy':
    case 'Chủ Nhật':
        echo 'Cuối tuần';
        break;
    default:
        echo 'Giữa tuần';
}
```

## match (PHP 8+)

```php
<?php
$statusCode = 404;

$message = match ($statusCode) {
    200 => 'OK',
    301 => 'Chuyển hướng',
    404 => 'Không tìm thấy',
    500 => 'Lỗi server',
    default => 'Không xác định',
};

echo $message; // Không tìm thấy
```

> 💡 `match` dùng so sánh `===` (strict), khác với `switch` dùng `==`.
EOT,
            'order' => 1,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Vòng lặp',
            'slug' => 'vong-lap',
            'content' => <<<'EOT'
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
EOT,
            'order' => 2,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Match expression và Enum',
            'slug' => 'match-expression-va-enum',
            'content' => <<<'EOT'
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
EOT,
            'order' => 3,
        ]);
    }

    private function seedModule4(Course $course): void
    {
        $module = Module::create([
            'course_id' => $course->id,
            'title' => 'Chuỗi (Strings)',
            'order' => 4,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Xử lý chuỗi',
            'slug' => 'xu-ly-chuoi',
            'content' => <<<'EOT'
# Xử lý Chuỗi

## Tạo chuỗi

```php
<?php
$single = 'Nháy đơn - không parse biến';
$double = "Nháy kép - parse $single";

// Heredoc (giống nháy kép)
$heredoc = <<<EOD
Đây là heredoc.
Có thể viết nhiều dòng.
Parse biến: $single
EOD;

// Nowdoc (giống nháy đơn)
$nowdoc = <<<'EOD'
Không parse biến: $single
EOD;
```

## Nối chuỗi

```php
<?php
$ho = 'Nguyễn';
$ten = 'An';

// Cách 1: Toán tử nối
$fullName = $ho . ' ' . $ten;

// Cách 2: Nội suy (interpolation)
$fullName = "$ho $ten";

// Cách 3: sprintf
$fullName = sprintf('%s %s', $ho, $ten);
```

## Các hàm chuỗi thường dùng

| Hàm | Mô tả | Ví dụ |
|-----|--------|-------|
| `strlen()` | Độ dài | `strlen('PHP')` → `3` |
| `strtoupper()` | Chữ hoa | `strtoupper('php')` → `'PHP'` |
| `strtolower()` | Chữ thường | `strtolower('PHP')` → `'php'` |
| `trim()` | Xóa khoảng trắng | `trim(' hi ')` → `'hi'` |
| `substr()` | Cắt chuỗi | `substr('Hello', 0, 3)` → `'Hel'` |
| `str_replace()` | Thay thế | `str_replace('a', 'b', 'abc')` → `'bbc'` |
| `strpos()` | Tìm vị trí | `strpos('Hello', 'lo')` → `3` |
| `explode()` | Tách thành mảng | `explode(',', 'a,b,c')` → `['a','b','c']` |
| `implode()` | Nối mảng thành chuỗi | `implode('-', [1,2])` → `'1-2'` |
EOT,
            'order' => 1,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Hàm chuỗi nâng cao',
            'slug' => 'ham-chuoi-nang-cao',
            'content' => <<<'EOT'
# Hàm Chuỗi Nâng Cao

## str_contains, str_starts_with, str_ends_with (PHP 8+)

```php
<?php
$email = 'user@example.com';

echo str_contains($email, '@');        // true
echo str_starts_with($email, 'user');  // true
echo str_ends_with($email, '.com');    // true
```

## sprintf & number_format

```php
<?php
$price = 1234567.89;

echo sprintf('Giá: %s VNĐ', number_format($price, 0, ',', '.'));
// Giá: 1.234.568 VNĐ

echo sprintf('Tên: %-20s | Điểm: %05.2f', 'An', 8.5);
// Tên: An                   | Điểm: 08.50
```

## Multibyte strings (xử lý tiếng Việt)

```php
<?php
$str = 'Xin chào Việt Nam';

echo strlen($str);       // 21 (bytes, sai!)
echo mb_strlen($str);    // 17 (ký tự, đúng!)

echo mb_strtoupper($str);         // XIN CHÀO VIỆT NAM
echo mb_substr($str, 9, 4);       // Việt
echo mb_detect_encoding($str);    // UTF-8
```

> ⚠️ Luôn dùng hàm `mb_*` khi xử lý tiếng Việt hoặc Unicode.

## Biểu thức chính quy (Regex)

```php
<?php
$phone = '0912 345 678';

// Kiểm tra SĐT Việt Nam
if (preg_match('/^0\d{9,10}$/', str_replace(' ', '', $phone))) {
    echo 'SĐT hợp lệ';
}

// Tìm tất cả số
preg_match_all('/\d+/', 'Năm 2026, tháng 2, ngày 16', $matches);
print_r($matches[0]); // ['2026', '2', '16']

// Thay thế
echo preg_replace('/\s+/', '-', 'Học PHP Cơ Bản');
// Học-PHP-Cơ-Bản
```
EOT,
            'order' => 2,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Bài tập chuỗi',
            'slug' => 'bai-tap-chuoi',
            'content' => <<<'EOT'
# Bài tập Xử lý Chuỗi

## Bài 1: Đếm từ

```php
<?php
function demTu(string $str): int
{
    return str_word_count($str);
}

echo demTu('PHP là ngôn ngữ tuyệt vời'); // 5
```

## Bài 2: Chuyển slug

```php
<?php
function toSlug(string $str): string
{
    $str = mb_strtolower($str);
    $str = preg_replace('/[^a-z0-9\s-]/', '', $str);
    $str = preg_replace('/[\s-]+/', '-', $str);

    return trim($str, '-');
}

echo toSlug('Học PHP Cơ Bản!'); // hc-php-c-bn
```

## Bài 3: Validate email

```php
<?php
function validateEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

var_dump(validateEmail('test@gmail.com'));  // true
var_dump(validateEmail('invalid-email'));   // false
```

## Bài 4: Ẩn số điện thoại

```php
<?php
function hidePhone(string $phone): string
{
    $clean = preg_replace('/\D/', '', $phone);

    return substr($clean, 0, 3) . '****' . substr($clean, -3);
}

echo hidePhone('0912 345 678'); // 091****678
```

## Thử thách

1. Viết hàm đảo ngược chuỗi Unicode (hỗ trợ tiếng Việt)
2. Viết hàm đếm nguyên âm trong chuỗi tiếng Việt
3. Viết hàm chuyển đổi `camelCase` sang `snake_case`
EOT,
            'order' => 3,
        ]);
    }

    private function seedModule5(Course $course): void
    {
        $module = Module::create([
            'course_id' => $course->id,
            'title' => 'Mảng (Arrays)',
            'order' => 5,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Mảng cơ bản',
            'slug' => 'mang-co-ban',
            'content' => <<<'EOT'
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
EOT,
            'order' => 1,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Các hàm mảng',
            'slug' => 'cac-ham-mang',
            'content' => <<<'EOT'
# Các hàm mảng quan trọng

## Thêm / Xóa

```php
<?php
$arr = [1, 2, 3];

array_push($arr, 4);       // [1, 2, 3, 4]
array_pop($arr);            // [1, 2, 3] — xóa cuối
array_unshift($arr, 0);    // [0, 1, 2, 3] — thêm đầu
array_shift($arr);          // [1, 2, 3] — xóa đầu
```

## Sắp xếp

| Hàm | Mô tả |
|-----|--------|
| `sort()` | Tăng dần theo giá trị |
| `rsort()` | Giảm dần theo giá trị |
| `asort()` | Tăng dần, giữ key |
| `ksort()` | Tăng dần theo key |
| `usort()` | Sắp xếp tùy chỉnh |

```php
<?php
$scores = [85, 92, 78, 95, 88];
sort($scores);
print_r($scores); // [78, 85, 88, 92, 95]

usort($scores, fn($a, $b) => $b - $a); // Giảm dần
```

## Lọc, map, reduce

```php
<?php
$numbers = [1, 2, 3, 4, 5, 6, 7, 8];

// Lọc số chẵn
$even = array_filter($numbers, fn($n) => $n % 2 === 0);
// [2, 4, 6, 8]

// Nhân đôi
$doubled = array_map(fn($n) => $n * 2, $numbers);
// [2, 4, 6, 8, 10, 12, 14, 16]

// Tổng
$sum = array_reduce($numbers, fn($carry, $n) => $carry + $n, 0);
// 36
```

## Spread operator

```php
<?php
$first = [1, 2, 3];
$second = [4, 5, 6];
$merged = [...$first, ...$second]; // [1, 2, 3, 4, 5, 6]
```
EOT,
            'order' => 2,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Array destructuring',
            'slug' => 'array-destructuring',
            'content' => <<<'EOT'
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
EOT,
            'order' => 3,
        ]);
    }

    private function seedModule6(Course $course): void
    {
        $module = Module::create([
            'course_id' => $course->id,
            'title' => 'Hàm (Functions)',
            'order' => 6,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Khai báo hàm',
            'slug' => 'khai-bao-ham',
            'content' => <<<'EOT'
# Hàm (Functions)

## Khai báo hàm cơ bản

```php
<?php
function greet(string $name): string
{
    return "Xin chào, $name!";
}

echo greet('An'); // Xin chào, An!
```

## Tham số mặc định

```php
<?php
function createUser(string $name, string $role = 'member'): string
{
    return "$name ($role)";
}

echo createUser('An');            // An (member)
echo createUser('Bình', 'admin'); // Bình (admin)
```

## Named Arguments (PHP 8+)

```php
<?php
function buildQuery(
    string $table,
    int $limit = 10,
    int $offset = 0,
    string $orderBy = 'id',
): string {
    return "SELECT * FROM $table ORDER BY $orderBy LIMIT $limit OFFSET $offset";
}

// Gọi với named arguments — rõ ràng hơn
echo buildQuery(
    table: 'users',
    orderBy: 'name',
    limit: 20,
);
```

## Variadic parameters

```php
<?php
function sum(int ...$numbers): int
{
    return array_sum($numbers);
}

echo sum(1, 2, 3, 4, 5); // 15

$nums = [10, 20, 30];
echo sum(...$nums);       // 60 (spread)
```

## Kiểu trả về

```php
<?php
function divide(float $a, float $b): float|false
{
    if ($b === 0.0) {
        return false;
    }
    return $a / $b;
}

function processData(): void
{
    // Không trả về giá trị
}

function findUser(): ?User
{
    // Trả về User hoặc null
}
```
EOT,
            'order' => 1,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Hàm ẩn danh và Arrow Functions',
            'slug' => 'ham-an-danh-va-arrow',
            'content' => <<<'EOT'
# Hàm ẩn danh & Arrow Functions

## Hàm ẩn danh (Closure)

```php
<?php
$greet = function (string $name): string {
    return "Xin chào, $name!";
};

echo $greet('An'); // Xin chào, An!
```

## use — truy cập biến bên ngoài

```php
<?php
$prefix = 'Mr.';

$format = function (string $name) use ($prefix): string {
    return "$prefix $name";
};

echo $format('An'); // Mr. An
```

## Arrow Functions (PHP 7.4+)

```php
<?php
// Arrow function tự động capture biến từ scope cha
$multiplier = 3;
$multiply = fn(int $n): int => $n * $multiplier;

echo $multiply(5); // 15

// Rất hữu ích với array functions
$prices = [100000, 250000, 50000];
$withVAT = array_map(fn($p) => $p * 1.1, $prices);
// [110000, 275000, 55000]
```

## Callback functions

```php
<?php
function applyDiscount(array $prices, callable $calculator): array
{
    return array_map($calculator, $prices);
}

$prices = [100, 200, 300];

// Giảm 10%
$discounted = applyDiscount($prices, fn($p) => $p * 0.9);
// [90, 180, 270]

// Giảm cố định 20
$discounted = applyDiscount($prices, fn($p) => max(0, $p - 20));
// [80, 180, 280]
```

## First-class callable syntax (PHP 8.1+)

```php
<?php
$lengths = array_map(strlen(...), ['PHP', 'Laravel', 'Hi']);
// [3, 7, 2]

$numbers = [3, 1, 4, 1, 5];
usort($numbers, strcmp(...)); // So sánh string
```
EOT,
            'order' => 2,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Phạm vi biến và Recursion',
            'slug' => 'pham-vi-bien-va-recursion',
            'content' => <<<'EOT'
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
EOT,
            'order' => 3,
        ]);
    }

    private function seedModule7(Course $course): void
    {
        $module = Module::create([
            'course_id' => $course->id,
            'title' => 'Xử lý File',
            'order' => 7,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Đọc và ghi file',
            'slug' => 'doc-va-ghi-file',
            'content' => <<<'EOT'
# Đọc và Ghi File

## Đọc file

```php
<?php
// Đọc toàn bộ file thành chuỗi
$content = file_get_contents('data.txt');

// Đọc thành mảng (mỗi dòng = 1 phần tử)
$lines = file('data.txt', FILE_IGNORE_NEW_LINES);

// Đọc từng dòng
$fp = fopen('data.txt', 'r');
while (($line = fgets($fp)) !== false) {
    echo trim($line) . "\n";
}
fclose($fp);
```

## Ghi file

```php
<?php
// Ghi đè toàn bộ
file_put_contents('log.txt', "Dòng mới\n");

// Ghi thêm (append)
file_put_contents('log.txt', "Thêm dòng\n", FILE_APPEND);

// Dùng fopen
$fp = fopen('output.txt', 'w'); // 'w' = ghi đè, 'a' = append
fwrite($fp, "Xin chào\n");
fclose($fp);
```

## Kiểm tra file

```php
<?php
file_exists('data.txt');    // File có tồn tại?
is_file('data.txt');        // Có phải file?
is_dir('uploads');          // Có phải thư mục?
is_readable('data.txt');    // Có thể đọc?
is_writable('data.txt');    // Có thể ghi?
filesize('data.txt');       // Kích thước (bytes)
```
EOT,
            'order' => 1,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Làm việc với CSV và JSON',
            'slug' => 'csv-va-json',
            'content' => <<<'EOT'
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
EOT,
            'order' => 2,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Upload file',
            'slug' => 'upload-file',
            'content' => <<<'EOT'
# Upload File

## Form HTML

```html
<form method="POST" action="upload.php" enctype="multipart/form-data">
    <input type="file" name="avatar">
    <button type="submit">Tải lên</button>
</form>
```

## Xử lý upload trong PHP

```php
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['avatar'];

    // Kiểm tra lỗi
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die('Lỗi upload: ' . $file['error']);
    }

    // Validate
    $allowed = ['image/jpeg', 'image/png', 'image/webp'];
    if (!in_array($file['type'], $allowed)) {
        die('Chỉ chấp nhận JPEG, PNG, WebP');
    }

    $maxSize = 5 * 1024 * 1024; // 5MB
    if ($file['size'] > $maxSize) {
        die('File quá lớn (tối đa 5MB)');
    }

    // Lưu file với tên an toàn
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = uniqid('avatar_') . '.' . $ext;
    $dest = __DIR__ . '/uploads/' . $newName;

    move_uploaded_file($file['tmp_name'], $dest);
    echo "Upload thành công: $newName";
}
```

> ⚠️ Không bao giờ tin tưởng tên file từ người dùng. Luôn tạo tên file mới.
EOT,
            'order' => 3,
        ]);
    }

    private function seedModule8(Course $course): void
    {
        $module = Module::create([
            'course_id' => $course->id,
            'title' => 'Lập trình hướng đối tượng (OOP)',
            'order' => 8,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Class và Object',
            'slug' => 'class-va-object',
            'content' => <<<'EOT'
# Class và Object

## Khai báo Class

```php
<?php
class Product
{
    public string $name;
    public float $price;
    private int $stock;

    public function __construct(string $name, float $price, int $stock = 0)
    {
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
    }

    public function getFormattedPrice(): string
    {
        return number_format($this->price, 0, ',', '.') . ' VNĐ';
    }

    public function isInStock(): bool
    {
        return $this->stock > 0;
    }
}

$phone = new Product('iPhone 15', 25990000, 50);
echo $phone->name;               // iPhone 15
echo $phone->getFormattedPrice(); // 25.990.000 VNĐ
```

## Visibility (Phạm vi truy cập)

| Từ khóa | Class | Kế thừa | Bên ngoài |
|---------|-------|---------|-----------|
| `public` | ✅ | ✅ | ✅ |
| `protected` | ✅ | ✅ | ❌ |
| `private` | ✅ | ❌ | ❌ |

## Constructor Property Promotion (PHP 8+)

```php
<?php
class User
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        private string $password,
    ) {}
}

$user = new User('An', 'an@test.com', 'secret');
echo $user->name; // An
```
EOT,
            'order' => 1,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Kế thừa và Polymorphism',
            'slug' => 'ke-thua-va-polymorphism',
            'content' => <<<'EOT'
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
EOT,
            'order' => 2,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Interface và Abstract Class',
            'slug' => 'interface-va-abstract-class',
            'content' => <<<'EOT'
# Interface & Abstract Class

## Interface

```php
<?php
interface Payable
{
    public function calculateTotal(): float;
    public function getDescription(): string;
}

interface Shippable
{
    public function getWeight(): float;
    public function getShippingCost(): float;
}

class PhysicalProduct implements Payable, Shippable
{
    public function __construct(
        private string $name,
        private float $price,
        private float $weight,
    ) {}

    public function calculateTotal(): float
    {
        return $this->price + $this->getShippingCost();
    }

    public function getDescription(): string
    {
        return $this->name;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function getShippingCost(): float
    {
        return $this->weight * 15000; // 15k/kg
    }
}
```

## Abstract Class

```php
<?php
abstract class Shape
{
    abstract public function area(): float;

    // Phương thức cụ thể — class con được dùng luôn
    public function describe(): string
    {
        return sprintf('%s có diện tích %.2f', static::class, $this->area());
    }
}

class Circle extends Shape
{
    public function __construct(private float $radius) {}

    public function area(): float
    {
        return M_PI * $this->radius ** 2;
    }
}

class Rectangle extends Shape
{
    public function __construct(
        private float $width,
        private float $height,
    ) {}

    public function area(): float
    {
        return $this->width * $this->height;
    }
}

$circle = new Circle(5);
echo $circle->describe(); // Circle có diện tích 78.54
```

> 💡 **Interface** = "hợp đồng" (chỉ khai báo). **Abstract class** = "bản thiết kế" (có thể có code).
EOT,
            'order' => 3,
        ]);
    }

    private function seedModule9(Course $course): void
    {
        $module = Module::create([
            'course_id' => $course->id,
            'title' => 'OOP nâng cao',
            'order' => 9,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Traits',
            'slug' => 'traits',
            'content' => <<<'EOT'
# Traits

Traits cho phép tái sử dụng code giữa các class không có quan hệ kế thừa.

## Cơ bản

```php
<?php
trait HasTimestamps
{
    private ?DateTime $createdAt = null;
    private ?DateTime $updatedAt = null;

    public function setCreatedAt(): void
    {
        $this->createdAt = new DateTime();
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }
}

trait SoftDeletes
{
    private ?DateTime $deletedAt = null;

    public function softDelete(): void
    {
        $this->deletedAt = new DateTime();
    }

    public function isDeleted(): bool
    {
        return $this->deletedAt !== null;
    }
}

class Post
{
    use HasTimestamps, SoftDeletes;

    public function __construct(public string $title) {}
}

$post = new Post('Học PHP');
$post->setCreatedAt();
$post->softDelete();
echo $post->isDeleted(); // true
```

## Giải quyết xung đột

```php
<?php
trait A
{
    public function hello(): string { return 'A'; }
}

trait B
{
    public function hello(): string { return 'B'; }
}

class MyClass
{
    use A, B {
        A::hello insteadof B; // Ưu tiên A
        B::hello as helloB;   // Đổi tên B
    }
}
```

> 💡 Traits rất phổ biến trong Laravel: `SoftDeletes`, `HasFactory`, `Notifiable`...
EOT,
            'order' => 1,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Magic Methods',
            'slug' => 'magic-methods',
            'content' => <<<'EOT'
# Magic Methods

## Các magic methods thường dùng

| Method | Khi nào được gọi |
|--------|------------------|
| `__construct()` | Tạo object |
| `__destruct()` | Hủy object |
| `__toString()` | Ép sang string |
| `__get($name)` | Truy cập property không tồn tại |
| `__set($name, $value)` | Gán property không tồn tại |
| `__isset($name)` | `isset()` trên property |
| `__call($name, $args)` | Gọi method không tồn tại |
| `__invoke()` | Gọi object như function |

## Ví dụ

```php
<?php
class Config
{
    private array $data = [];

    public function __set(string $name, mixed $value): void
    {
        $this->data[$name] = $value;
    }

    public function __get(string $name): mixed
    {
        return $this->data[$name] ?? null;
    }

    public function __isset(string $name): bool
    {
        return isset($this->data[$name]);
    }

    public function __toString(): string
    {
        return json_encode($this->data, JSON_UNESCAPED_UNICODE);
    }
}

$config = new Config();
$config->appName = 'Học PHP';  // __set
echo $config->appName;          // __get → Học PHP
echo isset($config->appName);   // __isset → true
echo $config;                   // __toString → {"appName":"Học PHP"}
```

## __invoke — Object như function

```php
<?php
class Validator
{
    public function __construct(private int $min, private int $max) {}

    public function __invoke(int $value): bool
    {
        return $value >= $this->min && $value <= $this->max;
    }
}

$ageValidator = new Validator(0, 150);
echo $ageValidator(25);  // true
echo $ageValidator(200); // false
```
EOT,
            'order' => 2,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Static và Design Patterns',
            'slug' => 'static-va-design-patterns',
            'content' => <<<'EOT'
# Static & Design Patterns

## Static Properties & Methods

```php
<?php
class Counter
{
    private static int $count = 0;

    public static function increment(): void
    {
        self::$count++;
    }

    public static function getCount(): int
    {
        return self::$count;
    }
}

Counter::increment();
Counter::increment();
echo Counter::getCount(); // 2
```

## Singleton Pattern

```php
<?php
class Database
{
    private static ?self $instance = null;

    private function __construct(private string $dsn) {}

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self('mysql:host=localhost;dbname=app');
        }
        return self::$instance;
    }
}

$db = Database::getInstance(); // Luôn trả về cùng 1 instance
```

## Factory Method Pattern

```php
<?php
class Notification
{
    private function __construct(
        public readonly string $type,
        public readonly string $message,
    ) {}

    public static function email(string $message): self
    {
        return new self('email', $message);
    }

    public static function sms(string $message): self
    {
        return new self('sms', $message);
    }
}

$noti = Notification::email('Chào bạn!');
echo $noti->type; // email
```

## Builder Pattern

```php
<?php
class QueryBuilder
{
    private string $table = '';
    private array $conditions = [];
    private ?int $limit = null;

    public function from(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    public function where(string $condition): self
    {
        $this->conditions[] = $condition;
        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    public function build(): string
    {
        $sql = "SELECT * FROM {$this->table}";
        if ($this->conditions) {
            $sql .= ' WHERE ' . implode(' AND ', $this->conditions);
        }
        if ($this->limit) {
            $sql .= " LIMIT {$this->limit}";
        }
        return $sql;
    }
}

$query = (new QueryBuilder())
    ->from('users')
    ->where('age > 18')
    ->where('active = 1')
    ->limit(10)
    ->build();
// SELECT * FROM users WHERE age > 18 AND active = 1 LIMIT 10
```
EOT,
            'order' => 3,
        ]);
    }

    private function seedModule10(Course $course): void
    {
        $module = Module::create([
            'course_id' => $course->id,
            'title' => 'Xử lý lỗi & Exception',
            'order' => 10,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Try, Catch, Finally',
            'slug' => 'try-catch-finally',
            'content' => <<<'EOT'
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
EOT,
            'order' => 1,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Custom Exception',
            'slug' => 'custom-exception',
            'content' => <<<'EOT'
# Custom Exception

## Tạo exception riêng

```php
<?php
class InsufficientFundsException extends RuntimeException
{
    public function __construct(
        private float $balance,
        private float $amount,
    ) {
        parent::__construct(
            sprintf('Số dư %s không đủ để rút %s',
                number_format($balance),
                number_format($amount)
            )
        );
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}

// Sử dụng
function withdraw(float $balance, float $amount): float
{
    if ($amount > $balance) {
        throw new InsufficientFundsException($balance, $amount);
    }
    return $balance - $amount;
}

try {
    withdraw(500000, 1000000);
} catch (InsufficientFundsException $e) {
    echo $e->getMessage();
    echo "Thiếu: " . number_format($e->getAmount() - $e->getBalance());
}
```

## Error Handling tốt

```php
<?php
// ❌ Sai: bắt tất cả và bỏ qua
try {
    riskyOperation();
} catch (Exception $e) {
    // Không làm gì — ĐỪNG làm thế!
}

// ✅ Đúng: xử lý hoặc ném lại
try {
    riskyOperation();
} catch (SpecificException $e) {
    log($e->getMessage());
    throw $e; // Ném lại để caller xử lý
}
```

> 💡 Chỉ bắt exception khi bạn **biết cách xử lý nó**. Nếu không, hãy để nó "nổi lên" (bubble up).
EOT,
            'order' => 2,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Logging và Debug',
            'slug' => 'logging-va-debug',
            'content' => <<<'EOT'
# Logging & Debug

## error_log

```php
<?php
// Ghi vào PHP error log
error_log('Xảy ra lỗi tại checkout');
error_log('User ID: 123 - Lỗi thanh toán');

// Ghi vào file cụ thể
error_log("Error at " . date('Y-m-d H:i:s') . "\n", 3, '/var/log/app.log');
```

## Debug tools

```php
<?php
$user = ['name' => 'An', 'roles' => ['admin', 'editor']];

// var_dump — chi tiết nhất
var_dump($user);

// print_r — dễ đọc hơn
print_r($user);

// debug_backtrace — xem call stack
function a() { b(); }
function b() { print_r(debug_backtrace()); }
a();
```

## Set Error Reporting

```php
<?php
// Development
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Production
error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');
```

## Custom Error Handler

```php
<?php
set_error_handler(function (int $errno, string $errstr, string $errfile, int $errline): bool {
    $message = sprintf("[%s] %s in %s:%d", date('Y-m-d H:i:s'), $errstr, $errfile, $errline);
    error_log($message . "\n", 3, 'app-errors.log');
    return true; // true = đã xử lý, không cần handler mặc định
});

set_exception_handler(function (Throwable $e): void {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'Đã xảy ra lỗi. Vui lòng thử lại sau.';
});
```
EOT,
            'order' => 3,
        ]);
    }

    private function seedModule11(Course $course): void
    {
        $module = Module::create([
            'course_id' => $course->id,
            'title' => 'Làm việc với Database',
            'order' => 11,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'PDO cơ bản',
            'slug' => 'pdo-co-ban',
            'content' => <<<'EOT'
# PDO — PHP Data Objects

## Kết nối database

```php
<?php
try {
    $pdo = new PDO(
        dsn: 'mysql:host=localhost;dbname=myapp;charset=utf8mb4',
        username: 'root',
        password: '',
        options: [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ],
    );
    echo 'Kết nối thành công!';
} catch (PDOException $e) {
    die('Lỗi kết nối: ' . $e->getMessage());
}
```

## Truy vấn đơn giản

```php
<?php
// SELECT nhiều dòng
$stmt = $pdo->query('SELECT * FROM users');
$users = $stmt->fetchAll();

foreach ($users as $user) {
    echo "{$user['name']} - {$user['email']}\n";
}

// SELECT một dòng
$stmt = $pdo->query('SELECT COUNT(*) as total FROM users');
$result = $stmt->fetch();
echo "Tổng: {$result['total']}";
```

## Prepared Statements (QUAN TRỌNG!)

```php
<?php
// ⚠️ KHÔNG BAO GIỜ làm thế này (SQL Injection!)
// $pdo->query("SELECT * FROM users WHERE id = $id");

// ✅ Dùng prepared statement
$stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
$stmt->execute(['email' => 'an@test.com']);
$user = $stmt->fetch();
```

> ⚠️ **Luôn dùng Prepared Statements** để tránh SQL Injection — lỗ hổng bảo mật nguy hiểm nhất.
EOT,
            'order' => 1,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'CRUD với PDO',
            'slug' => 'crud-voi-pdo',
            'content' => <<<'EOT'
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
EOT,
            'order' => 2,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Bảo mật Database',
            'slug' => 'bao-mat-database',
            'content' => <<<'EOT'
# Bảo mật Database

## SQL Injection

```php
<?php
// ❌ NGUY HIỂM: Dữ liệu người dùng trực tiếp vào SQL
$name = $_GET['name']; // Hacker nhập: ' OR 1=1 --
$pdo->query("SELECT * FROM users WHERE name = '$name'");
// → SELECT * FROM users WHERE name = '' OR 1=1 --'
// → Trả về TẤT CẢ users!

// ✅ AN TOÀN: Dùng Prepared Statement
$stmt = $pdo->prepare('SELECT * FROM users WHERE name = ?');
$stmt->execute([$_GET['name']]);
```

## Validate & Sanitize Input

```php
<?php
// Validate email
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
if ($email === false) {
    die('Email không hợp lệ');
}

// Sanitize — loại bỏ ký tự nguy hiểm
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);

// Validate số
$age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1, 'max_range' => 150],
]);
```

## Password Hashing

```php
<?php
// Tạo hash (khi đăng ký)
$password = 'mat_khau_123';
$hash = password_hash($password, PASSWORD_BCRYPT);
// $2y$10$...

// Xác minh (khi đăng nhập)
$inputPassword = $_POST['password'];
if (password_verify($inputPassword, $hash)) {
    echo 'Đăng nhập thành công!';
} else {
    echo 'Sai mật khẩu!';
}
```

> ⚠️ **Không bao giờ** lưu mật khẩu dạng plain text. Luôn dùng `password_hash()`.

## Checklist bảo mật

- ✅ Dùng Prepared Statements cho mọi truy vấn
- ✅ Validate & sanitize tất cả input
- ✅ Hash password với `password_hash()`
- ✅ Dùng HTTPS
- ✅ Giới hạn quyền database user
- ✅ Không hiển thị lỗi chi tiết cho user
EOT,
            'order' => 3,
        ]);
    }

    private function seedModule12(Course $course): void
    {
        $module = Module::create([
            'course_id' => $course->id,
            'title' => 'PHP hiện đại',
            'order' => 12,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Namespaces và Autoloading',
            'slug' => 'namespaces-va-autoloading',
            'content' => <<<'EOT'
# Namespaces & Autoloading

## Namespaces

```php
<?php
// file: src/Models/User.php
namespace App\Models;

class User
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
    ) {}
}
```

```php
<?php
// file: src/Services/AuthService.php
namespace App\Services;

use App\Models\User;

class AuthService
{
    public function register(string $name, string $email): User
    {
        return new User($name, $email);
    }
}
```

## use và alias

```php
<?php
use App\Models\User;
use App\Models\Post;
use App\Services\AuthService as Auth;
use function App\Helpers\format_currency;
use const App\Config\MAX_UPLOAD_SIZE;
```

## PSR-4 Autoloading

```json
// composer.json
{
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}
```

Quy tắc PSR-4:
- `App\Models\User` → `src/Models/User.php`
- `App\Services\AuthService` → `src/Services/AuthService.php`
- Tên file = tên class
- Namespace = cấu trúc thư mục

```bash
# Sau khi thay đổi autoload, chạy:
composer dump-autoload
```
EOT,
            'order' => 1,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'Composer - Quản lý dependencies',
            'slug' => 'composer-quan-ly-dependencies',
            'content' => <<<'EOT'
# Composer

Composer là công cụ quản lý dependencies (thư viện) cho PHP.

## Cài đặt Composer

```bash
# Mac
brew install composer

# Hoặc tải từ getcomposer.org
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
```

## Khởi tạo project

```bash
composer init
```

## Cài đặt packages

```bash
# Cài package
composer require guzzlehttp/guzzle

# Cài package cho development
composer require --dev phpunit/phpunit

# Cài từ composer.lock
composer install

# Cập nhật packages
composer update
```

## Sử dụng

```php
<?php
// Chỉ cần require autoload 1 lần
require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();
$response = $client->get('https://api.github.com/repos/laravel/laravel');
$data = json_decode($response->getBody(), true);

echo "Stars: {$data['stargazers_count']}";
```

## Các packages phổ biến

| Package | Mô tả |
|---------|--------|
| `laravel/framework` | Framework web #1 |
| `guzzlehttp/guzzle` | HTTP client |
| `phpunit/phpunit` | Unit testing |
| `monolog/monolog` | Logging |
| `carbon/carbon` | Xử lý ngày giờ |
| `vlucas/phpdotenv` | Đọc file .env |

> 💡 Luôn commit `composer.lock` vào Git để đảm bảo mọi người dùng cùng phiên bản.
EOT,
            'order' => 2,
        ]);

        Lesson::create([
            'module_id' => $module->id,
            'title' => 'PHP 8.x - Tính năng mới',
            'slug' => 'php-8x-tinh-nang-moi',
            'content' => <<<'EOT'
# Tính năng mới trong PHP 8.x

## Named Arguments (8.0)

```php
<?php
function createUser(string $name, string $email, string $role = 'user'): array
{
    return compact('name', 'email', 'role');
}

$user = createUser(name: 'An', email: 'an@test.com', role: 'admin');
```

## Match Expression (8.0)

```php
<?php
$status = match ($code) {
    200 => 'OK',
    404 => 'Not Found',
    500 => 'Server Error',
    default => 'Unknown',
};
```

## Nullsafe Operator (8.0)

```php
<?php
// Trước PHP 8
$country = null;
if ($user !== null && $user->address !== null) {
    $country = $user->address->country;
}

// PHP 8+
$country = $user?->address?->country;
```

## Enums (8.1)

```php
<?php
enum Status: string
{
    case Active = 'active';
    case Inactive = 'inactive';
}

$s = Status::Active;
echo $s->value; // active
```

## Readonly Properties (8.1) & Classes (8.2)

```php
<?php
// 8.1: readonly property
class Point
{
    public function __construct(
        public readonly float $x,
        public readonly float $y,
    ) {}
}

// 8.2: readonly class
readonly class Coordinate
{
    public function __construct(
        public float $latitude,
        public float $longitude,
    ) {}
}
```

## Fibers (8.1)

```php
<?php
$fiber = new Fiber(function (): void {
    $value = Fiber::suspend('Xin chào');
    echo "Nhận: $value";
});

$result = $fiber->start();    // "Xin chào"
$fiber->resume('Thế giới');   // "Nhận: Thế giới"
```

## Intersection & DNF Types (8.1, 8.2)

```php
<?php
// Intersection: phải là CẢ hai kiểu
function process(Iterator&Countable $collection): void { }

// DNF (8.2): (A&B)|C
function handle((Renderable&Stringable)|string $input): void { }
```

## Bước tiếp theo 🚀

Chúc mừng bạn đã hoàn thành khóa học PHP cơ bản! Hãy tiếp tục với:

1. **Laravel** — Framework PHP phổ biến nhất
2. **Testing** — PHPUnit, Pest
3. **API Development** — RESTful API với Laravel
4. **DevOps** — Docker, CI/CD, deployment
EOT,
            'order' => 3,
        ]);
    }
}
