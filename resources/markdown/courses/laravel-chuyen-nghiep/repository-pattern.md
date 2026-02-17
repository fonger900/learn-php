# Repository Pattern

## Giới thiệu

Repository Pattern là một design pattern tạo ra một lớp trừu tượng giữa business logic và data access layer. Pattern này giúp code dễ maintain, test và thay đổi data source.

## Tại sao cần Repository Pattern?

### Vấn đề khi không dùng Repository

```php
// Controller trực tiếp query database
class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'items')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('orders.index', compact('orders'));
    }
    
    public function show($id)
    {
        $order = Order::with('user', 'items.product')
            ->findOrFail($id);
            
        return view('orders.show', compact('order'));
    }
}
```

**Vấn đề:**
- Logic query lặp lại nhiều nơi
- Khó test
- Khó thay đổi data source
- Controller quá phức tạp

## Implementing Repository Pattern

### 1. Tạo Interface

```php
<?php

namespace App\Repositories\Contracts;

use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function all(): Collection;
    
    public function find(int $id): ?Order;
    
    public function findOrFail(int $id): Order;
    
    public function create(array $data): Order;
    
    public function update(int $id, array $data): bool;
    
    public function delete(int $id): bool;
    
    public function paginate(int $perPage = 15): LengthAwarePaginator;
    
    public function findByStatus(string $status): Collection;
    
    public function findByUser(int $userId): Collection;
}
```

### 2. Implement Repository

```php
<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class OrderRepository implements OrderRepositoryInterface
{
    public function __construct(
        protected Order $model
    ) {}
    
    public function all(): Collection
    {
        return $this->model->with(['user', 'items'])->get();
    }
    
    public function find(int $id): ?Order
    {
        return $this->model->with(['user', 'items'])->find($id);
    }
    
    public function findOrFail(int $id): Order
    {
        return $this->model->with(['user', 'items'])->findOrFail($id);
    }
    
    public function create(array $data): Order
    {
        return $this->model->create($data);
    }
    
    public function update(int $id, array $data): bool
    {
        $order = $this->findOrFail($id);
        return $order->update($data);
    }
    
    public function delete(int $id): bool
    {
        $order = $this->findOrFail($id);
        return $order->delete();
    }
    
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->with(['user', 'items'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
    
    public function findByStatus(string $status): Collection
    {
        return $this->model
            ->with(['user', 'items'])
            ->where('status', $status)
            ->get();
    }
    
    public function findByUser(int $userId): Collection
    {
        return $this->model
            ->with(['items'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
```

### 3. Binding trong Service Provider

```php
<?php

namespace App\Providers;

use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\OrderRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );
    }
}
```

### 4. Sử dụng trong Controller

```php
<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderController extends Controller
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository
    ) {}
    
    public function index()
    {
        $orders = $this->orderRepository->paginate(20);
        
        return view('orders.index', compact('orders'));
    }
    
    public function show($id)
    {
        $order = $this->orderRepository->findOrFail($id);
        
        return view('orders.show', compact('order'));
    }
    
    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderRepository->create($request->validated());
        
        return redirect()->route('orders.show', $order);
    }
}
```

## Base Repository

Tạo base repository để tránh lặp code.

```php
<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseRepository
{
    public function __construct(
        protected Model $model
    ) {}
    
    public function all(): Collection
    {
        return $this->model->all();
    }
    
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }
    
    public function findOrFail(int $id): Model
    {
        return $this->model->findOrFail($id);
    }
    
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }
    
    public function update(int $id, array $data): bool
    {
        $record = $this->findOrFail($id);
        return $record->update($data);
    }
    
    public function delete(int $id): bool
    {
        $record = $this->findOrFail($id);
        return $record->delete();
    }
    
    public function paginate(int $perPage = 15)
    {
        return $this->model->paginate($perPage);
    }
}
```

Extend base repository:

```php
<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends BaseRepository
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }
    
    // Chỉ implement methods đặc thù
    public function findByStatus(string $status)
    {
        return $this->model
            ->where('status', $status)
            ->get();
    }
}
```

## Advanced Patterns

### Criteria Pattern

```php
<?php

namespace App\Repositories\Criteria;

interface CriteriaInterface
{
    public function apply($model);
}

class StatusCriteria implements CriteriaInterface
{
    public function __construct(
        private string $status
    ) {}
    
    public function apply($model)
    {
        return $model->where('status', $this->status);
    }
}

class DateRangeCriteria implements CriteriaInterface
{
    public function __construct(
        private string $from,
        private string $to
    ) {}
    
    public function apply($model)
    {
        return $model->whereBetween('created_at', [$this->from, $this->to]);
    }
}

// Usage
$orders = $orderRepository
    ->pushCriteria(new StatusCriteria('pending'))
    ->pushCriteria(new DateRangeCriteria('2024-01-01', '2024-12-31'))
    ->all();
```

## Testing Repository

```php
<?php

use App\Models\Order;
use App\Repositories\OrderRepository;

test('can create order', function () {
    $repository = new OrderRepository(new Order);
    
    $order = $repository->create([
        'user_id' => 1,
        'total' => 100,
        'status' => 'pending'
    ]);
    
    expect($order)->toBeInstanceOf(Order::class)
        ->and($order->total)->toBe(100);
});

test('can find order by status', function () {
    Order::factory()->create(['status' => 'pending']);
    Order::factory()->create(['status' => 'completed']);
    
    $repository = new OrderRepository(new Order);
    $orders = $repository->findByStatus('pending');
    
    expect($orders)->toHaveCount(1)
        ->first()->status->toBe('pending');
});
```

## Best Practices

1. **Interface segregation** - Tạo interfaces nhỏ, tập trung
2. **Dependency injection** - Inject repository qua constructor
3. **Single responsibility** - Repository chỉ lo data access
4. **Avoid business logic** - Business logic thuộc về Service layer

## Kết luận

Repository Pattern giúp:
- Tách biệt data access logic
- Code dễ test và maintain
- Dễ thay đổi data source
- Tái sử dụng query logic

## Bài tập

1. Tạo UserRepository với CRUD operations
2. Implement base repository với common methods
3. Viết tests cho repository
4. Tạo criteria pattern cho filtering
