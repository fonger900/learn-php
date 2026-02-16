# Vòng lặp trong PHP (Loops)

Vòng lặp được sử dụng để thực thi lặp lại một khối mã lệnh nhiều lần chừng nào một điều kiện cụ thể còn thỏa mãn. PHP hỗ trợ 4 loại vòng lặp chính.

---

## 1. Vòng lặp `for`
Thường được dùng khi bạn biết trước chính xác số lần muốn lặp.

```php
<?php
for ($i = 0; $i < 5; $i++) {
    echo "Số: $i <br>";
}
```
- `$i = 0`: Khởi tạo biến đếm.
- `$i < 5`: Điều kiện dừng (chạy khi $i nhỏ hơn 5).
- `$i++`: Tăng biến đếm sau mỗi lần lặp.

---

## 2. Vòng lặp `while`
Lặp lại khối mã chừng nào điều kiện còn Đúng. Dùng khi không biết trước số lần lặp.

```php
<?php
$x = 1;
while($x <= 3) {
    echo "Lần lặp thứ $x <br>";
    $x++;
}
```
**⚠️ Cảnh báo:** Nếu bạn quên tăng biến đếm (`$x++`), vòng lặp sẽ chạy vô tận và làm treo máy chủ!

---

## 3. Vòng lặp `do...while`
Tương tự `while`, nhưng khối mã sẽ được **thực thi ít nhất một lần** trước khi kiểm tra điều kiện.

```php
<?php
$y = 6;
do {
    echo "Giá trị là: $y"; // Vẫn in ra dù 6 > 5
    $y++;
} while ($y <= 5);
```

---

## 4. Vòng lặp `foreach`
Được thiết kế riêng để duyệt qua các phần tử của một **Mảng (Array)** hoặc **Đối tượng (Object)**. Đây là vòng lặp được dùng nhiều nhất trong thực tế.

### Duyệt mảng chỉ số:
```php
<?php
$colors = ["Đỏ", "Xanh", "Vàng"];
foreach ($colors as $value) {
    echo "Màu: $value <br>";
}
```

### Duyệt mảng kết hợp (Key => Value):
```php
<?php
$ages = ["An" => 20, "Bình" => 22, "Chi" => 19];
foreach ($ages as $name => $age) {
    echo "$name năm nay $age tuổi. <br>";
}
```

---

## 5. Các lệnh điều hướng vòng lặp

### `break`
Dùng để thoát khỏi vòng lặp ngay lập tức.
```php
<?php
for ($i = 0; $i < 10; $i++) {
    if ($i == 5) break; // Dừng lại khi i bằng 5
    echo $i;
}
```

### `continue`
Bỏ qua lần lặp hiện tại và chuyển sang lần lặp kế tiếp.
```php
<?php
for ($i = 0; $i < 5; $i++) {
    if ($i == 2) continue; // Bỏ qua số 2
    echo $i;
}
// Kết quả: 0 1 3 4
```

---

## 💡 Mẹo và Thực tế
1. **Dùng `foreach` khi làm việc với dữ liệu:** Hầu hết dữ liệu từ Database trả về là mảng, nên `foreach` là lựa chọn tối ưu và an toàn nhất.
2. **Kiểm tra mảng trước khi lặp:** Tránh lỗi bằng cách kiểm tra mảng có rỗng không: `if (!empty($items)) { foreach... }`.
3. **Hiệu năng:** `for` nhanh hơn `foreach` một chút nhưng không đáng kể trong hầu hết ứng dụng web. Hãy ưu tiên mã nguồn dễ đọc (Readable code).
