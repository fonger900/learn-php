# Xử lý lỗi và Ngoại lệ (Exception Handling)

Trong quá trình chạy chương trình, các lỗi ngoài ý muốn có thể xảy ra (như mất kết nối database, file không tồn tại). Thay vì để chương trình "chết" đột ngột, chúng ta sử dụng `try...catch` để xử lý chúng một cách chuyên nghiệp.

---

## 1. Cấu trúc `try...catch`

- **try**: Chứa khối mã có khả năng gây ra lỗi.
- **catch**: Thực thi nếu có lỗi (Exception) xảy ra trong khối try.
- **finally**: (Tùy chọn) Luôn luôn thực thi dù có lỗi hay không. Thường dùng để đóng kết nối hoặc giải phóng tài nguyên.

```php
<?php
try {
    $result = 10 / 0; // Gây ra lỗi
} catch (DivisionByZeroError $e) {
    echo "Lỗi: Không thể chia cho số 0.";
} catch (Exception $e) {
    echo "Có lỗi xảy ra: " . $e->getMessage();
} finally {
    echo "Kết thúc quá trình xử lý.";
}
```

---

## 2. Tự ném lỗi với `throw`

Bạn có thể chủ động dừng chương trình và báo lỗi nếu một điều kiện không được thỏa mãn.

```php
<?php
function checkAge($age) {
    if ($age < 18) {
        throw new Exception("Bạn chưa đủ tuổi truy cập.");
    }
    return true;
}

try {
    checkAge(15);
} catch (Exception $e) {
    echo "Thông báo: " . $e->getMessage();
}
```

---

## 3. Các loại Exception phổ biến trong PHP

| Ngoại lệ | Khi nào xảy ra? |
| :--- | :--- |
| **PDOException** | Lỗi khi làm việc với Database. |
| **TypeError** | Sai kiểu dữ liệu truyền vào hàm (khi dùng strict_types). |
| **DivisionByZeroError** | Chia cho số 0. |
| **ParseError** | Lỗi cú pháp khi dùng hàm `eval()`. |

---

## 4. Custom Exception (Ngoại lệ tự định nghĩa)

Bạn có thể tạo ra các loại lỗi riêng cho ứng dụng của mình bằng cách kế thừa lớp `Exception`.

```php
<?php
class InvalidEmailException extends Exception {}

function subscribe($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new InvalidEmailException("Email không đúng định dạng.");
    }
}
```

---

## 🧭 Lời khuyên thực tế
1. **Đừng lạm dụng catch Exception:** Hãy cố gắng catch các loại lỗi cụ thể (như `PDOException`) thay vì catch lớp `Exception` chung chung để xử lý chính xác hơn.
2. **Ghi log lỗi:** Trong thực tế, thay vì chỉ `echo` lỗi ra màn hình, bạn nên ghi lỗi vào file log để lập trình viên có thể kiểm tra sau này.
3. **Đừng bao giờ hiện mã lỗi cho người dùng cuối:** Chỉ hiện thông báo thân thiện như "Đã có lỗi xảy ra, vui lòng thử lại sau" để đảm bảo bảo mật.
