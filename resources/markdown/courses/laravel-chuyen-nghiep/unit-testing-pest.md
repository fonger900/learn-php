# Unit Testing với Pest

## Giới thiệu Pest

Pest là một testing framework hiện đại cho PHP, được xây dựng trên PHPUnit với syntax đơn giản và dễ đọc hơn. Pest được tạo ra bởi Nuno Maduro và được Laravel khuyến nghị sử dụng.

## Cài đặt Pest

```bash
composer require pestphp/pest --dev --with-all-dependencies
composer require pestphp/pest-plugin-laravel --dev

# Khởi tạo Pest
php artisan pest:install
```

## Cấu trúc Test

### PHPUnit vs Pest

```php
// PHPUnit
class UserTest extends TestCase
{
    public function test_user_can_be_created()
    {
        $user = User::factory()->create();
        
        $this->assertDatabaseHas('users', [
            'email' => $user->email
        ]);
    }
}

// Pest - Đơn giản hơn!
test('user can be created', function () {
    $user = User::factory()->create();
    
    expect($user)->toBeInstanceOf(User::class)
        ->and($user->email)->not->toBeEmpty();
});
```

## Expectations API

### Basic Expectations

```php
test('basic expectations', function () {
    $value = 'Hello';
    
    expect($value)->toBe('Hello')
        ->toBeString()
        ->not->toBeEmpty()
        ->toHaveLength(5);
    
    $number = 42;
    expect($number)->toBeInt()
        ->toBeGreaterThan(40)
        ->toBeLessThan(50)
        ->toEqual(42);
    
    $array = [1, 2, 3];
    expect($array)->toBeArray()
        ->toHaveCount(3)
        ->toContain(2);
});
```

### Type Expectations

```php
test('type expectations', function () {
    expect('string')->toBeString();
    expect(123)->toBeInt();
    expect(3.14)->toBeFloat();
    expect(true)->toBeBool();
    expect([])->toBeArray();
    expect(new User)->toBeObject();
    expect(null)->toBeNull();
    expect(fn () => true)->toBeCallable();
});
```

### Collection Expectations

```php
test('collection expectations', function () {
    $users = User::factory()->count(3)->create();
    
    expect($users)->toHaveCount(3)
        ->each->toBeInstanceOf(User::class);
    
    $collection = collect([1, 2, 3, 4, 5]);
    
    expect($collection)->toContain(3)
        ->toHaveKey(0)
        ->sequence(
            fn ($item) => $item->toBe(1),
            fn ($item) => $item->toBe(2),
            fn ($item) => $item->toBe(3),
        );
});
```

## Testing Models

```php
test('user model has correct attributes', function () {
    $user = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);
    
    expect($user)
        ->name->toBe('John Doe')
        ->email->toBe('john@example.com')
        ->created_at->not->toBeNull();
});

test('user has many posts', function () {
    $user = User::factory()
        ->has(Post::factory()->count(3))
        ->create();
    
    expect($user->posts)->toHaveCount(3)
        ->each->toBeInstanceOf(Post::class);
});

test('user can be soft deleted', function () {
    $user = User::factory()->create();
    
    $user->delete();
    
    expect($user->trashed())->toBeTrue()
        ->and(User::withTrashed()->find($user->id))->not->toBeNull();
});
```

## Testing Services

```php
test('order service creates order correctly', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create(['price' => 100]);
    
    $orderService = app(OrderService::class);
    
    $order = $orderService->createOrder($user, [
        ['product_id' => $product->id, 'quantity' => 2]
    ]);
    
    expect($order)->toBeInstanceOf(Order::class)
        ->user_id->toBe($user->id)
        ->total->toBe(200)
        ->status->toBe('pending');
    
    expect($order->items)->toHaveCount(1)
        ->first()->quantity->toBe(2);
});

test('payment service processes payment', function () {
    $order = Order::factory()->create(['total' => 100]);
    
    $paymentService = app(PaymentService::class);
    
    $result = $paymentService->process($order, 'card');
    
    expect($result)->toBeTrue()
        ->and($order->fresh()->status)->toBe('paid');
});
```

## Mocking & Faking

### Mocking Dependencies

```php
test('notification is sent when order is created', function () {
    $notificationService = Mockery::mock(NotificationService::class);
    $notificationService->shouldReceive('sendOrderConfirmation')
        ->once()
        ->with(Mockery::type(Order::class));
    
    app()->instance(NotificationService::class, $notificationService);
    
    $orderService = app(OrderService::class);
    $order = $orderService->createOrder([...]);
    
    expect($order)->toBeInstanceOf(Order::class);
});
```

### Laravel Fakes

```php
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Event;

test('email is queued when order is created', function () {
    Mail::fake();
    
    $order = Order::factory()->create();
    
    Mail::assertQueued(OrderConfirmation::class, function ($mail) use ($order) {
        return $mail->order->id === $order->id;
    });
});

test('job is dispatched', function () {
    Queue::fake();
    
    ProcessOrder::dispatch($order);
    
    Queue::assertPushed(ProcessOrder::class);
});

test('event is fired', function () {
    Event::fake();
    
    $user = User::factory()->create();
    
    Event::assertDispatched(UserCreated::class, function ($event) use ($user) {
        return $event->user->id === $user->id;
    });
});
```

## Database Testing

