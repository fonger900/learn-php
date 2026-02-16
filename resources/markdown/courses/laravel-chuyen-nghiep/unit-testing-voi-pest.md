# Unit Testing chuyên nghiệp với Pest

Viết test không phải là việc làm thêm, đó là một phần không thể thiếu của quá trình phát triển chuyên nghiệp. **Pest** là một testing framework mang phong cách thanh lịch, giúp việc viết test trở nên thú vị hơn.

---

## 1. Unit Test vs Feature Test

- **Unit Test**: Test một hàm hoặc một class nhỏ nhất trong sự cô lập (không chạm vào Database, File hay Network).
- **Feature Test**: Test một tính năng hoàn chỉnh của ứng dụng (đi qua Route, Controller, Database và trả về kết quả).

---

## 2. Làm quen với cú pháp Pest

Pest sử dụng cú pháp hàm (closure) giúp code rất dễ đọc.

```php
test('hàm tính tổng hoạt động đúng', function () {
    $result = sum(1, 2);

    expect($result)->toBe(3);
});
```

---

## 3. Test một Action Class

Giả sử bạn có `UpdatePriceAction`. Hãy test logic tính toán của nó.

```php
test('giá được tính toán chính xác sau khi giảm giá', function () {
    $action = new CalculateDiscountAction();
    
    $finalPrice = $action->execute(price: 100, discount: 20);

    expect($finalPrice)->toBe(80)
        ->toBeInt();
});
```

---

## 4. Expectations (Kỳ vọng)

Pest cung cấp bộ hàm `expect()` cực kỳ mạnh mẽ:
- `toBe()`
- `toBeTrue()` / `toBeFalse()`
- `toContain()` (cho array hoặc string)
- `toHaveCount()` (đếm phần tử)
- `toThrow()` (kiểm tra có ném ra exception không)

---

## 5. Tại sao phải viết Test?

1. **Tự tin khi Refactor:** Khi bạn sửa lại code cũ, test sẽ báo ngay nếu bạn vô tình làm hỏng tính năng nào đó.
2. **Tài liệu sống:** Đọc file test giúp người khác hiểu code của bạn dự định làm gì.
3. **Thiết kế code tốt hơn:** Code khó test thường là code chưa tốt. Khi viết test, bạn buộc phải thiết kế code theo dạng module và giảm phụ thuộc.

---

## 🧭 Lời khuyên chuyên nghiệp
- **Coverage:** Sử dụng lệnh `php artisan test --coverage` để xem bao nhiêu % code của bạn đã được test bao phủ.
- **Tên test rõ ràng:** Tên test nên mô tả một hành vi (ví dụ: `test('người dùng không thể đăng ký với email trùng lặp')`).
- **Setup & Teardown:** Dùng `beforeEach()` để chuẩn bị dữ liệu chung cho tất cả các test trong một file.
