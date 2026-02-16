# Queues & Jobs: Xử lý các tác vụ nặng chạy ngầm

Nếu bạn gửi một email chào mừng ngay trong Controller, người dùng sẽ phải chờ 2-3 giây. Với **Queues**, bạn có thể đẩy tác vụ đó vào một hàng đợi và trả về kết quả cho người dùng ngay lập tức.

---

## 1. Khi nào nên dùng Queues?

- **Gửi Email / SMS**: Luôn luôn nên chạy ngầm.
- **Xử lý ảnh/video**: Thay đổi kích thước, nén dữ liệu.
- **Tương tác với API bên thứ ba**: Tránh việc API bên kia chậm làm chậm ứng dụng của bạn.
- **Báo cáo phức tạp**: Xuất file Excel/PDF lớn.

---

## 2. Cấu trúc của một Job

```bash
php artisan make:job SendWelcomeEmail
```

```php
class SendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected User $user) {}

    public function handle(): void
    {
        // Logic gửi mail thực tế nằm ở đây
        Mail::to($this->user)->send(new WelcomeMail($this->user));
    }
}
```

---

## 3. Cách gọi Job

```php
public function store(Request $request)
{
    $user = User::create(...);

    // Đẩy vào hàng đợi
    SendWelcomeEmail::dispatch($user);

    // Hoặc trì hoãn xử lý sau 10 phút
    SendWelcomeEmail::dispatch($user)->delay(now()->addMinutes(10));

    return back()->with('status', 'Đang xử lý đăng ký...');
}
```

---

## 4. Quản lý Worker

Worker là các tiến trình chạy ngầm để "tiêu thụ" các Job trong hàng đợi.

```bash
# Lệnh khởi động worker
php artisan queue:work

# Trong môi trường sản xuất (Production), thường dùng Supervisor để duy trì lệnh này
```

---

## 5. Xử lý lỗi (Failed Jobs)

Nếu một Job bị lỗi (ví dụ API bên thứ ba chết), Laravel sẽ tự động thử lại (retry) theo cấu hình của bạn. Nếu vẫn thất bại, nó sẽ được đưa vào bảng `failed_jobs`.

```bash
php artisan queue:failed      # Xem danh sách job lỗi
php artisan queue:retry all   # Thử lại tất cả job lỗi
```

---

## 🧭 Lời khuyên chuyên nghiệp
- **Sử dụng Redis:** Redis là driver hàng đầu cho Queue vì tốc độ truy xuất cực nhanh.
- **Horizon:** Nếu dùng Redis, hãy cài đặt **Laravel Horizon**. Nó cung cấp một Dashboard cực đẹp để theo dõi trực quan các Job đang chạy, bị lỗi hoặc chờ xử lý.
- **Idempotency:** Đảm bảo một Job nếu chạy lại nhiều lần (do retry) cũng không gây ra dữ liệu sai (ví dụ: không trừ tiền người dùng 2 lần).