```php
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('user can be stored in database', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com'
    ]);
    
    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com'
    ]);
});

test('user can be deleted from database', function () {
    $user = User::factory()->create();
    
    $user->delete();
    
    $this->assertDatabaseMissing('users', [
        'id' => $user->id
    ]);
});

test('database transaction is rolled back on error', function () {
    $initialCount = User::count();
    
    try {
        DB::transaction(function () {
            User::factory()->create();
            throw new Exception('Error');
        });
    } catch (Exception $e) {
        // Expected
    }
    
    expect(User::count())->toBe($initialCount);
});
```

## Datasets

Datasets cho phép chạy cùng một test với nhiều input khác nhau.

```php
test('validates email format', function ($email, $isValid) {
    $validator = Validator::make(
        ['email' => $email],
        ['email' => 'email']
    );
    
    expect($validator->passes())->toBe($isValid);
})->with([
    ['test@example.com', true],
    ['invalid-email', false],
    ['test@', false],
    ['@example.com', false],
    ['test@example.co.uk', true],
]);

// Named datasets
dataset('emails', [
    'valid email' => ['test@example.com', true],
    'invalid format' => ['invalid', false],
    'missing domain' => ['test@', false],
]);

test('validates emails', function ($email, $isValid) {
    // ...
})->with('emails');
```

## Higher Order Tests

```php
test('user factory creates valid user')
    ->expect(fn () => User::factory()->create())
    ->toBeInstanceOf(User::class)
    ->email->not->toBeEmpty()
    ->created_at->not->toBeNull();

test('collection methods work correctly')
    ->expect(fn () => collect([1, 2, 3]))
    ->toHaveCount(3)
    ->sum()->toBe(6)
    ->first()->toBe(1);
```

## Hooks

```php
beforeEach(function () {
    // Chạy trước mỗi test
    $this->user = User::factory()->create();
});

afterEach(function () {
    // Chạy sau mỗi test
    Cache::flush();
});

beforeAll(function () {
    // Chạy một lần trước tất cả tests
});

afterAll(function () {
    // Chạy một lần sau tất cả tests
});
```

## Test Organization

### Grouping Tests

```php
describe('User Management', function () {
    test('user can be created', function () {
        // ...
    });
    
    test('user can be updated', function () {
        // ...
    });
    
    test('user can be deleted', function () {
        // ...
    });
});

describe('Order Processing', function () {
    beforeEach(function () {
        $this->order = Order::factory()->create();
    });
    
    test('order can be paid', function () {
        // ...
    });
    
    test('order can be cancelled', function () {
        // ...
    });
});
```

### Using Traits

```php
// tests/Pest.php
uses(RefreshDatabase::class)->in('Feature');
uses(Tests\TestCase::class)->in('Feature', 'Unit');

// Tất cả tests trong Feature sẽ tự động dùng RefreshDatabase
```

## Practical Examples

### Testing API Endpoints

```php
test('can list users', function () {
    User::factory()->count(3)->create();
    
    $response = $this->getJson('/api/users');
    
    $response->assertOk()
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'email']
            ]
        ]);
});

test('can create user via API', function () {
    $data = [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'password123'
    ];
    
    $response = $this->postJson('/api/users', $data);
    
    $response->assertCreated()
        ->assertJson([
            'data' => [
                'name' => 'John Doe',
                'email' => 'john@example.com'
            ]
        ]);
    
    $this->assertDatabaseHas('users', [
        'email' => 'john@example.com'
    ]);
});
```

### Testing Authorization

```php
test('guest cannot access dashboard', function () {
    $response = $this->get('/dashboard');
    
    $response->assertRedirect('/login');
});

test('authenticated user can access dashboard', function () {
    $user = User::factory()->create();
    
    $response = $this->actingAs($user)->get('/dashboard');
    
    $response->assertOk();
});

test('user cannot delete other users posts', function () {
    $user = User::factory()->create();
    $otherPost = Post::factory()->create();
    
    $response = $this->actingAs($user)
        ->delete("/posts/{$otherPost->id}");
    
    $response->assertForbidden();
});
```

## Best Practices

```php
// ✅ Descriptive test names
test('user receives welcome email after registration', function () {
    // ...
});

// ✅ Arrange, Act, Assert pattern
test('order total is calculated correctly', function () {
    // Arrange
    $product = Product::factory()->create(['price' => 100]);
    
    // Act
    $order = Order::create([...]);
    $order->items()->create(['product_id' => $product->id, 'quantity' => 2]);
    
    // Assert
    expect($order->fresh()->total)->toBe(200);
});

// ✅ Test one thing at a time
test('user can be created', function () {
    $user = User::factory()->create();
    expect($user)->toBeInstanceOf(User::class);
});

test('user has correct attributes', function () {
    $user = User::factory()->create(['name' => 'John']);
    expect($user->name)->toBe('John');
});

// ✅ Use factories
test('creates user with factory', function () {
    $user = User::factory()->create();
    // ...
});
```

## Running Tests

```bash
# Chạy tất cả tests
php artisan test

# Chạy với Pest
./vendor/bin/pest

# Chạy file cụ thể
./vendor/bin/pest tests/Feature/UserTest.php

# Chạy test cụ thể
./vendor/bin/pest --filter="user can be created"

# Với coverage
./vendor/bin/pest --coverage

# Parallel testing
./vendor/bin/pest --parallel
```

## Kết luận

Pest làm cho testing trở nên dễ dàng và thú vị hơn với:
- Syntax đơn giản, dễ đọc
- Expectations API mạnh mẽ
- Datasets cho data-driven testing
- Higher order tests
- Tích hợp tốt với Laravel

## Bài tập

1. Viết tests cho User CRUD operations
2. Test một service class với mocked dependencies
3. Tạo dataset để test validation với nhiều inputs
4. Viết tests cho API endpoints với authentication
