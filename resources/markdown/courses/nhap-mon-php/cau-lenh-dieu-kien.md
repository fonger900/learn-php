# Câu lệnh điều kiện

## Giới thiệu

Câu lệnh điều kiện cho phép chương trình thực thi các đoạn code khác nhau dựa trên điều kiện cụ thể. Đây là một trong những khái niệm cơ bản nhất trong lập trình.

## If Statement

### Cú pháp cơ bản

```php
<?php
$age = 18;

if ($age >= 18) {
    echo "Bạn đã đủ tuổi trưởng thành";
}
?>
```

### If-Else

```php
<?php
$score = 75;

if ($score >= 50) {
    echo "Bạn đã đậu";
} else {
    echo "Bạn đã trượt";
}
?>
```

### If-Elseif-Else

```php
<?php
$score = 85;

if ($score >= 90) {
    echo "Xuất sắc";
} elseif ($score >= 80) {
    echo "Giỏi";
} elseif ($score >= 70) {
    echo "Khá";
} elseif ($score >= 50) {
    echo "Trung bình";
} else {
    echo "Yếu";
}
?>
```

### Nested If (If lồng nhau)

```php
<?php
$age = 20;
$hasLicense = true;

if ($age >= 18) {
    if ($hasLicense) {
        echo "Bạn có thể lái xe";
    } else {
        echo "Bạn cần có bằng lái";
    }
} else {
    echo "Bạn chưa đủ tuổi lái xe";
}
?>
```

## Toán tử so sánh

```php
<?php
$a = 10;
$b = 20;

// Bằng (giá trị)
$a == $b;   // false

// Bằng (giá trị và kiểu)
$a === $b;  // false

// Khác (giá trị)
$a != $b;   // true
$a <> $b;   // true

// Khác (giá trị và kiểu)
$a !== $b;  // true

// Lớn hơn
$a > $b;    // false

// Nhỏ hơn
$a < $b;    // true

// Lớn hơn hoặc bằng
$a >= $b;   // false

// Nhỏ hơn hoặc bằng
$a <= $b;   // true

// Spaceship operator (PHP 7+)
$a <=> $b;  // -1 (nhỏ hơn), 0 (bằng), 1 (lớn hơn)
?>
```

### So sánh == vs ===

```php
<?php
// == so sánh giá trị (type juggling)
"10" == 10;      // true
0 == false;      // true
"" == false;     // true
null == false;   // true

// === so sánh giá trị VÀ kiểu dữ liệu
"10" === 10;     // false
0 === false;     // false
"" === false;    // false
null === false;  // false

// Best practice: Luôn dùng === trừ khi có lý do cụ thể
if ($user === null) {
    echo "User not found";
}
?>
```

## Toán tử logic

```php
<?php
$age = 25;
$hasLicense = true;
$hasInsurance = true;

// AND (&&) - Tất cả điều kiện phải đúng
if ($age >= 18 && $hasLicense) {
    echo "Có thể lái xe";
}

// OR (||) - Ít nhất một điều kiện đúng
if ($age < 18 || !$hasLicense) {
    echo "Không thể lái xe";
}

// NOT (!) - Đảo ngược điều kiện
if (!$hasInsurance) {
    echo "Cần mua bảo hiểm";
}

// XOR - Chỉ một trong hai điều kiện đúng
if ($hasLicense xor $hasInsurance) {
    echo "Chỉ có một trong hai";
}

// Kết hợp nhiều toán tử
if (($age >= 18 && $hasLicense) && $hasInsurance) {
    echo "Đủ điều kiện lái xe an toàn";
}
?>
```

### Short-circuit Evaluation

```php
<?php
// && dừng ngay khi gặp false
$result = false && expensiveFunction(); // expensiveFunction() không chạy

// || dừng ngay khi gặp true
$result = true || expensiveFunction(); // expensiveFunction() không chạy

// Ứng dụng thực tế
if ($user && $user->isActive()) {
    // Chỉ gọi isActive() nếu $user tồn tại
    echo "User is active";
}
?>
```

## Ternary Operator

