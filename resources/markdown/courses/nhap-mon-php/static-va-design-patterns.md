# Static & Design Patterns

## Static Properties & Methods

```php
<?php
class Counter
{
    private static int $count = 0;

    public static function increment(): void
    {
        self::$count++;
    }

    public static function getCount(): int
    {
        return self::$count;
    }
}

Counter::increment();
Counter::increment();
echo Counter::getCount(); // 2
```

## Singleton Pattern

```php
<?php
class Database
{
    private static ?self $instance = null;

    private function __construct(private string $dsn) {}

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self('mysql:host=localhost;dbname=app');
        }
        return self::$instance;
    }
}

$db = Database::getInstance(); // Luôn trả về cùng 1 instance
```

## Factory Method Pattern

```php
<?php
class Notification
{
    private function __construct(
        public readonly string $type,
        public readonly string $message,
    ) {}

    public static function email(string $message): self
    {
        return new self('email', $message);
    }

    public static function sms(string $message): self
    {
        return new self('sms', $message);
    }
}

$noti = Notification::email('Chào bạn!');
echo $noti->type; // email
```

## Builder Pattern

```php
<?php
class QueryBuilder
{
    private string $table = '';
    private array $conditions = [];
    private ?int $limit = null;

    public function from(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    public function where(string $condition): self
    {
        $this->conditions[] = $condition;
        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    public function build(): string
    {
        $sql = "SELECT * FROM {$this->table}";
        if ($this->conditions) {
            $sql .= ' WHERE ' . implode(' AND ', $this->conditions);
        }
        if ($this->limit) {
            $sql .= " LIMIT {$this->limit}";
        }
        return $sql;
    }
}

$query = (new QueryBuilder())
    ->from('users')
    ->where('age > 18')
    ->where('active = 1')
    ->limit(10)
    ->build();
// SELECT * FROM users WHERE age > 18 AND active = 1 LIMIT 10
```