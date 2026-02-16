# Observers & Events: Giữ cho Model của bạn luôn sạch sẽ

Khi ứng dụng phức tạp hơn, các Model thường bị phình to (Fat Models) do chứa quá nhiều logic phụ trợ như xóa file liên quan khi xóa dữ liệu, gửi thông báo, v.v. **Observers** giúp bạn tách biệt các logic này.

---

## 1. Model Events là gì?

Mỗi khi một Model được tạo, cập nhật hay xóa, Laravel đều phát ra các sự kiện ngầm:
- `creating` / `created`
- `updating` / `updated`
- `deleting` / `deleted`

---

## 2. Sử dụng Observers

Observer gom nhóm tất cả các sự kiện của một Model vào một class duy nhất.

```bash
php artisan make:observer UserObserver --model=User
```

```php
class UserObserver
{
    public function created(User $user): void
    {
        // Gửi mail chào mừng ngay khi user vừa tạo xong
        WelcomeNotification::send($user);
    }

    public function deleting(User $user): void
    {
        // Xóa ảnh avatar của user khỏi ổ đĩa trước khi xóa bản ghi
        Storage::delete($user->avatar_path);
    }
}
```

---

## 3. Custom Events & Listeners

Nếu bạn cần thực hiện một chuỗi các hành động phức tạp (ví dụ: `OrderPlaced` -> Giảm kho -> Gửi SMS cho shipper -> Gửi Mail cho khách), hãy dùng Custom Events.

```php
// Phát sự kiện
OrderPlaced::dispatch($order);
```

---

## 🧭 Lời khuyên chuyên nghiệp
- **Đừng giấu logic quá kỹ:** Chỉ đưa vào Observer những logic mang tính chất "phụ trợ" (Side Effects). Đừng đưa Business Logic cốt lõi vào đó vì sẽ rất khó debug và theo dõi dòng chảy của ứng dụng.
- **Queued Listeners:** Luôn cấu hình Listeners để thực thi dưới dạng **ShouldQueue** nếu chúng thực hiện các tác vụ tốn thời gian.
- **Transactions:** Cẩn thận khi dùng sự kiện `created` để thay đổi dữ liệu khác, vì nếu transaction chính bị Rollback, hành động trong sự kiện có thể vẫn đã diễn ra.
