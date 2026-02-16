# Interface và Abstract Class trong PHP

Đây là hai khái niệm nâng cao giúp bạn định nghĩa các "bản thiết kế" và "hợp đồng" cho code của mình, giúp hệ thống cực kỳ linh hoạt và dễ thay đổi.

---

## 1. Abstract Class (Lớp trừu tượng)
Một Abstract Class là một lớp không thể khởi tạo trực tiếp (không thể dùng `new`). Nó đóng vai trò là "khung xương" cho các lớp con.

- **Có thể chứa mã lệnh thực tế.**
- **Có thể chứa các phương thức trừu tượng** (phương thức chỉ có tên, không có code bên trong).

```php
<?php
abstract class PaymentProvider {
    // Phương thức chung cho mọi nhà cung cấp
    public function logTransaction($amount) {
        echo "Đã ghi log giao dịch $amount";
    }

    // Buộc lớp con phải tự định nghĩa logic này
    abstract public function processPayment($amount);
}

class Momo extends PaymentProvider {
    public function processPayment($amount) {
        return "Đang thanh toán $amount qua Momo...";
    }
}
```

---

## 2. Interface (Giao diện / Hợp đồng)
Interface **không chứa mã lệnh**, nó chỉ định nghĩa các phương thức mà một lớp **buộc phải có**. Hãy coi nó như một "hợp đồng" cam kết.

- Một class có thể thực thi (`implements`) nhiều Interface cùng lúc.

```php
<?php
interface LoggerInterface {
    public function log(string $message);
}

interface Exportable {
    public function exportToExcel();
}

class OrderService implements LoggerInterface, Exportable {
    public function log(string $message) { /* logic */ }
    public function exportToExcel() { /* logic */ }
}
```

---

## 3. So sánh nhanh

| Đặc điểm | Abstract Class | Interface |
| :--- | :--- | :--- |
| **Kế thừa** | Đơn kế thừa (`extends`) | Đa kế thừa (`implements`) |
| **Mã lệnh** | Có thể chứa code thực tế | Chỉ chứa khai báo phương thức |
| **Mục đích** | Chia sẻ mã nguồn chung giữa các lớp liên quan | Định nghĩa khả năng/hành vi chung cho các lớp khác nhau |

---

## 💡 Khi nào dùng cái nào?
- **Dùng Abstract Class:** Khi các lớp con có chung bản chất (ví dụ: `Circle`, `Square` đều là `Shape`).
- **Dùng Interface:** Khi các lớp khác nhau có chung hành vi (ví dụ: `User`, `Invoice`, `Product` đều có thể `ExportToPDF`).

---

## 🧭 Lời khuyên chuyên nghiệp
Trong các framework như Laravel, **Interface** được ưu tiên hàng đầu. Nó cho phép bạn thay đổi toàn bộ hệ thống (ví dụ: đổi từ gửi mail qua SendGrid sang Mailgun) chỉ bằng cách đổi class thực thi mà không cần sửa code ở nơi gọi.
