# Kiến trúc Laravel & Best Practices

## Giới thiệu

Laravel được xây dựng dựa trên kiến trúc MVC (Model-View-Controller) nhưng đã được mở rộng với nhiều pattern và concepts hiện đại. Trong bài học này, chúng ta sẽ tìm hiểu về kiến trúc tổng thể của Laravel và các best practices khi xây dựng ứng dụng production-ready.

## Kiến trúc Laravel

### 1. Request Lifecycle

Khi một request đến ứng dụng Laravel:

1. **Entry Point**: `public/index.php` nhận request
2. **Kernel**: HTTP Kernel xử lý request qua middleware stack
3. **Service Providers**: Bootstrap các services cần thiết
4. **Router**: Tìm route phù hợp và dispatch đến controller
5. **Controller**: Xử lý business logic
6. **Response**: Trả về response cho client

### 2. Service Container

Service Container là trái tim của Laravel, quản lý class dependencies và dependency injection.

```php
// Binding vào container
app()->bind(PaymentGateway::class, StripeGateway::class);

// Resolving từ container
$gateway = app(PaymentGateway::class);

// Constructor injection (tự động resolve)
class OrderController extends Controller
{
    public function __construct(
        private PaymentGateway $gateway
    ) {}
}
```

### 3. Service Providers

Service Providers là nơi bootstrap ứng dụng của bạn.

```php
class PaymentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PaymentGateway::class, function ($app) {
            return new StripeGateway(
                config('services.stripe.secret')
            );
        });
    }

    public function boot(): void
    {
        // Bootstrap code here
    }
}
```

## Best Practices

### 1. Tổ chức Code

**Controllers nên mỏng (Thin Controllers)**

```php
// ❌ Bad: Fat controller
class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([...]);
        
        $order = Order::create($validated);
        
        // Calculate total
        $total = 0;
        foreach ($order->items as $item) {
            $total += $item->price * $item->quantity;
        }
        
        // Process payment
        $stripe = new \Stripe\StripeClient(config('stripe.key'));
        $charge = $stripe->charges->create([...]);
        
        // Send email
        Mail::to($order->user)->send(new OrderConfirmation($order));
        
        return redirect()->route('orders.show', $order);
    }
}

// ✅ Good: Thin controller với service layer
class OrderController extends Controller
{
    public function __construct(
        private OrderService $orderService
    ) {}
    
    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderService->createOrder(
            $request->validated()
        );
        
        return redirect()->route('orders.show', $order);
    }
}
```

### 2. Single Responsibility Principle

Mỗi class nên có một trách nhiệm duy nhất.

```php
// ✅ Good: Tách concerns
class OrderService
{
    public function __construct(
        private OrderRepository $orders,
        private PaymentProcessor $payment,
        private NotificationService $notifications
    ) {}
    
    public function createOrder(array $data): Order
    {
        $order = $this->orders->create($data);
        
        $this->payment->process($order);
        
        $this->notifications->sendOrderConfirmation($order);
        
        return $order;
    }
}
```

### 3. Dependency Injection

Luôn sử dụng dependency injection thay vì khởi tạo trực tiếp.

```php
// ❌ Bad: Hard dependency
class OrderService
{
    public function process()
    {
        $gateway = new StripeGateway();
        $gateway->charge(...);
    }
}

// ✅ Good: Dependency injection
class OrderService
{
    public function __construct(
        private PaymentGateway $gateway
    ) {}
    
    public function process()
    {
        $this->gateway->charge(...);
    }
}
```

### 4. Form Request Validation

Tách validation logic ra khỏi controller.

```php
class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'payment_method' => ['required', 'in:card,paypal'],
        ];
    }
    
    public function messages(): array
    {
        return [
            'items.required' => 'Đơn hàng phải có ít nhất một sản phẩm.',
            'items.*.product_id.exists' => 'Sản phẩm không tồn tại.',
        ];
    }
}
```

### 5. Eloquent Best Practices

```php
// ✅ Sử dụng eager loading để tránh N+1
$orders = Order::with(['user', 'items.product'])->get();

// ✅ Sử dụng query scopes
class Order extends Model
{
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    
    public function scopeForUser($query, User $user)
    {
        return $query->where('user_id', $user->id);
    }
}

// Usage
$orders = Order::pending()->forUser($user)->get();

// ✅ Sử dụng accessors/mutators
class User extends Model
{
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value),
        );
    }
}
```

### 6. Configuration Management

```php
// ❌ Bad: Sử dụng env() trực tiếp
$apiKey = env('STRIPE_KEY');

// ✅ Good: Sử dụng config()
// config/services.php
return [
    'stripe' => [
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
];

// Usage
$apiKey = config('services.stripe.key');
```

### 7. Route Organization

```php
// routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show');
        Route::post('/', [OrderController::class, 'store'])->name('store');
    });
});
```

## Cấu trúc thư mục đề xuất

```
app/
├── Actions/           # Single-purpose action classes
├── Data/             # Data Transfer Objects
├── Enums/            # Enums
├── Http/
│   ├── Controllers/  # Thin controllers
│   ├── Middleware/
│   └── Requests/     # Form requests
├── Models/           # Eloquent models
├── Repositories/     # Repository pattern
├── Services/         # Business logic
└── Support/          # Helper classes
```

## Kết luận

Kiến trúc tốt giúp code dễ maintain, test và scale. Hãy luôn:

- Giữ controllers mỏng
- Áp dụng SOLID principles
- Sử dụng dependency injection
- Tách concerns rõ ràng
- Viết code dễ test

## Bài tập

1. Refactor một controller "fat" thành thin controller với service layer
2. Tạo một service provider để register custom services
3. Implement repository pattern cho một model
