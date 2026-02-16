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

        $modules = [
            'Giới thiệu về PHP' => [
                ['PHP là gì?', 'php-la-gi'],
                ['Cài đặt môi trường', 'cai-dat-moi-truong'],
                ['Chương trình đầu tiên', 'chuong-trinh-dau-tien'],
            ],
            'Cú pháp cơ bản' => [
                ['Biến và các kiểu dữ liệu', 'bien-va-kieu-du-lieu'],
                ['Toán tử', 'toan-tu'],
                ['Ép kiểu và Juggling', 'ep-kieu-va-juggling'],
            ],
            'Cấu trúc điều khiển' => [
                ['Câu lệnh điều kiện', 'cau-lenh-dieu-kien'],
                ['Vòng lặp', 'vong-lap'],
                ['Match expression và Enum', 'match-expression-va-enum'],
            ],
            'Chuỗi (Strings)' => [
                ['Xử lý chuỗi', 'xu-ly-chuoi'],
                ['Hàm chuỗi nâng cao', 'ham-chuoi-nang-cao'],
                ['Bài tập chuỗi', 'bai-tap-chuoi'],
            ],
            'Mảng (Arrays)' => [
                ['Mảng cơ bản', 'mang-co-ban'],
                ['Các hàm mảng', 'cac-ham-mang'],
                ['Array destructuring', 'array-destructuring'],
            ],
            'Hàm (Functions)' => [
                ['Khai báo hàm', 'khai-bao-ham'],
                ['Hàm ẩn danh và Arrow Functions', 'ham-an-danh-va-arrow'],
                ['Phạm vi biến và Recursion', 'pham-vi-bien-va-recursion'],
            ],
            'Xử lý File' => [
                ['Đọc và ghi file', 'doc-va-ghi-file'],
                ['Làm việc với CSV và JSON', 'csv-va-json'],
                ['Upload file', 'upload-file'],
            ],
            'Lập trình hướng đối tượng (OOP)' => [
                ['Class và Object', 'class-va-object'],
                ['Kế thừa và Polymorphism', 'ke-thua-va-polymorphism'],
                ['Interface và Abstract Class', 'interface-va-abstract-class'],
            ],
            'OOP nâng cao' => [
                ['Traits', 'traits'],
                ['Magic Methods', 'magic-methods'],
                ['Static và Design Patterns', 'static-va-design-patterns'],
            ],
            'Xử lý lỗi & Exception' => [
                ['Try, Catch, Finally', 'try-catch-finally'],
                ['Custom Exception', 'custom-exception'],
                ['Logging và Debug', 'logging-va-debug'],
            ],
            'Làm việc với Database' => [
                ['PDO cơ bản', 'pdo-co-ban'],
                ['CRUD với PDO', 'crud-voi-pdo'],
                ['Bảo mật Database', 'bao-mat-database'],
            ],
            'PHP hiện đại' => [
                ['Namespaces và Autoloading', 'namespaces-va-autoloading'],
                ['Composer - Quản lý dependencies', 'composer-quan-ly-dependencies'],
                ['PHP 8.x - Tính năng mới', 'php-8x-tinh-nang-moi'],
            ],
        ];

        $moduleOrder = 1;
        foreach ($modules as $moduleTitle => $lessons) {
            $module = Module::create([
                'course_id' => $course->id,
                'title' => $moduleTitle,
                'order' => $moduleOrder++,
            ]);

            foreach ($lessons as $index => [$title, $slug]) {
                Lesson::create([
                    'module_id' => $module->id,
                    'title' => $title,
                    'slug' => $slug,
                    'content' => '', // Loaded from markdown files via Lesson model accessor
                    'order' => $index + 1,
                ]);
            }
        }
    }
}
