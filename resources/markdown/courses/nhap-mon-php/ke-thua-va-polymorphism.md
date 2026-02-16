# Kế thừa và Đa hình (Inheritance & Polymorphism)

Kế thừa và Đa hình là hai cột trụ quan trọng nhất của lập trình hướng đối tượng, giúp bạn xây dựng hệ thống linh hoạt và giảm thiểu code thừa.

---

## 1. Kế thừa (Inheritance)

Kế thừa cho phép một Class (lớp con) thừa hưởng các thuộc tính và phương thức từ một Class khác (lớp cha) bằng từ khóa `extends`.

```php
<?php
class User {
    public $name;
    
    public function login() {
        return "Người dùng $this->name đã đăng nhập.";
    }
}

class Admin extends User {
    public function deletePost($postId) {
        return "Admin $this->name đang xóa bài viết $postId.";
    }
}

$admin = new Admin();
$admin->name = "Hoàng";
echo $admin->login(); // Kế thừa từ lớp User
```

---

## 2. Ghi đè phương thức (Method Overriding)

Lớp con có thể định nghĩa lại một phương thức đã có ở lớp cha để phù hợp với nhu cầu riêng.

```php
<?php
class Animal {
    public function speak() {
        return "Tiếng kêu của động vật...";
    }
}

class Dog extends Animal {
    public function speak() {
        return "Gâu gâu!";
    }
}
```

Dùng `parent::speak()` nếu bạn muốn chạy cả mã của lớp cha bên trong phương thức ghi đè.

---

## 3. Đa hình (Polymorphism)

Đa hình cho phép các đối tượng thuộc các Class khác nhau phản hồi cùng một tên phương thức theo những cách khác nhau.

```php
<?php
function makeAnimalSpeak(Animal $animal) {
    echo $animal->speak();
}

makeAnimalSpeak(new Dog()); // Gâu gâu!
makeAnimalSpeak(new Cat()); // Meo meo!
```
*Hàm `makeAnimalSpeak` không cần biết nó đang nhận vào con gì, chỉ cần biết con đó là một `Animal` và có phương thức `speak()`.*

---

## 4. Từ khóa `final`

- **Lớp final:** Không cho phép class khác kế thừa nó.
- **Phương thức final:** Không cho phép class con ghi đè phương thức đó.

```php
<?php
final class Database {
    // Không ai có thể kế thừa class này để thay đổi logic cốt lõi
}
```

---

## 🗝️ Khái niệm quan trọng
1. **DRY (Don't Repeat Yourself):** Kế thừa giúp bạn tránh viết lại các đoạn mã chung.
2. **Abstraction:** Lớp cha đại diện cho khái niệm chung (như `User`), lớp con đại diện cho thực thể cụ thể (như `Admin`, `Customer`).
3. **Tính linh hoạt:** Đa hình cho phép bạn thay thế các thành phần của hệ thống mà không làm hỏng toàn bộ chương trình.
