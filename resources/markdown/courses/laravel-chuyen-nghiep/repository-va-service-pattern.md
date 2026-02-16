# Repository & Service Pattern: Tổ chức Code linh hoạt

Trong các dự án Laravel lớn, việc đưa mọi thứ vào Model hay Action đôi khi chưa đủ. **Repository & Service Pattern** giúp tách biệt hoàn toàn logic truy vấn dữ liệu và logic nghiệp vụ (Business Logic).

---

## 1. Tại sao cần tách biệt?

- **Controller**: Chỉ điều hướng (nhận input, gọi service, trả kết quả).
- **Service**: Chứa logic nghiệp vụ (tính toán, gửi mail, gọi API bên thứ ba).
- **Repository**: Chứa logic truy vấn Database (where, order by, paginate).

---

## 2. Repository Pattern

Giúp bạn trừu tượng hóa tầng dữ liệu. Nếu một ngày bạn muốn đổi từ Eloquent sang gọi qua một API khác, bạn chỉ cần sửa Repository mà không cần động vào logic nghiệp vụ.

```php
interface UserRepositoryInterface {
    public function getActiveUsers();
}

class EloquentUserRepository implements UserRepositoryInterface {
    public function getActiveUsers() {
        return User::where('active', true)->get();
    }
}
```

---

## 3. Service Pattern

Nơi tập trung các quy tắc nghiệp vụ. Một Service có thể gọi nhiều Repository để hoàn thành một công việc.

```php
class RegistrationService {
    public function __construct(
        protected UserRepositoryInterface $userRepo,
        protected MailService $mailService
    ) {}

    public function register(array $data) {
        $user = $this->userRepo->create($data);
        $this->mailService->sendWelcomeEmail($user);
        return $user;
    }
}
```

---

## 4. Ưu và nhược điểm

| Đặc điểm | Lợi ích |
| :--- | :--- |
| **Dễ Test** | Bạn có thể Mock Repository để test Service mà không cần Database thật. |
| **Tái sử dụng** | Một hàm truy vấn trong Repo có thể được dùng ở nhiều Service/Command khác nhau. |
| **Code sạch** | Controller của bạn sẽ cực kỳ mỏng (Skinny Controllers). |

**⚠️ Lưu ý:** Đối với các dự án nhỏ hoặc trung bình, việc áp dụng quá nhiều Repository có thể gây ra hiện tượng "Over-engineering" (làm phức tạp hóa vấn đề). Hãy cân nhắc sử dụng **Action Classes** nếu thấy Repository quá cồng kềnh.

---

## 🧭 Lời khuyên thực tế
- Đừng tạo Repository cho những truy vấn quá đơn giản như `User::find($id)`.
- Luôn sử dụng **Interface** cho Repository để tận dụng tối đa sức mạnh của Dependency Injection.
- Sử dụng **DTO (Data Transfer Objects)** để truyền dữ liệu giữa các tầng thay vì truyền array thuần túy.
