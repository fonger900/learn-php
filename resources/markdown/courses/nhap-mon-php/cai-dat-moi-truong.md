# Cài đặt môi trường

## Các công cụ phổ biến

| Công cụ | Hệ điều hành | Ưu điểm |
|---------|-------------|---------|
| XAMPP | Windows/Linux/Mac | Dễ cài, đầy đủ Apache + MySQL + PHP |
| Laragon | Windows | Nhẹ, nhanh, hỗ trợ Laravel tốt |
| Homebrew | Mac | `brew install php` |
| Docker | Tất cả | Chuyên nghiệp, tách biệt môi trường |

## Cài đặt XAMPP

1. Tải XAMPP từ [apachefriends.org](https://www.apachefriends.org/)
2. Cài đặt và khởi động Apache
3. Tạo file `test.php` trong thư mục `htdocs`

## Kiểm tra cài đặt

```bash
php -v
# PHP 8.4.x (cli) ...
```

## PHP tích hợp sẵn Web Server

```bash
# Khởi động server tại thư mục hiện tại
php -S localhost:8080

# Mở trình duyệt → http://localhost:8080
```

> 💡 PHP có web server tích hợp sẵn, rất tiện cho việc học và phát triển.