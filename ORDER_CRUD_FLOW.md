# 🔄 ORDER CRUD FLOW - SIMPLE EXPLANATION

## 📖 READ OPERATION - Pagkuha ng Orders (Pinaka Simple Example)

### **Example: User nag-view ng "My Orders"**

```
┌─────────────────────────────────────────────────────────────────┐
│  STEP 1: User nag-click sa "My Orders" link                    │
│  URL: http://localhost/my-orders                                │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 2: Laravel Route Handler                                  │
│  📁 File: routes/web.php                                        │
│  📍 Line: 49                                                    │
│                                                                  │
│  Route::get('/my-orders', [OrderController::class, 'myOrders'])│
│                                                                  │
│  Ginagawa:                                                       │
│  - Tinatanggap ang GET request                                  │
│  - Tinitignan kung sino ang controller method na tatawagin     │
│  - Calls: OrderController::myOrders()                           │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 3: Middleware Check (Authentication)                      │
│  📁 File: app/Http/Controllers/OrderController.php              │
│  📍 Line: 11-14                                                 │
│                                                                  │
│  public function __construct()                                   │
│  {                                                               │
│      $this->middleware('auth');  // ← Dito nangyayari          │
│  }                                                               │
│                                                                  │
│  Ginagawa:                                                       │
│  - Check kung naka-login ba ang user                            │
│  - Kung HINDI: Redirect sa /login                               │
│  - Kung OO: Tuloy sa next step                                  │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 4: Controller Method - myOrders()                         │
│  📁 File: app/Http/Controllers/OrderController.php              │
│  📍 Line: 58-65                                                 │
│                                                                  │
│  public function myOrders()                                      │
│  {                                                               │
│      $orders = Order::where('u_id', Auth::id())                 │
│          ->orderBy('created_at', 'desc')                        │
│          ->get();                                                │
│                                                                  │
│      return view('orders.my-orders', compact('orders'));        │
│  }                                                               │
│                                                                  │
│  Ginagawa:                                                       │
│  1. Gumagamit ng Order Model (Eloquent ORM)                     │
│  2. Query: "Kunin lahat ng orders na u_id = logged in user"     │
│  3. Sort: Latest orders first                                   │
│  4. Get: Execute query at kunin ang results                    │
│  5. Return: I-pass ang $orders sa view                          │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 5: Model Query (Eloquent ORM)                             │
│  📁 File: app/Models/Order.php                                  │
│                                                                  │
│  Order::where('u_id', Auth::id())                               │
│      ->orderBy('created_at', 'desc')                            │
│      ->get();                                                    │
│                                                                  │
│  Ginagawa:                                                       │
│  - Eloquent converts this to SQL:                               │
│    SELECT * FROM users_orders                                    │
│    WHERE u_id = [current_user_id]                               │
│    ORDER BY created_at DESC                                     │
│  - Kumukuha ng data sa database                                 │
│  - Nagco-convert sa Order objects                               │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 6: Return View with Data                                  │
│  📁 File: resources/views/orders/my-orders.blade.php             │
│                                                                  │
│  @forelse($orders as $order)                                    │
│      <td>{{ $order->title }}</td>                               │
│      <td>{{ $order->quantity }}</td>                            │
│      <td>₱{{ $order->price }}</td>                               │
│      ...                                                         │
│  @endforelse                                                     │
│                                                                  │
│  Ginagawa:                                                       │
│  - Blade template nagre-render ng HTML                          │
│  - Loop through each order                                      │
│  - Display order details                                         │
│  - Return final HTML page                                        │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 7: User nakikita ang orders sa browser                    │
│  Displayed HTML page with all orders                            │
└─────────────────────────────────────────────────────────────────┘
```

---

## ✅ CREATE OPERATION - Paggawa ng Order

