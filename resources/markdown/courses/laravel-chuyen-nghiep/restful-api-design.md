# RESTful API Design

## Giới thiệu REST

REST (Representational State Transfer) là một architectural style cho việc thiết kế networked applications. RESTful API sử dụng HTTP methods và tuân theo các nguyên tắc REST.

## HTTP Methods

```php
// GET - Lấy dữ liệu
GET /api/users          // Lấy danh sách users
GET /api/users/1        // Lấy user có id = 1

// POST - Tạo mới
POST /api/users         // Tạo user mới

// PUT/PATCH - Cập nhật
PUT /api/users/1        // Cập nhật toàn bộ user
PATCH /api/users/1      // Cập nhật một phần user

// DELETE - Xóa
DELETE /api/users/1     // Xóa user
```

## Resource Naming

### Best Practices

```php
// ✅ Good - Sử dụng danh từ số nhiều
GET /api/users
GET /api/products
GET /api/orders

// ❌ Bad - Sử dụng động từ
GET /api/getUsers
GET /api/getAllProducts

// ✅ Good - Nested resources
GET /api/users/1/orders
GET /api/orders/1/items

// ✅ Good - Filtering, sorting, pagination
GET /api/users?status=active&sort=name&page=2

// ❌ Bad - Quá nhiều cấp nested
GET /api/users/1/orders/2/items/3/reviews
```

## Laravel API Routes

```php
// routes/api.php
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrderController;

// Resource routes
Route::apiResource('users', UserController::class);
Route::apiResource('orders', OrderController::class);

// Nested resources
Route::apiResource('users.orders', UserOrderController::class);

// Custom routes
Route::get('users/{user}/profile', [UserController::class, 'profile']);
Route::post('orders/{order}/cancel', [OrderController::class, 'cancel']);

// Authenticated routes
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('posts', PostController::class);
});
```

## API Controller

```php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $users = User::query()
            ->when(request('status'), fn($q, $status) => $q->where('status', $status))
            ->when(request('search'), fn($q, $search) => $q->where('name', 'like', "%{$search}%"))
            ->orderBy(request('sort', 'created_at'), request('order', 'desc'))
            ->paginate(request('per_page', 15));
        
        return UserResource::collection($users);
    }
    
    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = User::create($request->validated());
        
        return response()->json([
            'message' => 'User created successfully',
            'data' => new UserResource($user)
        ], 201);
    }
    
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }
    
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $user->update($request->validated());
        
        return response()->json([
            'message' => 'User updated successfully',
            'data' => new UserResource($user)
        ]);
    }
    
    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        
        return response()->json([
            'message' => 'User deleted successfully'
        ], 204);
    }
}
```

## API Resources

```php
<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => $this->avatar_url,
            'status' => $this->status,
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
            
            // Conditional attributes
            'email_verified_at' => $this->when(
                $request->user()?->isAdmin(),
                $this->email_verified_at
            ),
            
            // Relationships
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
            'posts' => PostResource::collection($this->whenLoaded('posts')),
            
            // Computed values
            'orders_count' => $this->when(
                $this->relationLoaded('orders'),
                $this->orders->count()
            ),
        ];
    }
}
```

## Response Format

### Success Response

```php
// Single resource
{
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com"
    }
}

// Collection
{
    "data": [
        {
            "id": 1,
            "name": "John Doe"
        },
        {
            "id": 2,
            "name": "Jane Doe"
        }
    ],
    "links": {
        "first": "http://api.example.com/users?page=1",
        "last": "http://api.example.com/users?page=10",
        "prev": null,
        "next": "http://api.example.com/users?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 10,
        "per_page": 15,
        "to": 15,
        "total": 150
    }
}
```

### Error Response

```php
// Validation error (422)
{
    "message": "The given data was invalid.",
    "errors": {
        "email": [
            "The email field is required."
        ],
        "password": [
            "The password must be at least 8 characters."
        ]
    }
}

// Not found (404)
{
    "message": "Resource not found"
}

// Unauthorized (401)
{
    "message": "Unauthenticated"
}

// Forbidden (403)
{
    "message": "This action is unauthorized"
}

// Server error (500)
{
    "message": "Server error",
    "error": "Something went wrong"
}
```

## Status Codes

```php
// Success
200 OK              // Successful GET, PUT, PATCH
201 Created         // Successful POST
204 No Content      // Successful DELETE

// Client Errors
400 Bad Request     // Invalid request
401 Unauthorized    // Not authenticated
403 Forbidden       // Not authorized
404 Not Found       // Resource not found
422 Unprocessable   // Validation failed
429 Too Many Requests // Rate limit exceeded

// Server Errors
500 Internal Server Error
503 Service Unavailable
```

## Filtering & Sorting

```php
class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        
        // Filtering
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->has('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }
        
        if ($request->has('role')) {
            $query->whereHas('roles', fn($q) => $q->where('name', $request->role));
        }
        
        // Sorting
        $sortField = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortField, $sortOrder);
        
        // Pagination
        $perPage = $request->get('per_page', 15);
        $users = $query->paginate($perPage);
        
        return UserResource::collection($users);
    }
}

// Usage:
// GET /api/users?status=active&search=john&sort=name&order=asc&per_page=20
```

## Versioning

```php
// URL versioning
Route::prefix('v1')->group(function () {
    Route::apiResource('users', V1\UserController::class);
});

Route::prefix('v2')->group(function () {
    Route::apiResource('users', V2\UserController::class);
});

// Header versioning
Route::middleware('api.version:v1')->group(function () {
    Route::apiResource('users', UserController::class);
});
```

## Rate Limiting

```php
// routes/api.php
Route::middleware(['throttle:api'])->group(function () {
    Route::apiResource('users', UserController::class);
});

// config/app.php - Custom rate limit
RateLimiter::for('api', function (Request $request) {
    return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
});

// Per-route rate limiting
Route::middleware(['throttle:10,1'])->group(function () {
    Route::post('orders', [OrderController::class, 'store']);
});
```

## Best Practices

```php
// ✅ Use API Resources for transformation
return UserResource::collection($users);

// ✅ Use Form Requests for validation
public function store(StoreUserRequest $request)

// ✅ Return appropriate status codes
return response()->json($data, 201);

// ✅ Use route model binding
public function show(User $user)

// ✅ Implement pagination
$users = User::paginate(15);

// ✅ Use eager loading
$users = User::with('orders', 'profile')->get();

// ✅ Handle errors gracefully
try {
    // ...
} catch (\Exception $e) {
    return response()->json([
        'message' => 'Error occurred',
        'error' => $e->getMessage()
    ], 500);
}
```

## Kết luận

RESTful API design tốt giúp:
- API dễ hiểu và sử dụng
- Consistent và predictable
- Dễ maintain và scale
- Tốt cho documentation

## Bài tập

1. Tạo CRUD API cho Product resource
2. Implement filtering, sorting, pagination
3. Tạo API Resources với relationships
4. Viết tests cho API endpoints
