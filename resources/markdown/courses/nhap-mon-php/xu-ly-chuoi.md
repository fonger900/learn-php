# Xử lý Chuỗi trong PHP (Strings)

Chuỗi là một dãy các ký tự. Trong phát triển web, việc xử lý chuỗi (như tên người dùng, nội dung bài viết, email) chiếm phần lớn thời gian lập trình.

---

## 1. Khai báo chuỗi: Nháy đơn vs Nháy kép

### Dấu nháy đơn (`'`)
- Hiển thị chính xác những gì bạn viết.
- **Không** phân tích biến bên trong.
- Nhanh hơn một chút về hiệu năng.

```php
<?php
$name = "Hoàng";
echo 'Chào $name'; // Kết quả: Chào $name
```

### Dấu nháy kép (`"`)
- **Có** phân tích biến bên trong (Variable Interpolation).
- Hỗ trợ các ký tự đặc biệt như `\n` (xuống dòng), `\t` (tab).

```php
<?php
$name = "Hoàng";
echo "Chào $name"; // Kết quả: Chào Hoàng
```

---

## 2. Các hàm xử lý chuỗi phổ biến

| Hàm | Công dụng | Ví dụ |
| :--- | :--- | :--- |
| **strlen()** | Độ dài chuỗi (byte) | `strlen("ABC")` -> 3 |
| **str_word_count()** | Đếm số từ | `str_word_count("Học PHP")` -> 3 |
| **strrev()** | Đảo ngược chuỗi | `strrev("PHP")` -> "PHP" |
| **strpos()** | Tìm vị trí chuỗi con | `strpos("Hello world", "world")` -> 6 |
| **str_replace()** | Thay thế chuỗi | `str_replace("Web", "PHP", "Học Web")` -> "Học PHP" |
| **strtolower()** | Chuyển thành chữ thường | `strtolower("PHP")` -> "php" |
| **strtoupper()** | Chuyển thành chữ hoa | `strtoupper("php")` -> "PHP" |

---

## 3. Cắt và Nối chuỗi

### Nối chuỗi (Dùng dấu chấm `.`)
```php
<?php
$firstName = "Nguyễn";
$lastName = "Hoàng";
echo $firstName . " " . $lastName; // Nguyễn Hoàng
```

### Cắt chuỗi (`substr`)
```php
<?php
$str = "Hello World";
echo substr($str, 0, 5); // Hello (Lấy 5 ký tự từ vị trí 0)
```

---

## 4. Xử lý tiếng Việt (Multibyte Strings)
Vì tiếng Việt là ký tự đa byte (Unicode), các hàm `strlen` hoặc `substr` có thể trả về kết quả sai. Hãy luôn dùng các hàm có tiền tố **`mb_`**.

```php
<?php
$str = "Học lập trình";
echo strlen($str);    // 17 (Sai vì đếm byte)
echo mb_strlen($str); // 13 (Đúng số ký tự)
```

---

## 💡 Mẹo thực tế
1. **Làm sạch dữ liệu:** Luôn dùng `trim($input)` để xóa khoảng trắng thừa ở hai đầu chuỗi khi nhận dữ liệu từ người dùng.
2. **Bảo mật:** Khi hiển thị chuỗi từ người dùng ra HTML, hãy dùng `htmlspecialchars($str)` để tránh tấn công XSS.
