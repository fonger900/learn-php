# Laravel Chuyên Nghiệp: Kiến trúc & Best Practices

Để trở thành một lập trình viên Laravel chuyên nghiệp, bạn không chỉ cần biết cách chạy các lệnh Artisan hay tạo Controller. Bạn cần hiểu về kiến trúc hệ thống và cách viết code sạch, dễ bảo trì (Maintainable Code).

---

## 1. Service Container & Dependency Injection

Đây là "trái tim" của Laravel. Thay vì khởi tạo đối tượng thủ công bằng `new`, Laravel khuyến khích bạn sử dụng **Dependency Injection (DI)**.

### Tại sao nên dùng DI?
- **Dễ kiểm thử (Testing):** Bạn có thể dễ dàng Mock các dependencies.
- **Tính linh hoạt:** Dễ dàng thay đổi các triển khai (implementation) mà không ảnh hưởng đến logic chính.

```php
<?php
namespace App\Http\Controllers;

use App\Services\PaymentService;

class OrderController extends Controller
{
    // Laravel tự động inject PaymentService thông qua Service Container
    public function __construct(
        protected PaymentService $paymentService
    ) {}

    public function store()
    {
        $this->paymentService->process();
    }
}
```

---

## 2. Action Classes: Đưa Logic ra khỏi Controller

Một sai lầm phổ biến là viết quá nhiều logic trong Controller (Fat Controllers). Các lập trình viên chuyên nghiệp thường sử dụng **Action Classes** để xử lý một nghiệp vụ cụ thể.

### Ví dụ về Action Class:
```php
<?php
namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUserAction
{
    public function execute(array $data): User
    {
        // Toàn bộ logic tạo người dùng tập trung tại đây
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
```

---

## 3. Form Requests: Tách biệt Validation

Đừng thực hiện validation trực tiếp trong Controller. Hãy sử dụng **Form Request** để giữ cho Controller luôn sạch sẽ.

```bash
php artisan make:request StoreUserRequest
```

```php
public function store(StoreUserRequest $request, CreateUserAction $createUser)
{
    // Data đã được validate tự động trước khi vào đây
    $createUser->execute($request->validated());

    return redirect()->route('users.index');
}
```

---

## 4. Eloquent Best Practices

- **Mass Assignment:** Luôn khai báo `$fillable` hoặc `$guarded`.
- **N+1 Query:** Luôn sử dụng `with()` (Eager Loading) để tối ưu hóa truy vấn database.
- **Local Scopes:** Định nghĩa các truy vấn thường dùng ngay trong Model.

```php
// Trong Model User.php
public function scopeActive($query)
{
    return $query->where('status', 'active');
}

// Khi sử dụng
$users = User::active()->get();
```

---

## 5. Quy chuẩn viết code (Coding Standards)

Để code chuyên nghiệp và đồng nhất, hãy tuân thủ:
1. **PSR-12:** Quy chuẩn định dạng code PHP.
2. **Sử dụng Type Hints:** Luôn khai báo kiểu dữ liệu cho tham số và giá trị trả về.
3. **Sử dụng Laravel Pint:** Để tự động format code theo chuẩn của Laravel.

---

## 🧭 Lời khuyên từ chuyên gia
- **Viết Test trước (TDD):** Sử dụng **Pest** hoặc PHPUnit để đảm bảo code của bạn luôn chạy đúng.
- **Đừng quá phức tạp hóa (KISS):** Chỉ trừu tượng hóa khi thực sự cần thiết. Code dễ đọc luôn tốt hơn code "thông minh" nhưng khó hiểu.
- **Học về Service Providers:** Hiểu cách đăng ký các dịch vụ vào hệ thống Laravel.

---

## 🎯 Thử thách bài học
1. Hãy tạo một Action Class có tên `UpdateUserPasswordAction`.
2. Tạo một Form Request để validate mật khẩu cũ và mật khẩu mới.
3. Inject Action Class đó vào một Controller và thực hiện đổi mật khẩu.
