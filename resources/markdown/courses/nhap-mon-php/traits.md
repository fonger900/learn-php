# Traits

Traits cho phép tái sử dụng code giữa các class không có quan hệ kế thừa.

## Cơ bản

```php
<?php
trait HasTimestamps
{
    private ?DateTime $createdAt = null;
    private ?DateTime $updatedAt = null;

    public function setCreatedAt(): void
    {
        $this->createdAt = new DateTime();
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }
}

trait SoftDeletes
{
    private ?DateTime $deletedAt = null;

    public function softDelete(): void
    {
        $this->deletedAt = new DateTime();
    }

    public function isDeleted(): bool
    {
        return $this->deletedAt !== null;
    }
}

class Post
{
    use HasTimestamps, SoftDeletes;

    public function __construct(public string $title) {}
}

$post = new Post('Học PHP');
$post->setCreatedAt();
$post->softDelete();
echo $post->isDeleted(); // true
```

## Giải quyết xung đột

```php
<?php
trait A
{
    public function hello(): string { return 'A'; }
}

trait B
{
    public function hello(): string { return 'B'; }
}

class MyClass
{
    use A, B {
        A::hello insteadof B; // Ưu tiên A
        B::hello as helloB;   // Đổi tên B
    }
}
```

> 💡 Traits rất phổ biến trong Laravel: `SoftDeletes`, `HasFactory`, `Notifiable`...