```
┌─────────────────────────────────────────────────────────────────┐
│  STEP 1: User nag-click "Place Order" button                    │
│  Form submits: POST /checkout                                    │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 2: Route Handler                                          │
│  📁 File: routes/web.php                                         │
│  📍 Line: 48                                                     │
│                                                                  │
│  Route::post('/checkout', [OrderController::class, 'placeOrder'])│
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 3: Middleware Check (Auth)                                │
│  📁 File: app/Http/Controllers/OrderController.php               │
│  📍 Line: 11-14                                                 │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 4: Controller Method - placeOrder()                        │
│  📁 File: app/Http/Controllers/OrderController.php              │
│  📍 Line: 32-56                                                 │
│                                                                  │
│  1. Get cart from session                                       │
│  2. Check if cart is empty (validation)                         │
│  3. Loop through cart items                                     │
│  4. CREATE new Order record sa database                        │
│                                                                  │
│  Order::create([                                                │
│      'u_id' => Auth::id(),                                      │
│      'title' => $item['title'],                                  │
│      'quantity' => $item['quantity'],                            │
│      'price' => $item['price'] * $item['quantity'],             │
│      'address' => $user->address ?? null,                        │
│      'status' => null,                                           │
│  ]);                                                             │
│                                                                  │
│  Ginagawa:                                                       │
│  - Eloquent converts to: INSERT INTO users_orders...            │
│  - Saves sa database                                             │
│  - Returns created Order object                                  │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 5: Clear Cart & Redirect                                   │
`│  session()->forget('cart');                                      │
│  return redirect()->route('orders.my')                           │
│      ->with('success', 'Order placed successfully!');            │
└─────────────────────────────────────────────────────────────────┘
```

---

## 🔄 UPDATE OPERATION - I-cancel ang Order

```
┌─────────────────────────────────────────────────────────────────┐
│  STEP 1: User nag-click "Cancel" button                         │
│  Form submits: PUT /orders/{order}/cancel                       │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 2: Route Handler                                          │
│  📁 File: routes/web.php                                         │
│  📍 Line: 50                                                     │
│                                                                  │
│  Route::put('/orders/{order}/cancel',                            │
│      [OrderController::class, 'cancel'])                         │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 3: Controller Method - cancel()                            │
│  📁 File: app/Http/Controllers/OrderController.php                │
│  📍 Line: 67-82                                                 │
│                                                                  │
│  1. VALIDATION: Check if user owns the order                    │
│     if ($order->u_id !== Auth::id()) {                          │
│         abort(403);  // Forbidden!                               │
│     }                                                            │
│                                                                  │
│  2. VALIDATION: Check if order can be cancelled                 │
│     if ($order->status === 'in process' ||                       │
│         $order->status === 'closed') {                          │
│         return redirect()->with('error', ...);                   │
│     }                                                            │
│                                                                  │
│  3. UPDATE: Change status to 'rejected'                         │
│     $order->status = 'rejected';                                │
│     $order->save();  // ← Dito nangyayari ang UPDATE            │
│                                                                  │
│  Ginagawa:                                                       │
│  - Eloquent converts to: UPDATE users_orders                     │
│    SET status = 'rejected' WHERE o_id = [order_id]             │
│  - Updates sa database                                           │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 4: Redirect back to My Orders                             │
│  return redirect()->route('orders.my')                          │
│      ->with('success', 'Order cancelled successfully!');         │
└─────────────────────────────────────────────────────────────────┘
```

---

## 🗑️ DELETE OPERATION - Tanggalin ang Order

```
┌─────────────────────────────────────────────────────────────────┐
│  STEP 1: User nag-click "Delete" button                         │
│  Form submits: DELETE /orders/{order}                           │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 2: Route Handler                                          │
│  📁 File: routes/web.php                                         │
│  📍 Line: 51                                                     │
│                                                                  │
│  Route::delete('/orders/{order}',                                │
│      [OrderController::class, 'destroy'])                       │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 3: Controller Method - destroy()                           │
│  📁 File: app/Http/Controllers/OrderController.php                │
│  📍 Line: 84-93                                                 │
│                                                                  │
│  1. VALIDATION: Check if user owns the order                    │
│     if ($order->u_id !== Auth::id()) {                          │
│         abort(403);  // Forbidden!                               │
│     }                                                            │
│                                                                  │
│  2. DELETE: Tanggalin ang order                                 │
│     $order->delete();  // ← Dito nangyayari ang DELETE          │
│                                                                  │
│  Ginagawa:                                                       │
│  - Eloquent converts to: DELETE FROM users_orders                │
│    WHERE o_id = [order_id]                                      │
│  - Removes from database                                         │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 4: Redirect back to My Orders                             │
│  return redirect()->route('orders.my')                           │
│      ->with('success', 'Order deleted successfully!');          │
└─────────────────────────────────────────────────────────────────┘
```

---

## 📊 COMPLETE FLOW SUMMARY

### **READ (Pagkuha ng Orders)**
```
User → Route → Middleware → Controller → Model → Database → View → User
  ↓      ↓         ↓            ↓          ↓         ↓        ↓      ↓
