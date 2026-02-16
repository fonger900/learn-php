<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Module;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
  public function run(): void
  {
    $course = Course::create([
      'title' => 'Nhập môn PHP',
      'slug' => 'nhap-mon-php',
      'description' => 'Khóa học PHP cơ bản dành cho người mới bắt đầu. Tìm hiểu về cú pháp, biến, hàm và lập trình hướng đối tượng.',
      'level' => 'beginner',
    ]);

    // Module 1: Giới thiệu
    $module1 = Module::create([
      'course_id' => $course->id,
      'title' => 'Giới thiệu về PHP',
      'order' => 1,
    ]);

    Lesson::create([
      'module_id' => $module1->id,
      'title' => 'PHP là gì?',
      'slug' => 'php-la-gi',
      'content' => <<<'EOT'
# PHP là gì?

PHP (Hypertext Preprocessor) là một ngôn ngữ lập trình kịch bản mã nguồn mở, được sử dụng rộng rãi để phát triển web.

## Tại sao nên học PHP?

- **Dễ học**: PHP có cú pháp đơn giản, dễ tiếp cận cho người mới.
- **Mạnh mẽ**: Được sử dụng bởi các nền tảng lớn như WordPress, Facebook, Laravel.
- **Cộng đồng lớn**: Tài liệu phong phú và cộng đồng hỗ trợ nhiệt tình.

```php
<?php
echo 'Xin chào, PHP!';
?>
```

Hãy cùng bắt đầu hành trình chinh phục PHP nhé!
EOT,
      'order' => 1,
    ]);

    Lesson::create([
      'module_id' => $module1->id,
      'title' => 'Cài đặt môi trường',
      'slug' => 'cai-dat-moi-truong',
      'content' => <<<'EOT'
# Cài đặt môi trường

Để chạy PHP, bạn cần cài đặt một Web Server (như Apache, Nginx) và PHP.

Cách đơn giản nhất là sử dụng các công cụ trọn gói:
- **XAMPP** (Windows/Linux/Mac)
- **Laragon** (Windows)
- **Homebrew** (Mac)

## Kiểm tra cài đặt

Sau khi cài đặt, mở terminal và gõ:

```bash
php -v
```

Nếu thấy phiên bản PHP hiện ra, bạn đã cài đặt thành công!
EOT,
      'order' => 2,
    ]);

    // Module 2: Cú pháp cơ bản
    $module2 = Module::create([
      'course_id' => $course->id,
      'title' => 'Cú pháp cơ bản',
      'order' => 2,
    ]);

    Lesson::create([
      'module_id' => $module2->id,
      'title' => 'Biến và các kiểu dữ liệu',
      'slug' => 'bien-va-kieu-du-lieu',
      'content' => <<<'EOT'
# Biến trong PHP

Biến trong PHP bắt đầu bằng dấu `$`.

```php
<?php
$ten = 'Nguyen Van A';
$tuoi = 25;
$pi = 3.14;
$isStudent = true;

echo "Xin chào, tôi là $ten, $tuoi tuổi.";
?>
```

## Các kiểu dữ liệu cơ bản
- String (Chuỗi)
- Integer (Số nguyên)
- Float (Số thực)
- Boolean (Logic)
- Array (Mảng)
EOT,
      'order' => 1,
    ]);

    Lesson::create([
      'module_id' => $module2->id,
      'title' => 'Câu lệnh điều kiện',
      'slug' => 'cau-lenh-dieu-kien',
      'content' => <<<'EOT'
# Câu lệnh điều kiện

Sử dụng `if`, `else`, `elseif` để điều khiển luồng chương trình.

```php
<?php
$diem = 8;

if ($diem >= 9) {
    echo 'Xuất sắc';
} elseif ($diem >= 7) {
    echo 'Khá';
} else {
    echo 'Trung bình';
}
?>
```
EOT,
      'order' => 2,
    ]);
  }
}
