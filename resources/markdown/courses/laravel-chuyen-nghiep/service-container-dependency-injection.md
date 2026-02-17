# Service Container & Dependency Injection

## Giới thiệu

Service Container (hay IoC Container) là một công cụ mạnh mẽ để quản lý class dependencies và thực hiện dependency injection. Đây là nền tảng của Laravel và hiểu rõ nó sẽ giúp bạn viết code tốt hơn.

## Dependency Injection là gì?

Dependency Injection (DI) là một design pattern cho phép inject dependencies vào một class thay vì class tự tạo ra chúng.

### Ví dụ không dùng DI

```php
class OrderService
{
    private $mailer;
    
    public function __construct()
    {
        // Hard dependency - khó test và thay đổi
        $this->mailer = new Mailer();
    }
    
    public function createOrder($data)
    {
        // ... create order
        $this->mailer->send('Order created');
    }
}
```

### Ví dụ dùng DI

```php
class OrderService
{
    public function __construct(
        private MailerInterface $mailer
    ) {}
    
    public function createOrder($data)
    {
        // ... create order
        $this->mailer->send('Order created');
    }
}

// Dễ test với mock
$mockMailer = Mockery::mock(MailerInterface::class);
$service = new OrderService($mockMailer);
```

## Service Container

### Binding

Container cho phép bạn bind interfaces với implementations.

```php
// Binding đơn giản
app()->bind(MailerInterface::class, SmtpMailer::class);

// Binding với closure
app()->bind(PaymentGateway::class, function ($app) {
    return new StripeGateway(
        config('services.stripe.secret')
    );
});

// Singleton - chỉ tạo một instance duy nhất
app()->singleton(Cache::class, function ($app) {
    return new RedisCache(
        $app->make('redis')
    );
});

// Instance - bind một instance đã tồn tại
$api = new ApiClient();
app()->instance(ApiClient::class, $api);
```

### Resolving

```php
// Resolve từ container
$mailer = app(MailerInterface::class);

// Hoặc dùng helper
$mailer = resolve(MailerInterface::class);

// Hoặc dùng make
$mailer = app()->make(MailerInterface::class);

// Với parameters
$service = app()->makeWith(OrderService::class, [
    'config' => ['key' => 'value']
]);
```

### Automatic Resolution

Laravel tự động resolve dependencies trong constructor.

```php
class OrderController extends Controller
{
    // Laravel tự động inject OrderService
    public function __construct(
        private OrderService $orderService,
        private PaymentGateway $gateway
    ) {}
    
    public function store(Request $request)
    {
        // Cả $orderService và $gateway đã được inject
        return $this->orderService->create($request->all());
    }
}
```

## Contextual Binding

Bind khác nhau tùy theo context.

```php
// Khi PhotoController cần Filesystem, dùng local disk
app()->when(PhotoController::class)
    ->needs(Filesystem::class)
    ->give(function () {
        return Storage::disk('local');
    });

// Khi VideoController cần Filesystem, dùng S3
app()->when(VideoController::class)
    ->needs(Filesystem::class)
    ->give(function () {
        return Storage::disk('s3');
    });
```

## Binding Interfaces

```php
// Interface
interface PaymentGateway
{
    public function charge(int $amount): bool;
}

// Implementations
class StripeGateway implements PaymentGateway
{
    public function charge(int $amount): bool
    {
        // Stripe logic
        return true;
    }
}

class PayPalGateway implements PaymentGateway
{
    public function charge(int $amount): bool
    {
        // PayPal logic
        return true;
    }
}

// Binding trong Service Provider
class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            PaymentGateway::class,
            config('payment.default') === 'stripe'
                ? StripeGateway::class
                : PayPalGateway::class
        );
    }
}

// Usage - Laravel tự động inject implementation đúng
class OrderService
{
    public function __construct(
        private PaymentGateway $gateway
    ) {}
    
    public function processPayment(Order $order)
    {
        return $this->gateway->charge($order->total);
    }
}
```

## Tagging

Gom nhóm các bindings liên quan.