Click  web.php  auth check  myOrders()  Order   SELECT   Blade   HTML
```

### **CREATE (Gumawa ng Order)**
```
User → Route → Middleware → Controller → Model → Database → Redirect
  ↓      ↓         ↓            ↓          ↓         ↓         ↓
Submit web.php  auth check placeOrder()  Order   INSERT   orders.my
```

### **UPDATE (I-cancel)**
```
User → Route → Controller → Validation → Model → Database → Redirect
  ↓      ↓         ↓            ↓          ↓         ↓         ↓
Submit web.php  cancel()   Ownership   Order   UPDATE   orders.my
                                        Check
```

### **DELETE (Tanggalin)**
```
User → Route → Controller → Validation → Model → Database → Redirect
  ↓      ↓         ↓            ↓          ↓         ↓         ↓
Submit web.php destroy()   Ownership   Order   DELETE   orders.my
                                        Check
```

---

## 🎯 KEY FILES AT ROLES NILA

| File | Role | Ginagawa |
|------|------|----------|
| `routes/web.php` | **Router** | Tumanggap ng request, mag-route sa controller |
| `app/Http/Controllers/OrderController.php` | **Controller** | Business logic, validation, call model |
| `app/Models/Order.php` | **Model** | Database operations (Eloquent ORM) |
| `resources/views/orders/my-orders.blade.php` | **View** | Display ng data sa user |

---

## 💡 SIMPLE ANALOGY

**Parang restaurant:**

1. **Route** (`routes/web.php`) = **Waiter** - Tinanggap ang order, sinabi sa kusina
2. **Controller** (`OrderController.php`) = **Chef** - Nag-process ng order, nag-check kung may ingredients
3. **Model** (`Order.php`) = **Inventory System** - Kumukuha o naglalagay ng items sa database
4. **Database** = **Storage Room** - Dito naka-save lahat ng data
5. **View** (`my-orders.blade.php`) = **Plating** - Pag-present ng final dish sa customer

---

## 🔍 DETAILED FILE LOCATIONS

### **READ Operation Flow:**
1. **URL:** `/my-orders`
   - 📍 **Location:** Browser URL bar o link sa website

2. **Route:** `routes/web.php:49`
   - 📍 **File:** `routes/web.php`
   - 📍 **Line 49:** `Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');`

3. **Middleware:** `app/Http/Controllers/OrderController.php:11-14` (auth check)
   - 📍 **File:** `app/Http/Controllers/OrderController.php`
   - 📍 **Lines 11-14:** `$this->middleware('auth');` sa `__construct()` method

4. **Controller:** `app/Http/Controllers/OrderController.php:58-65` (myOrders method)
   - 📍 **File:** `app/Http/Controllers/OrderController.php`
   - 📍 **Lines 58-65:** `public function myOrders()` method

5. **Model:** `app/Models/Order.php` (Eloquent query)
   - 📍 **File:** `app/Models/Order.php`
   - 📍 **Uses:** `Order::where('u_id', Auth::id())->orderBy('created_at', 'desc')->get();`

6. **Database:** `users_orders` table
   - 📍 **Database Name:** `final_food` (from `connection/connect.php`)
   - 📍 **Table:** `users_orders`
   - 📍 **SQL Query:** `SELECT * FROM users_orders WHERE u_id = ? ORDER BY created_at DESC`

7. **View:** `resources/views/orders/my-orders.blade.php`
   - 📍 **File:** `resources/views/orders/my-orders.blade.php`
   - 📍 **Shows:** Order list sa HTML table format

---

### **CREATE Operation Flow:**
1. **URL:** `POST /checkout`
   - 📍 **Location:** Form submission from checkout page

2. **Route:** `routes/web.php:48`
   - 📍 **File:** `routes/web.php`
   - 📍 **Line 48:** `Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('orders.place');`

3. **Middleware:** `app/Http/Controllers/OrderController.php:11-14` (auth check)
   - 📍 **File:** `app/Http/Controllers/OrderController.php`
   - 📍 **Lines 11-14:** `$this->middleware('auth');` sa `__construct()` method

4. **Controller:** `app/Http/Controllers/OrderController.php:32-56` (placeOrder method)
   - 📍 **File:** `app/Http/Controllers/OrderController.php`
   - 📍 **Lines 32-56:** `public function placeOrder(Request $request)` method
   - 📍 **Line 43:** `Order::create([...])` - Dito nangyayari ang CREATE

5. **Model:** `app/Models/Order.php` (Eloquent create)
   - 📍 **File:** `app/Models/Order.php`
   - 📍 **Uses:** `Order::create()` method na naka-define sa Eloquent Model

