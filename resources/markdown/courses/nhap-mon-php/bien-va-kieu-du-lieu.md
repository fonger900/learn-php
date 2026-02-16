# Biến và Kiểu Dữ Liệu trong PHP

Biến là các "vùng chứa" dùng để lưu trữ thông tin. Trong PHP, việc quản lý biến rất linh hoạt, nhưng hiểu rõ về kiểu dữ liệu là điều cốt lõi để viết mã hiệu quả và tránh lỗi logic.

---

## 1. Khai báo biến (Variables)

Tất cả các biến trong PHP đều bắt đầu bằng ký hiệu `$`.

```php
<?php
$username = "Hoàng";
$age = 25;
$is_admin = true;
```

### Quy tắc đặt tên biến:
- Phải bắt đầu bằng chữ cái hoặc dấu gạch dưới `_`.
- Không được bắt đầu bằng số.
- Chỉ chứa các ký tự chữ và số (A-z, 0-9) và dấu gạch dưới.
- **Phân biệt chữ hoa chữ thường:** `$myVar` và `$MyVar` là hai biến hoàn toàn khác nhau.

---

## 2. Kiểu dữ liệu (Data Types)

PHP là ngôn ngữ **loosely typed** (kiểu dữ liệu lỏng lẻo), nghĩa là bạn không cần khai báo kiểu của biến trước khi sử dụng. PHP sẽ tự động nhận diện kiểu dựa vào giá trị bạn gán.

### Các kiểu dữ liệu cơ bản (Scalar Types):

| Kiểu dữ liệu | Mô tả | Ví dụ |
| :--- | :--- | :--- |
| **String** | Chuỗi ký tự, bao trong dấu `'` hoặc `"` | `"Học PHP cơ bản"` |
| **Integer** | Số nguyên (không có phần thập phân) | `100, -5` |
| **Float** | Số thực (số có dấu phẩy động) | `3.14, 10.5` |
| **Boolean** | Giá trị logic Đúng hoặc Sai | `true, false` |

### Các kiểu dữ liệu phức hợp (Compound Types):

- **Array (Mảng):** Lưu trữ nhiều giá trị trong một biến duy nhất.
- **Object (Đối tượng):** Một thực thể của một lớp (class).

### Các kiểu đặc biệt:
- **NULL:** Biến không có giá trị (trống).
- **Resource:** Lưu trữ tham chiếu đến các hàm hoặc nguồn bên ngoài (như kết nối database).

---

## 3. Kiểm tra và Ép kiểu

Để biết một biến đang mang kiểu dữ liệu gì, ta dùng hàm `var_dump()` hoặc `gettype()`.

```php
<?php
$score = 9.5;
var_dump($score); // Kết quả: float(9.5)

$age_string = "25";
$age_int = (int) $age_string; // Ép kiểu thủ công sang Integer
```

---

## 4. Hằng số (Constants)

Hằng số là những giá trị **không thể thay đổi** sau khi đã định nghĩa. Thường được dùng cho các cấu hình hệ thống.

```php
<?php
// Cách 1: Dùng define()
define("PI", 3.14);

// Cách 2: Dùng từ khóa const (thường dùng trong class)
const APP_VERSION = "1.0.0";

echo PI; // 3.14
```

---

## 5. Type Hinting (Khai báo kiểu dữ liệu)

Trong PHP hiện đại (7.x, 8.x), chúng ta có thể chỉ định kiểu dữ liệu cho tham số của hàm để mã nguồn minh bạch hơn.

```php
<?php
function calculateTotal(int $price, int $quantity): int {
    return $price * $quantity;
}

echo calculateTotal(1000, 5); // 5000
// echo calculateTotal("abc", 5); // Sẽ báo lỗi vì sai kiểu dữ liệu
```

---

## 🧭 Lời khuyên thực tế
1. **Sử dụng camelCase hoặc snake_case:** Hãy nhất quán trong cách đặt tên (ví dụ: `$userName` hoặc `$user_name`).
2. **Luôn dùng `strict_types`:** Đặt `declare(strict_types=1);` ở đầu file PHP để bắt lỗi kiểu dữ liệu nghiêm ngặt hơn.
3. **Giá trị NULL:** Cẩn thận khi thao tác với biến có thể mang giá trị NULL để tránh lỗi "Call to a member function on null".
