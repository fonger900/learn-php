# Cấu trúc điều kiện trong PHP

Câu lệnh điều kiện cho phép chương trình đưa ra các quyết định dựa trên các tình huống khác nhau. Đây là nền tảng của mọi logic xử lý trong ứng dụng web.

---

## 1. Câu lệnh `if...else` cơ bản

```php
<?php
$age = 20;

if ($age >= 18) {
    echo "Bạn đã đủ tuổi bầu cử.";
} else {
    echo "Bạn chưa đủ tuổi bầu cử.";
}
```

### `if...elseif...else` (Nhiều điều kiện)
```php
<?php
$score = 85;

if ($score >= 90) {
    echo "Xếp loại: Xuất sắc";
} elseif ($score >= 80) {
    echo "Xếp loại: Giỏi";
} elseif ($score >= 65) {
    echo "Xếp loại: Khá";
} else {
    echo "Xếp loại: Trung bình/Yếu";
}
```

---

## 2. Câu lệnh `switch`
Dùng khi bạn muốn so sánh một biến với danh sách các giá trị khác nhau.

```php
<?php
$day = "Thứ Hai";

switch ($day) {
    case "Thứ Hai":
        echo "Bắt đầu tuần mới!";
        break;
    case "Thứ Sáu":
        echo "Sắp đến cuối tuần rồi.";
        break;
    case "Chủ Nhật":
        echo "Ngày nghỉ ngơi.";
        break;
    default:
        echo "Ngày làm việc bình thường.";
}
```
**Lưu ý:** Luôn sử dụng `break` để ngăn mã lệnh "rơi" xuống các case tiếp theo (fall-through).

---

## 3. Biểu thức `match` (PHP 8+)
`match` là phiên bản hiện đại, an toàn và gọn gàng hơn của `switch`.

### Tại sao nên dùng `match`?
- **Trả về giá trị:** Bạn có thể gán kết quả của `match` trực tiếp vào một biến.
- **So sánh nghiêm ngặt (Strict Comparison):** Dùng `===` thay vì `==`.
- **Không cần `break`:** Tự động dừng sau khi tìm thấy case phù hợp.

```php
<?php
$status_code = 404;

$message = match ($status_code) {
    200, 201 => "Thành công",
    400 => "Lỗi yêu cầu",
    404 => "Không tìm thấy trang",
    500 => "Lỗi máy chủ",
    default => "Lỗi không xác định",
};

echo $message; // Không tìm thấy trang
```

---

## 4. Toán tử điều kiện rút gọn

### Toán tử ba ngôi (Ternary Operator)
```php
<?php
$is_logged_in = true;
echo $is_logged_in ? "Chào mừng bạn quay lại!" : "Vui lòng đăng nhập.";
```

### Toán tử Null Coalescing (`??`)
Dùng để kiểm tra xem một biến có tồn tại và không NULL hay không. Rất hữu ích khi làm việc với dữ liệu từ Form hoặc URL.

```php
<?php
$username = $_GET['user'] ?? 'Khách'; 
// Nếu $_GET['user'] không tồn tại, lấy giá trị mặc định là 'Khách'
```

---

## ⚠️ Lưu ý về so sánh
Luôn ưu tiên sử dụng các toán tử so sánh nghiêm ngặt để tránh các lỗi logic khó phát hiện:
- `===` (Bằng cả giá trị và kiểu dữ liệu)
- `!==` (Khác cả giá trị hoặc kiểu dữ liệu)

```php
<?php
var_dump(0 == "0");   // true (Nguy hiểm!)
var_dump(0 === "0");  // false (An toàn hơn)
```