6. **Database:** `users_orders` table (INSERT)
   - 📍 **Database Name:** `final_food` (from `connection/connect.php`)
   - 📍 **Table:** `users_orders`
   - 📍 **SQL Query:** `INSERT INTO users_orders (u_id, title, quantity, price, address, status) VALUES (?, ?, ?, ?, ?, ?)`

7. **Redirect:** Back to `/my-orders`
   - 📍 **File:** `app/Http/Controllers/OrderController.php:55` - `return redirect()->route('orders.my');`

---

### **UPDATE Operation Flow:**
1. **URL:** `PUT /orders/{order}/cancel`
   - 📍 **Location:** Form submission from my-orders page (Cancel button)

2. **Route:** `routes/web.php:50`
   - 📍 **File:** `routes/web.php`
   - 📍 **Line 50:** `Route::put('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');`

3. **Controller:** `app/Http/Controllers/OrderController.php:67-82` (cancel method)
   - 📍 **File:** `app/Http/Controllers/OrderController.php`
   - 📍 **Lines 67-82:** `public function cancel(Order $order)` method

4. **Validation:** `app/Http/Controllers/OrderController.php:69-76` (ownership + status check)
   - 📍 **File:** `app/Http/Controllers/OrderController.php`
   - 📍 **Line 69:** Ownership check - `if ($order->u_id !== Auth::id())`
   - 📍 **Line 74:** Status check - `if ($order->status === 'in process' || $order->status === 'closed')`

5. **Model:** `app/Models/Order.php` (Eloquent save)
   - 📍 **File:** `app/Models/Order.php`
   - 📍 **Location:** `app/Http/Controllers/OrderController.php:78-79` - `$order->status = 'rejected'; $order->save();`

6. **Database:** `users_orders` table (UPDATE)
   - 📍 **Database Name:** `final_food` (from `connection/connect.php`)
   - 📍 **Table:** `users_orders`
   - 📍 **SQL Query:** `UPDATE users_orders SET status = 'rejected' WHERE o_id = ?`

7. **Redirect:** Back to `/my-orders`
   - 📍 **File:** `app/Http/Controllers/OrderController.php:81` - `return redirect()->route('orders.my');`

---

### **DELETE Operation Flow:**
1. **URL:** `DELETE /orders/{order}`
   - 📍 **Location:** Form submission from my-orders page (Delete button)

2. **Route:** `routes/web.php:51`
   - 📍 **File:** `routes/web.php`
   - 📍 **Line 51:** `Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');`

3. **Controller:** `app/Http/Controllers/OrderController.php:84-93` (destroy method)
   - 📍 **File:** `app/Http/Controllers/OrderController.php`
   - 📍 **Lines 84-93:** `public function destroy(Order $order)` method

4. **Validation:** `app/Http/Controllers/OrderController.php:86` (ownership check)
   - 📍 **File:** `app/Http/Controllers/OrderController.php`
   - 📍 **Line 86:** `if ($order->u_id !== Auth::id()) { abort(403); }`

5. **Model:** `app/Models/Order.php` (Eloquent delete)
   - 📍 **File:** `app/Models/Order.php`
   - 📍 **Location:** `app/Http/Controllers/OrderController.php:90` - `$order->delete();`

6. **Database:** `users_orders` table (DELETE)
   - 📍 **Database Name:** `final_food` (from `connection/connect.php`)
   - 📍 **Table:** `users_orders`
   - 📍 **SQL Query:** `DELETE FROM users_orders WHERE o_id = ?`

7. **Redirect:** Back to `/my-orders`
   - 📍 **File:** `app/Http/Controllers/OrderController.php:92` - `return redirect()->route('orders.my');`

---

## 🔌 API ENDPOINTS FLOW

### **API Routes Overview**

Ang API endpoints ay gumagamit ng **JSON responses** instead ng HTML views. Para sa mobile apps o frontend frameworks (React, Vue, etc.).

### **API READ Operation Flow:**

