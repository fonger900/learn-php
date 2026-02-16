# Namespaces và Autoloading trong PHP

Khi ứng dụng của bạn lớn dần, việc có hàng trăm class sẽ dẫn đến xung đột tên gọi (ví dụ: hai thư viện khác nhau cùng có class `User`). **Namespaces** sinh ra để giải quyết vấn đề này, đóng vai trò như các "thư mục ảo" cho code của bạn.

---

## 1. Namespace là gì?
Hãy tưởng tượng Namespace giống như họ của một người. Có nhiều người tên "An", nhưng "Nguyễn An" và "Trần An" là hai người khác nhau.

```php
<?php
namespace App\Models;

class User {
    public function getName() {
        return "Đây là class User trong thư mục Models";
    }
}
```

---

## 2. Cách sử dụng Class có Namespace

Để sử dụng một class nằm trong namespace khác, bạn có 3 cách:

### Cách 1: Dùng tên đầy đủ (Fully Qualified Name)
```php
$user = new \App\Models\User();
```

### Cách 2: Dùng từ khóa `use` (Khuyên dùng)
```php
<?php
use App\Models\User;

$user = new User();
```

### Cách 3: Đổi tên với `as` (Tránh xung đột)
```php
use App\Models\User as UserModel;
use App\Services\User as UserService;

$user = new UserModel();
```

---

## 3. Autoloading (Tự động tải lớp)

Trước đây, chúng ta phải dùng hàng chục lệnh `include` hoặc `require` ở đầu file. PHP hiện đại sử dụng **Autoloading** để tự động tìm và nạp file khi class được gọi đến.

### Tiêu chuẩn PSR-4
Đây là tiêu chuẩn vàng trong cộng đồng PHP (được Laravel sử dụng). Nó quy định cấu trúc thư mục phải khớp với Namespace.
- Namespace `App\Models\User` tương ứng với file `app/Models/User.php`.

---

## 4. Kết hợp với Composer
Thay vì tự viết hàm autoload, chúng ta dùng Composer để quản lý. Bạn chỉ cần khai báo trong `composer.json`:

```json
{
    "autoload": {
        "psr-4": {
            "App\\": "app/"
        }
    }
}
```

Sau đó chạy `composer dump-autoload`. Từ nay, mọi class trong thư mục `app/` sẽ được tự động nhận diện.

---

## 🧭 Lời khuyên thực tế
1. **Một file - Một Class:** Luôn giữ cấu trúc 1 file PHP chỉ chứa 1 class duy nhất.
2. **Tuân thủ PSR-4:** Luôn đặt tên namespace trùng với đường dẫn thư mục để code dễ tìm kiếm và bảo trì.
3. **Namespace gốc:** Thường dùng `App` cho logic chính của ứng dụng.
