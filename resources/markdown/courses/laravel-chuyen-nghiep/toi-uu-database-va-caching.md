# Tối ưu Database & Caching: Sẵn sàng cho Scale lớn

Một ứng dụng chạy nhanh trên máy cá nhân chưa chắc đã chạy tốt khi có 10.000 người truy cập cùng lúc. Bài học này tập trung vào các kỹ thuật tối ưu hóa cốt lõi.

---

## 1. Giải quyết bài toán N+1 Query

Đây là nguyên nhân số 1 làm chậm ứng dụng Laravel.

### Vấn đề:
```php
$books = Book::all(); // 1 query
foreach ($books as $book) {
    echo $book->author->name; // N query để lấy author
}
```

### Giải pháp (Eager Loading):
```php
$books = Book::with('author')->get(); // Chỉ 2 query duy nhất
```

---

## 2. Sử dụng Index hiệu quả

Index giúp database tìm kiếm dữ liệu nhanh hơn hàng nghìn lần. Hãy thêm index cho các cột thường xuyên nằm trong điều kiện `WHERE` hoặc `ORDER BY`.

```php
Schema::table('users', function (Blueprint $table) {
    $table->index('email');
    $table->index(['status', 'created_at']); // Composite Index
});
```

---

## 3. Caching: Đừng tính toán lại những gì đã biết

Laravel hỗ trợ caching rất mạnh với Redis hoặc Memcached.

### Cache dữ liệu Database:
```php
$stats = Cache::remember('site_stats', 3600, function () {
    return Order::calculateYearlyStats();
});
```

### Cache toàn bộ kết quả trả về từ Controller:
Phù hợp với các trang ít thay đổi nội dung nhưng có lượt truy cập cao.

---

## 4. Tối ưu hóa Eloquent

- **Chỉ lấy những gì cần thiết:** Dùng `select('id', 'name')` thay vì lấy tất cả cột.
- **Sử dụng `exists()`:** Để kiểm tra sự tồn tại thay vì `count() > 0`.
- **Chunking:** Khi xử lý hàng triệu bản ghi, hãy dùng `chunk()` để không bị tràn bộ nhớ.

```php
User::chunk(100, function ($users) {
    foreach ($users as $user) {
        // Xử lý từng nhóm 100 user
    }
});
```

---

## 🧭 Lời khuyên thực tế
- **Redis:** Luôn sử dụng Redis cho dự án thực tế thay vì file cache.
- **Telescope:** Sử dụng Laravel Telescope để theo dõi các câu lệnh SQL đang chạy chậm.
- **Database Transactions:** Luôn sử dụng transactions khi thực hiện nhiều lệnh ghi dữ liệu liên quan đến nhau để đảm bảo tính toàn vẹn dữ liệu.

---

## 🎯 Thử thách
1. Cài đặt Laravel Debugbar hoặc Telescope.
2. Tìm một trang trong ứng dụng của bạn có lỗi N+1 và sửa nó bằng `with()`.
3. Áp dụng `Cache::remember` cho danh sách khóa học trên trang chủ.