```php
<?php
// Cú pháp: condition ? valueIfTrue : valueIfFalse
$age = 20;
$status = ($age >= 18) ? "Adult" : "Minor";

// Tương đương với:
if ($age >= 18) {
    $status = "Adult";
} else {
    $status = "Minor";
}

// Ternary lồng nhau (nên tránh vì khó đọc)
$score = 85;
$grade = ($score >= 90) ? "A" : 
         (($score >= 80) ? "B" : 
         (($score >= 70) ? "C" : "F"));

// Ví dụ thực tế
$discount = ($isMember) ? 0.1 : 0;
$price = $originalPrice * (1 - $discount);

echo "Hello, " . ($username ?? "Guest");
?>
```

## Null Coalescing Operator (PHP 7+)

```php
<?php
// ?? trả về giá trị đầu tiên không null
$username = $_GET['username'] ?? 'guest';

// Tương đương với:
$username = isset($_GET['username']) ? $_GET['username'] : 'guest';

// Chuỗi nhiều ??
$config = $userConfig ?? $defaultConfig ?? 'fallback';

// Ví dụ thực tế
$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 10;
$sort = $_GET['sort'] ?? 'created_at';

// Kết hợp với array
$email = $user['email'] ?? $profile['email'] ?? 'no-email@example.com';
?>
```

## Null Coalescing Assignment (PHP 7.4+)

```php
<?php
// ??= gán giá trị nếu biến null hoặc chưa tồn tại
$data['name'] ??= 'Default Name';

// Tương đương với:
if (!isset($data['name'])) {
    $data['name'] = 'Default Name';
}

// Ví dụ thực tế
$config['timeout'] ??= 30;
$config['retries'] ??= 3;
$config['debug'] ??= false;
?>
```

## Switch Statement

```php
<?php
$day = "Monday";

switch ($day) {
    case "Monday":
        echo "Đầu tuần";
        break;
    case "Tuesday":
    case "Wednesday":
    case "Thursday":
        echo "Giữa tuần";
        break;
    case "Friday":
        echo "Cuối tuần";
        break;
    case "Saturday":
    case "Sunday":
        echo "Nghỉ cuối tuần";
        break;
    default:
        echo "Ngày không hợp lệ";
}
?>
```

### Switch với nhiều kiểu dữ liệu

```php
<?php
$value = "10";

switch ($value) {
    case 10:        // So sánh với ==
        echo "Integer 10";
        break;
    case "10":
        echo "String 10";
        break;
    case 10.0:
        echo "Float 10";
        break;
}
// Output: String 10

// Dùng strict comparison
switch (true) {
    case $value === 10:
        echo "Integer 10";
        break;
    case $value === "10":
        echo "String 10";
        break;
}
?>
```

## Match Expression (PHP 8+)

Match là phiên bản hiện đại hơn của switch với nhiều ưu điểm.

```php
<?php
$status = "pending";

// Match expression
$message = match($status) {
    "pending" => "Đang chờ xử lý",
    "approved" => "Đã duyệt",
    "rejected" => "Đã từ chối",
    default => "Trạng thái không xác định"
};

// Tương đương switch
switch ($status) {
    case "pending":
        $message = "Đang chờ xử lý";
        break;
    case "approved":
        $message = "Đã duyệt";
        break;
    case "rejected":
        $message = "Đã từ chối";
        break;
    default:
        $message = "Trạng thái không xác định";
}
?>
```

### Ưu điểm của Match

```php
<?php
// 1. Trả về giá trị trực tiếp
$result = match($value) {
    1 => "One",
    2 => "Two",
    3 => "Three",
};

// 2. Strict comparison (===)
$value = "1";
$result = match($value) {
    1 => "Integer",    // Không match
    "1" => "String",   // Match!
};

// 3. Nhiều điều kiện
$result = match($day) {
    "Mon", "Tue", "Wed", "Thu", "Fri" => "Weekday",
    "Sat", "Sun" => "Weekend",
};

// 4. Expression phức tạp
$discount = match(true) {
    $total >= 1000 => 0.2,
    $total >= 500 => 0.1,
    $total >= 100 => 0.05,
    default => 0
};

// 5. Không cần break
$httpCode = 404;
$message = match($httpCode) {
    200 => "OK",
    404 => "Not Found",
    500 => "Server Error",
};
?>
```

## Ví dụ thực tế

### 1. Xác thực form

