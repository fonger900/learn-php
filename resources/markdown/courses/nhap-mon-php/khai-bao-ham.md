# Hàm trong PHP (Functions)

Hàm là một khối mã lệnh có thể tái sử dụng nhiều lần trong chương trình. Sử dụng hàm giúp mã nguồn gọn gàng, dễ bảo trì và tránh trùng lặp code.

---

## 1. Khai báo hàm cơ bản

```php
<?php
function sayHello() {
    echo "Xin chào các bạn!";
}

sayHello(); // Gọi hàm
```

---

## 2. Tham số và Giá trị trả về (Type Declarations)

Trong PHP hiện đại, bạn nên khai báo kiểu dữ liệu cho tham số và giá trị trả về để tăng tính bảo mật và minh bạch.

```php
<?php
function add(int $a, int $b): int {
    return $a + $b;
}

$result = add(5, 10); // 15
```

### Kiểu dữ liệu nullable (`?`)
Nếu một tham số hoặc kết quả có thể là NULL, hãy thêm dấu `?` trước kiểu dữ liệu.

```php
<?php
function findUser(int $id): ?string {
    // Giả sử không tìm thấy user
    return null; 
}
```

---

## 3. Tham số mặc định và Tham số biến (Variadic)

### Tham số mặc định
```php
<?php
function greet($name = "Khách") {
    echo "Chào mừng $name!";
}

greet();        // Chào mừng Khách!
greet("Hoàng"); // Chào mừng Hoàng!
```

### Variadic Functions (Sử dụng `...`)
Cho phép truyền vào số lượng tham số không giới hạn.

```php
<?php
function sumAll(...$numbers): int {
    return array_sum($numbers);
}

echo sumAll(1, 2, 3, 4); // 10
```

---

## 4. Named Arguments (PHP 8+)
Cho phép bạn truyền tham số vào hàm dựa trên tên của chúng thay vì thứ tự.

```php
<?php
function setCookie($name, $value, $expire, $secure = true) {
    // Logic set cookie
}

// Chỉ cần truyền tham số name, value và secure mà không cần quan tâm expire
setCookie(
    name: "session_id",
    value: "abc123",
    secure: false,
    expire: 3600
);
```

---

## 5. Hàm ẩn danh (Anonymous) và Arrow Functions

### Anonymous Functions (Closure)
Thường dùng để làm callback.

```php
<?php
$greet = function($name) {
    return "Chào $name";
};

echo $greet("An");
```

### Arrow Functions (PHP 7.4+)
Cú pháp ngắn gọn hơn cho các hàm đơn giản. Chúng tự động truy cập được các biến ở scope bên ngoài.

```php
<?php
$multiplier = 2;
$doubler = fn($n) => $n * $multiplier;

echo $doubler(5); // 10
```

---

## 🧭 Lời khuyên thực tế
1. **Một hàm chỉ làm một việc:** Hãy giữ cho hàm của bạn nhỏ gọn và tập trung vào một nhiệm vụ duy nhất (Single Responsibility Principle).
2. **Đặt tên hàm rõ ràng:** Tên hàm nên là một động từ (ví dụ: `saveUser`, `calculateTotal`).
3. **Tránh sử dụng biến toàn cục (`global`):** Hãy truyền dữ liệu vào hàm thông qua tham số để code dễ kiểm soát hơn.
