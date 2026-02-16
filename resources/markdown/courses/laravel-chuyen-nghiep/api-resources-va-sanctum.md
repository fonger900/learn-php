# Xây dựng API chuẩn mực với API Resources & Sanctum

Trong kiến trúc ứng dụng hiện đại (SPA, Mobile App), việc xây dựng một API sạch sẽ, bảo mật và đồng nhất là kỹ năng cực kỳ quan trọng.

---

## 1. Laravel API Resources: Chuyển đổi dữ liệu

Đừng bao giờ trả về trực tiếp Model từ Controller. **API Resources** đóng vai trò là tầng trung gian (Transformer) giúp bạn định dạng lại JSON đầu ra.

### Tại sao nên dùng?
- **Ẩn các cột nhạy cảm:** (như `password_hash`).
- **Đổi tên cột:** Để Client dễ sử dụng hơn.
- **Thêm các trường phụ:** Tính toán hoặc định dạng lại dữ liệu.

```php
// UserResource.php
public function toArray(Request $request): array
{
    return [
        'id' => $this->id,
        'full_name' => $this->name,
        'email' => $this->email,
        'joined_at' => $this->created_at->diffForHumans(),
        'lessons_completed' => $this->lessons_count ?? 0,
    ];
}
```

---

## 2. API Authentication với Sanctum

**Laravel Sanctum** là giải pháp xác thực API nhẹ nhàng và bảo mật cho SPA (Inertia, Vue, React) hoặc ứng dụng di động.

- **Dùng Cookies (Stateful):** Dành cho Web SPA.
- **Dùng Token (Stateless):** Dành cho Mobile App.

```php
// Tạo token cho Mobile App
$token = $user->createToken('auth_token')->plainTextToken;
```

---

## 3. Quản lý Quyền (Policies & Gates)

Đừng thực hiện kiểm tra quyền bằng `if ($user->id === $post->user_id)` trong Controller. Hãy sử dụng **Policies**.

```php
// PostPolicy.php
public function update(User $user, Post $post): bool
{
    return $user->id === $post->user_id;
}

// Trong Controller
$this->authorize('update', $post);
```

---

## 4. Rate Limiting: Chống spam API

Laravel tích hợp sẵn bộ giới hạn lượt truy cập cực kỳ mạnh mẽ.

```php
// Trong AppServiceProvider hoặc routes/api.php
RateLimiter::for('api', function (Request $request) {
    return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
});
```

---

## 🧭 Lời khuyên thực tế
- **API Versioning:** Luôn bắt đầu API của bạn với `/api/v1/`. Việc này giúp bạn có thể nâng cấp hệ thống mà không làm hỏng ứng dụng cũ của khách hàng.
- **JSON Standard:** Tuân thủ các chuẩn JSON như **JSON:API** nếu có thể.
- **Documentation:** Sử dụng **Scribe** hoặc **Swagger** để tự động tạo tài liệu API từ code của bạn. Lập trình viên Frontend sẽ rất biết ơn bạn vì điều này!