```php
<?php
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email)) {
    $errors[] = "Email không được để trống";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email không hợp lệ";
}

if (strlen($password) < 8) {
    $errors[] = "Mật khẩu phải có ít nhất 8 ký tự";
}

if (empty($errors)) {
    echo "Đăng ký thành công!";
} else {
    foreach ($errors as $error) {
        echo "- $error<br>";
    }
}
?>
```

### 2. Tính phí ship

```php
<?php
function calculateShipping($weight, $distance) {
    $baseFee = 20000;
    
    // Phí theo trọng lượng
    if ($weight <= 1) {
        $weightFee = 0;
    } elseif ($weight <= 5) {
        $weightFee = 10000;
    } else {
        $weightFee = 20000;
    }
    
    // Phí theo khoảng cách
    $distanceFee = match(true) {
        $distance <= 10 => 0,
        $distance <= 50 => 15000,
        $distance <= 100 => 30000,
        default => 50000
    };
    
    return $baseFee + $weightFee + $distanceFee;
}

echo calculateShipping(3, 25); // 45000
?>
```

### 3. Phân quyền người dùng

```php
<?php
$userRole = "admin";
$action = "delete_user";

$canPerform = match($userRole) {
    "admin" => true,
    "moderator" => in_array($action, ["edit_post", "delete_post"]),
    "user" => in_array($action, ["edit_own_post"]),
    default => false
};

if ($canPerform) {
    echo "Bạn có quyền thực hiện hành động này";
} else {
    echo "Bạn không có quyền";
}
?>
```

### 4. Tính giá vé xem phim

```php
<?php
function calculateTicketPrice($age, $day, $time) {
    // Giá cơ bản
    $basePrice = 100000;
    
    // Giảm giá theo tuổi
    if ($age < 12) {
        $basePrice *= 0.5; // Trẻ em giảm 50%
    } elseif ($age >= 60) {
        $basePrice *= 0.7; // Người cao tuổi giảm 30%
    }
    
    // Giảm giá theo ngày
    if (in_array($day, ["Monday", "Tuesday", "Wednesday"])) {
        $basePrice *= 0.8; // Giảm 20% đầu tuần
    }
    
    // Tăng giá giờ vàng
    if ($time >= 18 && $time <= 22) {
        $basePrice *= 1.2; // Tăng 20% giờ vàng
    }
    
    return $basePrice;
}

echo calculateTicketPrice(25, "Monday", 20); // 96000
?>
```

## Best Practices

```php
<?php
// ✅ Sử dụng === thay vì ==
if ($status === "active") {
    // ...
}

// ✅ Kiểm tra null/empty trước khi sử dụng
if (!empty($user) && $user->isActive()) {
    // ...
}

// ✅ Sử dụng early return
function processOrder($order) {
    if (!$order) {
        return false;
    }
    
    if ($order->status !== "pending") {
        return false;
    }
    
    // Process order
    return true;
}

// ✅ Sử dụng match cho code rõ ràng hơn (PHP 8+)
$status = match($code) {
    200 => "Success",
    404 => "Not Found",
    500 => "Error",
};

// ✅ Tránh nested if quá sâu
// ❌ Bad
if ($a) {
    if ($b) {
        if ($c) {
            // ...
        }
    }
}

// ✅ Good
if (!$a) return;
if (!$b) return;
if (!$c) return;
// ...

// ✅ Sử dụng null coalescing
$name = $_GET['name'] ?? 'Guest';
?>
```

## Bài tập

1. Viết chương trình kiểm tra năm nhuận
2. Tạo calculator đơn giản với switch/match
3. Viết hàm xác định loại tam giác (đều, cân, vuông, thường)
4. Tạo hệ thống chấm điểm với nhiều tiêu chí

```php
<?php
// Bài tập 1: Giải pháp mẫu
function isLeapYear($year) {
    if ($year % 400 === 0) {
        return true;
    }
    
    if ($year % 100 === 0) {
        return false;
    }
    
    if ($year % 4 === 0) {
        return true;
    }
    
    return false;
}

// Hoặc dùng match (PHP 8+)
function isLeapYear2($year) {
    return match(true) {
        $year % 400 === 0 => true,
        $year % 100 === 0 => false,
        $year % 4 === 0 => true,
        default => false
    };
}

echo isLeapYear(2024) ? "Năm nhuận" : "Không phải năm nhuận";
?>
```
