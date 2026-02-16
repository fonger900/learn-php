# Lập trình hướng đối tượng: Class và Object

Lập trình hướng đối tượng (OOP) là một mô hình lập trình dựa trên khái niệm "đối tượng", giúp mã nguồn dễ bảo trì, tái sử dụng và mở rộng hơn.

---

## 1. Lớp (Class) là gì?
Hãy tưởng tượng **Class** là một "bản thiết kế" (blueprint) cho một ngôi nhà. Nó định nghĩa các đặc tính (như số cửa, màu sơn) và hành động (như mở cửa, bật đèn).

```php
<?php
class Car {
    // Thuộc tính (Properties)
    public $brand;
    public $color;

    // Phương thức (Methods)
    public function startEngine() {
        return "Động cơ của xe $this->brand đã khởi động!";
    }
}
```

---

## 2. Đối tượng (Object) là gì?
**Object** là một thực thể cụ thể được xây dựng dựa trên bản thiết kế (Class). Bạn có thể tạo ra nhiều chiếc xe khác nhau từ một bản thiết kế Car.

```php
<?php
// Khởi tạo đối tượng dùng từ khóa new
$myCar = new Car();
$myCar->brand = "Toyota";
$myCar->color = "Đỏ";

echo $myCar->startEngine(); // "Động cơ của xe Toyota đã khởi động!"
```

---

## 3. Hàm khởi tạo (`__construct`)
Đây là một "phương thức ma thuật" (magic method) tự động chạy khi một đối tượng được tạo ra. Thường dùng để gán giá trị ban đầu.

```php
<?php
class User {
    public $name;

    public function __construct($name) {
        $this->name = $name;
    }
}

$user = new User("Hoàng");
echo $user->name; // Hoàng
```

---

## 4. Phạm vi truy cập (Access Modifiers)
PHP cung cấp 3 từ khóa để kiểm soát quyền truy cập vào thuộc tính và phương thức:

| Từ khóa | Mô tả |
| :--- | :--- |
| **public** | Có thể truy cập từ bất cứ đâu (trong class, class con, hoặc bên ngoài). |
| **protected** | Chỉ có thể truy cập trong Class đó và các Class kế thừa nó. |
| **private** | Chỉ có thể truy cập DUY NHẤT bên trong Class định nghĩa nó. |

---

## 5. Constructor Promotion (PHP 8+)
Trong PHP hiện đại, bạn có thể khai báo thuộc tính ngay trong hàm khởi tạo để code gọn gàng hơn.

```php
<?php
class Product {
    // PHP sẽ tự động tạo thuộc tính name và price cho bạn
    public function __construct(
        public string $name,
        public float $price,
        private int $stock = 0
    ) {}
}

$p = new Product("Laptop", 1500.0);
echo $p->name; // Laptop
```

---

## 🗝️ Các khái niệm then chốt
1. **$this:** Dùng để tham chiếu đến đối tượng hiện tại bên trong class.
2. **Kế thừa (Inheritance):** Dùng từ khóa `extends` để class con kế thừa đặc tính của class cha.
3. **Đóng gói (Encapsulation):** Che giấu chi tiết cài đặt bên trong class thông qua các access modifiers.

---

## 🎯 Bài tập thực hành
Hãy tạo một class `Student` có:
- Thuộc tính: `name`, `age`, `grade`.
- Hàm khởi tạo để gán các giá trị trên.
- Một phương thức `isPassing()` trả về `true` nếu `grade >= 5` và `false` nếu ngược lại.
