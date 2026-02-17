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
        $this->seedPhpCourse();
        $this->seedLaravelProCourse();
    }

    private function seedPhpCourse(): void
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

        $this->seedModulesAndLessons($course, $modules);
    }

    private function seedLaravelProCourse(): void
    {
        $course = Course::create([
            'title' => 'Laravel Chuyên Nghiệp',
            'slug' => 'laravel-chuyen-nghiep',
            'description' => 'Nâng tầm kỹ năng Laravel với các kiến thức về kiến trúc hệ thống, Design Patterns, Testing, Performance, Security và quy trình phát triển phần mềm chuyên nghiệp.',
            'level' => 'advanced',
        ]);

        $modules = [
            'Kiến trúc & Design Patterns' => [
                ['Kiến trúc Laravel & Best Practices', 'kien-truc-laravel-best-practices'],
                ['Service Container & Dependency Injection', 'service-container-dependency-injection'],
                ['Service Providers & Bootstrapping', 'service-providers-bootstrapping'],
                ['Repository Pattern', 'repository-pattern'],
                ['Service Layer Pattern', 'service-layer-pattern'],
                ['Action Pattern & Single Responsibility', 'action-pattern-single-responsibility'],
                ['Strategy Pattern trong Laravel', 'strategy-pattern-laravel'],
                ['Factory & Builder Pattern', 'factory-builder-pattern'],
            ],
            'Advanced Eloquent ORM' => [
                ['Query Optimization & N+1 Problem', 'query-optimization-n-plus-1'],
                ['Advanced Relationships', 'advanced-relationships'],
                ['Polymorphic Relationships', 'polymorphic-relationships'],
                ['Eloquent Scopes & Query Builders', 'eloquent-scopes-query-builders'],
                ['Model Events & Observers', 'model-events-observers'],
                ['Custom Collections', 'custom-collections'],
                ['Database Transactions', 'database-transactions'],
                ['Soft Deletes & Pruning', 'soft-deletes-pruning'],
            ],
            'Testing với Pest & PHPUnit' => [
                ['Testing Fundamentals', 'testing-fundamentals'],
                ['Unit Testing với Pest', 'unit-testing-pest'],
                ['Feature Testing', 'feature-testing'],
                ['Database Testing & Factories', 'database-testing-factories'],
                ['HTTP Testing & API Testing', 'http-testing-api-testing'],
                ['Mocking & Faking', 'mocking-faking'],
                ['Test-Driven Development (TDD)', 'test-driven-development'],
                ['Browser Testing với Dusk', 'browser-testing-dusk'],
            ],
            'API Development' => [
                ['RESTful API Design', 'restful-api-design'],
                ['API Resources & Transformers', 'api-resources-transformers'],
                ['API Versioning', 'api-versioning'],
                ['Authentication với Sanctum', 'authentication-sanctum'],
                ['API Rate Limiting', 'api-rate-limiting'],
                ['API Documentation', 'api-documentation'],
                ['GraphQL với Lighthouse', 'graphql-lighthouse'],
                ['Webhooks & Event-Driven APIs', 'webhooks-event-driven-apis'],
            ],
            'Authentication & Authorization' => [
                ['Laravel Fortify Deep Dive', 'laravel-fortify-deep-dive'],
                ['Two-Factor Authentication', 'two-factor-authentication'],
                ['Gates & Policies', 'gates-policies'],
                ['Role-Based Access Control (RBAC)', 'role-based-access-control'],
                ['Permission Systems', 'permission-systems'],
                ['OAuth2 & Social Login', 'oauth2-social-login'],
                ['JWT Authentication', 'jwt-authentication'],
            ],
            'Queues & Background Jobs' => [
                ['Queue Fundamentals', 'queue-fundamentals'],
                ['Job Chains & Batches', 'job-chains-batches'],
                ['Failed Jobs & Retry Logic', 'failed-jobs-retry-logic'],
                ['Queue Workers & Horizon', 'queue-workers-horizon'],
                ['Job Middleware', 'job-middleware'],
                ['Rate Limiting Jobs', 'rate-limiting-jobs'],
                ['Scheduled Tasks & Cron', 'scheduled-tasks-cron'],
            ],
            'Caching & Performance' => [
                ['Cache Strategies', 'cache-strategies'],
                ['Redis & Memcached', 'redis-memcached'],
                ['Query Caching', 'query-caching'],
                ['Response Caching', 'response-caching'],
                ['Cache Tags & Invalidation', 'cache-tags-invalidation'],
                ['Database Optimization', 'database-optimization'],
                ['Eager Loading Strategies', 'eager-loading-strategies'],
                ['Performance Monitoring', 'performance-monitoring'],
            ],
            'Real-time Applications' => [
                ['Broadcasting Fundamentals', 'broadcasting-fundamentals'],
                ['Laravel Reverb Setup', 'laravel-reverb-setup'],
                ['Private & Presence Channels', 'private-presence-channels'],
                ['Real-time Notifications', 'realtime-notifications'],
                ['WebSocket Authentication', 'websocket-authentication'],
                ['Broadcasting Events', 'broadcasting-events'],
                ['Echo & Client-Side Integration', 'echo-client-side-integration'],
            ],
            'Events & Listeners' => [
                ['Event-Driven Architecture', 'event-driven-architecture'],
                ['Creating Events & Listeners', 'creating-events-listeners'],
                ['Event Discovery', 'event-discovery'],
                ['Queued Event Listeners', 'queued-event-listeners'],
                ['Event Subscribers', 'event-subscribers'],
                ['Domain Events', 'domain-events'],
            ],
            'File Storage & Media' => [
                ['Filesystem Abstraction', 'filesystem-abstraction'],
                ['S3 & Cloud Storage', 's3-cloud-storage'],
                ['File Uploads & Validation', 'file-uploads-validation'],
                ['Image Processing', 'image-processing'],
                ['Streaming & Large Files', 'streaming-large-files'],
                ['CDN Integration', 'cdn-integration'],
            ],
            'Email & Notifications' => [
                ['Mail System Deep Dive', 'mail-system-deep-dive'],
                ['Markdown Mailables', 'markdown-mailables'],
                ['Queued Emails', 'queued-emails'],
                ['Multi-Channel Notifications', 'multi-channel-notifications'],
                ['Custom Notification Channels', 'custom-notification-channels'],
                ['Email Testing', 'email-testing'],
            ],
            'Security Best Practices' => [
                ['CSRF Protection', 'csrf-protection'],
                ['XSS Prevention', 'xss-prevention'],
                ['SQL Injection Prevention', 'sql-injection-prevention'],
                ['Authentication Security', 'authentication-security'],
                ['Encryption & Hashing', 'encryption-hashing'],
                ['Rate Limiting & Throttling', 'rate-limiting-throttling'],
                ['Security Headers', 'security-headers'],
                ['Vulnerability Scanning', 'vulnerability-scanning'],
            ],
            'Package Development' => [
                ['Package Structure', 'package-structure'],
                ['Service Provider Creation', 'service-provider-creation'],
                ['Facades & Helpers', 'facades-helpers'],
                ['Config & Migrations', 'config-migrations'],
                ['Testing Packages', 'testing-packages'],
                ['Publishing Assets', 'publishing-assets'],
                ['Package Discovery', 'package-discovery'],
            ],
            'Deployment & DevOps' => [
                ['Environment Configuration', 'environment-configuration'],
                ['Laravel Forge', 'laravel-forge'],
                ['Laravel Vapor (Serverless)', 'laravel-vapor-serverless'],
                ['Docker & Containerization', 'docker-containerization'],
                ['CI/CD Pipelines', 'ci-cd-pipelines'],
                ['Zero-Downtime Deployment', 'zero-downtime-deployment'],
                ['Monitoring & Logging', 'monitoring-logging'],
                ['Error Tracking với Sentry', 'error-tracking-sentry'],
            ],
            'Advanced Topics' => [
                ['Custom Artisan Commands', 'custom-artisan-commands'],
                ['Middleware Deep Dive', 'middleware-deep-dive'],
                ['Request Lifecycle', 'request-lifecycle'],
                ['Macros & Extensions', 'macros-extensions'],
                ['Custom Validation Rules', 'custom-validation-rules'],
                ['Localization & Internationalization', 'localization-internationalization'],
                ['Multi-Tenancy', 'multi-tenancy'],
                ['Microservices Architecture', 'microservices-architecture'],
            ],
        ];

        $this->seedModulesAndLessons($course, $modules);
    }

    private function seedModulesAndLessons(Course $course, array $modules): void
    {
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
                    'content' => '', // Content loaded via accessor in Model
                    'order' => $index + 1,
                ]);
            }
        }
    }
}
