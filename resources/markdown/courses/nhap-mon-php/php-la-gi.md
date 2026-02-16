# Giới thiệu về PHP (PHP là gì?)

PHP (viết tắt của **Hypertext Preprocessor**) là một ngôn ngữ lập trình kịch bản mã nguồn mở, được thiết kế chuyên biệt cho việc phát triển web. PHP chạy trên **phía máy chủ (Server-side)**, có nghĩa là toàn bộ mã lệnh được xử lý trên server trước khi kết quả được trả về trình duyệt của người dùng dưới dạng HTML.

---

## 🚀 Lịch sử và Sự phát triển

- **1994:** Rasmus Lerdorf tạo ra PHP như một bộ công cụ CGI đơn giản để theo dõi lượt truy cập trang cá nhân.
- **Hiện tại:** PHP đã trải qua nhiều phiên bản đột phá (PHP 5, PHP 7, và hiện tại là **PHP 8.x**).
- **PHP 8.x:** Mang lại những cải tiến vượt bậc về hiệu năng (JIT Compiler), cú pháp hiện đại (Named Arguments, Attributes, Constructor Promotion) và hệ thống kiểu dữ liệu (Type System) mạnh mẽ.

---

## 🛠️ PHP hoạt động như thế nào?

Khác với JavaScript (thường chạy trên trình duyệt người dùng), PHP chạy trên máy chủ. Quy trình diễn ra như sau:

1. **Client (Trình duyệt):** Người dùng gửi yêu cầu truy cập một trang web (ví dụ: `index.php`).
2. **Server (Máy chủ):** Nhận yêu cầu và chuyển file cho trình thông dịch PHP xử lý.
3. **PHP Interpreter:** Đọc mã PHP, thực hiện các logic (truy vấn database, tính toán...) và tạo ra nội dung HTML.
4. **Server:** Gửi kết quả HTML thuần túy về trình duyệt.
5. **Client:** Trình duyệt hiển thị trang web mà không hề biết code PHP bên trong là gì.

---

## 🌟 Tại sao PHP vẫn là "Vua" của Web?

Dù có nhiều ngôn ngữ mới xuất hiện, PHP vẫn thống trị web (chiếm khoảng 77% website trên toàn cầu) nhờ:

| Đặc điểm | Chi tiết |
| :--- | :--- |
| **Dễ học** | Cú pháp gần gũi với C và Java, tài liệu tiếng Việt và quốc tế cực kỳ phong phú. |
| **Hệ sinh thái khổng lồ** | Sở hữu các CMS hàng đầu thế giới như **WordPress**, Drupal, Joomla. |
| **Framework mạnh mẽ** | **Laravel** - Framework PHP phổ biến nhất hiện nay, giúp xây dựng ứng dụng chuyên nghiệp, bảo mật. |
| **Hiệu năng cao** | Từ phiên bản 7.0 trở đi, PHP đã cải thiện tốc độ gấp 2-3 lần so với phiên bản cũ. |
| **Cộng đồng lớn** | Bất kỳ lỗi nào bạn gặp phải đều có thể tìm thấy lời giải trên StackOverflow hoặc các hội nhóm PHP. |

---

## 💻 Mã nguồn PHP đầu tiên

Mã PHP luôn được bao bọc bởi thẻ `<?php ... ?>`.

```php
<?php
// Định nghĩa một biến
$language = "PHP";

// Xuất dữ liệu ra màn hình
echo "<h1>Chào mừng bạn đến với thế giới $language!</h1>";
echo "<p>Phiên bản PHP hiện tại: " . PHP_VERSION . "</p>";
?>
```

### Lưu ý quan trọng:
- Tập tin PHP phải có phần mở rộng là `.php`.
- File PHP có thể chứa cả HTML, CSS, JavaScript xen kẽ với mã PHP.
- Mỗi câu lệnh PHP phải kết thúc bằng dấu chấm phẩy (`;`).

---

## 🎯 Tổng kết bài học
Sau bài này, bạn cần nắm vững:
1. PHP là ngôn ngữ chạy phía **Server**.
2. Kết quả cuối cùng trả về trình duyệt luôn là **HTML/CSS/JS**.
3. PHP là nền tảng của các công nghệ lớn như Facebook, Wikipedia và hàng triệu website WordPress.