```
┌─────────────────────────────────────────────────────────────────┐
│  STEP 1: API Request (Mobile App / Frontend)                    │
│  GET http://localhost:8000/api/orders                            │
│  Headers: Authorization: Bearer {token}                         │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 2: API Route Handler                                      │
│  📁 File: routes/api.php                                         │
│  📍 Line: 10                                                      │
│                                                                  │
│  Route::get('/', [OrderController::class, 'index'])             │
│      ->middleware('auth:sanctum');                               │
│                                                                  │
│  Ginagawa:                                                       │
│  - Tumatanggap ng GET request sa /api/orders                     │
│  - Checks authentication via Sanctum middleware                  │
│  - Calls: Api\OrderController::index()                          │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 3: Authentication Middleware (Sanctum)                    │
│  📁 File: routes/api.php                                         │
│  📍 Line: 9                                                      │
│                                                                  │
│  ->middleware('auth:sanctum')                                    │
│                                                                  │
│  Ginagawa:                                                       │
│  - Validates API token                                          │
│  - If invalid: Returns 401 Unauthorized                         │
│  - If valid: Tuloy sa controller                                │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 4: API Controller Method                                  │
│  📁 File: app/Http/Controllers/Api/OrderController.php            │
│  📍 Method: index()                                              │
│                                                                  │
│  public function index()                                        │
│  {                                                               │
│      $orders = Order::where('u_id', Auth::id())                  │
│          ->orderBy('created_at', 'desc')                        │
│          ->get();                                                │
│                                                                  │
│      return response()->json([                                   │
│          'success' => true,                                      │
│          'data' => $orders                                       │
│      ]);                                                         │
│  }                                                               │
│                                                                  │
│  Ginagawa:                                                       │
│  - Same query logic as web controller                           │
│  - Returns JSON instead of view                                 │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 5: JSON Response                                          │
│  Content-Type: application/json                                  │
│                                                                  │
│  {                                                               │
│      "success": true,                                            │
│      "data": [                                                   │
│          {                                                       │
│              "o_id": 1,                                          │
│              "title": "Pizza",                                   │
│              "quantity": 2,                                       │
│              "price": "500.00",                                   │
│              "status": null,                                     │
│              "created_at": "2024-01-01T10:00:00.000000Z"         │
│          }                                                       │
│      ]                                                           │
│  }                                                               │
└─────────────────────────────────────────────────────────────────┘
```

---

### **API CRUD Operations:**

#### **📖 READ (GET)**
- **URL:** `GET /api/orders`
- **Route:** `routes/api.php:10`
- **Controller:** `app/Http/Controllers/Api/OrderController.php` → `index()`
- **Response:** JSON array of orders

#### **✅ CREATE (POST)**
- **URL:** `POST /api/orders`
- **Route:** `routes/api.php:11`
- **Controller:** `app/Http/Controllers/Api/OrderController.php` → `store()`
- **Request Body:** JSON with order data
- **Response:** JSON with created order

#### **📖 READ ONE (GET)**
- **URL:** `GET /api/orders/{id}`
- **Route:** `routes/api.php:12`
- **Controller:** `app/Http/Controllers/Api/OrderController.php` → `show()`
- **Response:** JSON with single order

#### **🔄 UPDATE (PUT)**
- **URL:** `PUT /api/orders/{id}`
- **Route:** `routes/api.php:14`
- **Controller:** `app/Http/Controllers/Api/OrderController.php` → `update()`
- **Request Body:** JSON with updated data
- **Response:** JSON with updated order

#### **🔄 CANCEL (PUT)**
- **URL:** `PUT /api/orders/{id}/cancel`
- **Route:** `routes/api.php:13`
- **Controller:** `app/Http/Controllers/Api/OrderController.php` → `cancel()`
- **Response:** JSON with cancelled order

#### **🗑️ DELETE**
- **URL:** `DELETE /api/orders/{id}`
- **Route:** `routes/api.php:15`
- **Controller:** `app/Http/Controllers/Api/OrderController.php` → `destroy()`
- **Response:** JSON success message

---

### **API vs Web Routes Comparison:**

| Feature | Web Routes | API Routes |
|---------|------------|------------|
| **File Location** | `routes/web.php` | `routes/api.php` |
| **Response Type** | HTML (Views) | JSON |
| **Authentication** | Session (auth middleware) | Token (auth:sanctum) |
| **URL Prefix** | `/` | `/api/` |
| **Use Case** | Browser/Web pages | Mobile apps, Frontend frameworks |

---

### **API Endpoints Summary:**

```
GET    /api/orders              → List all orders (authenticated user)
POST   /api/orders              → Create new order
GET    /api/orders/{id}         → Get single order
PUT    /api/orders/{id}         → Update order
PUT    /api/orders/{id}/cancel  → Cancel order
DELETE /api/orders/{id}         → Delete order
```

---

**Ito ang simple flow ng CRUD operations! Lahat ng steps ay nasa files na nakalista sa taas.** 🎯

