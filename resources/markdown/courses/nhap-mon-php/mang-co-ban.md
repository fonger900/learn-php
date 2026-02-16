# Mảng trong PHP (Arrays)

Mảng là một cấu trúc dữ liệu cho phép bạn lưu trữ nhiều giá trị trong một biến duy nhất. PHP hỗ trợ mảng cực kỳ linh hoạt và mạnh mẽ.

---

## 1. Các loại mảng

### Mảng chỉ số (Indexed Arrays)
Sử dụng số nguyên làm chìa khóa (key), bắt đầu từ số 0.

```php
<?php
$fruits = ["Táo", "Cam", "Xoài"];
echo $fruits[0]; // Táo
```

### Mảng kết hợp (Associative Arrays)
Sử dụng các chuỗi (string) tự định nghĩa làm chìa khóa. Đây là loại mảng phổ biến nhất khi làm việc với Database.

```php
<?php
$user = [
    "name" => "Nguyễn Văn A",
    "email" => "a@example.com",
    "age" => 25
];

echo $user["name"]; // Nguyễn Văn A
```

### Mảng đa chiều (Multidimensional Arrays)
Mảng chứa các mảng khác bên trong.

```php
<?php
$classes = [
    ["Toán", "Thứ 2"],
    ["Văn", "Thứ 4"]
];
echo $classes[0][0]; // Toán
```

---

## 2. Thêm và Xóa phần tử

```php
<?php
$colors = ["Đỏ", "Xanh"];

// Thêm vào cuối mảng
$colors[] = "Vàng"; 
array_push($colors, "Tím");

// Xóa phần tử cuối
array_pop($colors);

// Xóa một phần tử cụ thể bằng key
unset($user["age"]);
```

---

## 3. Spread Operator (PHP 7.4+)
Dùng để gộp mảng một cách nhanh chóng và dễ đọc.

```php
<?php
$arr1 = [1, 2, 3];
$arr2 = [...$arr1, 4, 5, 6]; 
// Kết quả: [1, 2, 3, 4, 5, 6]
```

---

## 4. Các hàm xử lý mảng quan trọng

| Hàm | Công dụng |
| :--- | :--- |
| **count()** | Đếm số phần tử trong mảng. |
| **is_array()** | Kiểm tra một biến có phải là mảng không. |
| **in_array()** | Kiểm tra một giá trị có tồn tại trong mảng không. |
| **array_merge()** | Gộp hai hoặc nhiều mảng. |
| **array_keys()** | Lấy danh sách tất cả các key của mảng. |
| **array_values()** | Lấy danh sách tất cả các giá trị của mảng. |

---

## 5. Duyệt mảng (Dùng `foreach`)

```php
<?php
foreach ($user as $key => $value) {
    echo "Thông tin $key là: $value <br>";
}
```

---

## 🎯 Bài tập thực hành
Hãy tạo một mảng danh sách sản phẩm, mỗi sản phẩm là một mảng kết hợp chứa: `tên`, `giá`, và `số lượng`.
1. Viết vòng lặp để in ra tên từng sản phẩm.
2. Tính tổng số tiền của tất cả sản phẩm (Giá * Số lượng).