```php
// Đăng ký với tags
app()->bind(SpeedReport::class);
app()->bind(MemoryReport::class);

app()->tag([SpeedReport::class, MemoryReport::class], 'reports');

// Resolve tất cả tagged services
$reports = app()->tagged('reports');

foreach ($reports as $report) {
    $report->generate();
}
```

## Method Injection

Inject dependencies vào methods, không chỉ constructors.

```php
class OrderController extends Controller
{
    // Method injection trong controller methods
    public function store(
        StoreOrderRequest $request,
        OrderService $service
    ) {
        $order = $service->create($request->validated());
        
        return redirect()->route('orders.show', $order);
    }
    
    // Cũng hoạt động với route closures
    Route::get('/orders', function (OrderRepository $orders) {
        return $orders->all();
    });
}
```

## Practical Examples

### Example 1: Repository Pattern

```php
// Interface
interface OrderRepositoryInterface
{
    public function find(int $id): ?Order;
    public function create(array $data): Order;
}

// Implementation
class EloquentOrderRepository implements OrderRepositoryInterface
{
    public function find(int $id): ?Order
    {
        return Order::find($id);
    }
    
    public function create(array $data): Order
    {
        return Order::create($data);
    }
}

// Binding
class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            OrderRepositoryInterface::class,
            EloquentOrderRepository::class
        );
    }
}

// Usage
class OrderService
{
    public function __construct(
        private OrderRepositoryInterface $orders
    ) {}
    
    public function getOrder(int $id): ?Order
    {
        return $this->orders->find($id);
    }
}
```

### Example 2: Strategy Pattern

```php
interface NotificationChannel
{
    public function send(User $user, string $message): void;
}

class EmailChannel implements NotificationChannel
{
    public function send(User $user, string $message): void
    {
        Mail::to($user)->send(new GenericEmail($message));
    }
}

class SmsChannel implements NotificationChannel
{
    public function send(User $user, string $message): void
    {
        // Send SMS
    }
}

class NotificationService
{
    public function __construct(
        private NotificationChannel $channel
    ) {}
    
    public function notify(User $user, string $message): void
    {
        $this->channel->send($user, $message);
    }
}

// Contextual binding
app()->when(NotificationService::class)
    ->needs(NotificationChannel::class)
    ->give(function () {
        return match (config('notifications.default')) {
            'email' => app(EmailChannel::class),
            'sms' => app(SmsChannel::class),
            default => app(EmailChannel::class),
        };
    });
```

## Testing với DI

```php
class OrderServiceTest extends TestCase
{
    public function test_creates_order_and_sends_notification()
    {
        // Mock dependencies
        $mockRepo = Mockery::mock(OrderRepositoryInterface::class);
        $mockNotifier = Mockery::mock(NotificationService::class);
        
        $mockRepo->shouldReceive('create')
            ->once()
            ->andReturn(new Order(['id' => 1]));
            
        $mockNotifier->shouldReceive('notify')
            ->once();
        
        // Inject mocks
        $service = new OrderService($mockRepo, $mockNotifier);
        
        $order = $service->createOrder(['total' => 100]);
        
        $this->assertEquals(1, $order->id);
    }
}
```

## Best Practices

1. **Bind interfaces, không phải concrete classes**
   ```php
   // ✅ Good
   app()->bind(PaymentGateway::class, StripeGateway::class);
   
   // ❌ Bad
   app()->bind(StripeGateway::class, StripeGateway::class);
   ```

2. **Sử dụng Service Providers cho bindings**
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
   }
   ```

3. **Type-hint interfaces trong constructors**
   ```php
   public function __construct(
       private PaymentGateway $gateway,  // Interface
       private OrderRepository $orders   // Interface
   ) {}
   ```

## Kết luận

Service Container và Dependency Injection là nền tảng của Laravel. Hiểu và sử dụng đúng chúng giúp:

- Code dễ test hơn
- Dễ thay đổi implementations
- Giảm coupling giữa các classes
- Code linh hoạt và maintainable hơn

## Bài tập

1. Tạo một payment gateway interface với 2 implementations (Stripe và PayPal)
2. Sử dụng contextual binding để inject khác nhau cho các controllers
3. Viết tests với mocked dependencies
