# Custom Exception

## Tạo exception riêng

```php
<?php
class InsufficientFundsException extends RuntimeException
{
    public function __construct(
        private float $balance,
        private float $amount,
    ) {
        parent::__construct(
            sprintf('Số dư %s không đủ để rút %s',
                number_format($balance),
                number_format($amount)
            )
        );
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}

// Sử dụng
function withdraw(float $balance, float $amount): float
{
    if ($amount > $balance) {
        throw new InsufficientFundsException($balance, $amount);
    }
    return $balance - $amount;
}

try {
    withdraw(500000, 1000000);
} catch (InsufficientFundsException $e) {
    echo $e->getMessage();
    echo "Thiếu: " . number_format($e->getAmount() - $e->getBalance());
}
```

## Error Handling tốt

```php
<?php
// ❌ Sai: bắt tất cả và bỏ qua
try {
    riskyOperation();
} catch (Exception $e) {
    // Không làm gì — ĐỪNG làm thế!
}

// ✅ Đúng: xử lý hoặc ném lại
try {
    riskyOperation();
} catch (SpecificException $e) {
    log($e->getMessage());
    throw $e; // Ném lại để caller xử lý
}
```

> 💡 Chỉ bắt exception khi bạn **biết cách xử lý nó**. Nếu không, hãy để nó "nổi lên" (bubble up).