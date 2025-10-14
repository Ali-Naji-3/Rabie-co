# API Documentation - Rabie Co

## Base URL
```
http://localhost:8000/api
```

## Authentication
All protected endpoints require a Bearer token in the Authorization header:
```
Authorization: Bearer {your_token}
```

---

## 🔓 Public Endpoints

### 1. Login / Get Token
**POST** `/login`

**Request Body:**
```json
{
  "email": "customer@example.com",
  "password": "password",
  "device_name": "mobile-app"
}
```

**Response:**
```json
{
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "customer@example.com"
  },
  "token": "1|abcdef123456..."
}
```

---

### 2. Get All Products
**GET** `/products`

**Query Parameters:**
- `category_id` (optional) - Filter by category
- `search` (optional) - Search in name/description
- `per_page` (optional) - Items per page (default: 15)
- `page` (optional) - Page number

**Example:**
```
GET /products?category_id=1&search=phone&per_page=10
```

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "name": "Wireless Headphones",
      "slug": "wireless-headphones",
      "description": "Premium noise-cancelling...",
      "price": "199.99",
      "sale_price": "149.99",
      "stock": 50,
      "images": null,
      "sku": "WH-001",
      "is_featured": true,
      "category": {
        "id": 1,
        "name": "Electronics"
      }
    }
  ],
  "links": {...},
  "meta": {...}
}
```

---

### 3. Get Single Product
**GET** `/products/{id}`

**Response:**
```json
{
  "id": 1,
  "name": "Wireless Headphones",
  "slug": "wireless-headphones",
  "description": "Premium noise-cancelling...",
  "price": "199.99",
  "sale_price": "149.99",
  "stock": 50,
  "category": {
    "id": 1,
    "name": "Electronics"
  },
  "reviews": [
    {
      "id": 1,
      "rating": 5,
      "comment": "Excellent product!",
      "user": {
        "name": "John Doe"
      }
    }
  ]
}
```

---

### 4. Get All Categories
**GET** `/categories`

**Response:**
```json
[
  {
    "id": 1,
    "name": "Electronics",
    "slug": "electronics",
    "description": "Electronic devices and gadgets",
    "products_count": 15
  }
]
```

---

## 🔒 Protected Endpoints

### 1. Get Current User
**GET** `/user`

**Headers:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
  "id": 1,
  "name": "John Doe",
  "email": "customer@example.com",
  "email_verified_at": null
}
```

---

### 2. Logout
**POST** `/logout`

**Headers:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
  "message": "Logged out successfully"
}
```

---

### 3. Get User Orders
**GET** `/orders`

**Headers:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "order_number": "ORD-123ABC",
      "subtotal": "199.99",
      "tax": "19.99",
      "shipping": "10.00",
      "total": "229.98",
      "status": "pending",
      "payment_status": "pending",
      "shipping_address": "123 Main St",
      "created_at": "2025-10-14T12:00:00.000000Z",
      "items": [
        {
          "id": 1,
          "quantity": 1,
          "price": "199.99",
          "subtotal": "199.99",
          "product": {
            "id": 1,
            "name": "Wireless Headphones"
          }
        }
      ]
    }
  ]
}
```

---

### 4. Get Single Order
**GET** `/orders/{id}`

**Headers:**
```
Authorization: Bearer {token}
```

**Response:** Same as order in list above

---

### 5. Create Order
**POST** `/orders`

**Headers:**
```
Authorization: Bearer {token}
Content-Type: application/json
```

**Request Body:**
```json
{
  "shipping_address": "123 Main St, City, Country",
  "billing_address": "123 Main St, City, Country",
  "notes": "Please ring doorbell"
}
```

**Response:**
```json
{
  "message": "Order placed successfully",
  "order": {
    "id": 1,
    "order_number": "ORD-123ABC",
    "total": "229.98",
    "status": "pending",
    "items": [...]
  }
}
```

**Notes:**
- Creates order from user's cart items
- Automatically calculates tax (10%) and shipping ($10)
- Clears cart after successful order
- Updates product stock

---

## 📱 Usage Examples

### JavaScript (Fetch)
```javascript
// Login
const response = await fetch('http://localhost:8000/api/login', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({
    email: 'customer@example.com',
    password: 'password',
    device_name: 'web-app'
  })
});
const data = await response.json();
const token = data.token;

// Get products
const products = await fetch('http://localhost:8000/api/products', {
  headers: { 'Authorization': `Bearer ${token}` }
});

// Create order
const order = await fetch('http://localhost:8000/api/orders', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'Authorization': `Bearer ${token}`
  },
  body: JSON.stringify({
    shipping_address: '123 Main St',
    billing_address: '123 Main St'
  })
});
```

---

### PHP (Guzzle)
```php
use GuzzleHttp\Client;

$client = new Client(['base_uri' => 'http://localhost:8000/api/']);

// Login
$response = $client->post('login', [
    'json' => [
        'email' => 'customer@example.com',
        'password' => 'password',
        'device_name' => 'php-client'
    ]
]);
$data = json_decode($response->getBody());
$token = $data->token;

// Get orders
$response = $client->get('orders', [
    'headers' => ['Authorization' => "Bearer {$token}"]
]);
```

---

### Python (Requests)
```python
import requests

BASE_URL = 'http://localhost:8000/api'

# Login
response = requests.post(f'{BASE_URL}/login', json={
    'email': 'customer@example.com',
    'password': 'password',
    'device_name': 'python-client'
})
token = response.json()['token']

# Get products
headers = {'Authorization': f'Bearer {token}'}
products = requests.get(f'{BASE_URL}/products', headers=headers)
```

---

## 🛡️ Error Responses

### 401 Unauthorized
```json
{
  "message": "Unauthenticated."
}
```

### 404 Not Found
```json
{
  "message": "No query results for model [Product] 999"
}
```

### 422 Validation Error
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "email": ["The email field is required."]
  }
}
```

### 500 Server Error
```json
{
  "error": "Failed to create order"
}
```

---

## 🔑 Token Management

### Generate Token (Web Dashboard)
1. Login at `/login`
2. Go to `/tokens`
3. Click "Generate New Token"
4. Copy token immediately (shown only once)

### Token Security
- Tokens are hashed in database
- Never share tokens
- Revoke unused tokens
- Use different tokens for different devices

---

## 📊 Rate Limiting
- 60 requests per minute per IP
- Authenticated: 100 requests per minute

---

## ✅ Status Codes
- `200` OK - Success
- `201` Created - Resource created
- `400` Bad Request - Invalid input
- `401` Unauthorized - Missing/invalid token
- `404` Not Found - Resource not found
- `422` Unprocessable Entity - Validation error
- `500` Server Error - Internal error

