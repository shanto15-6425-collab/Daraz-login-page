# DARAZ E-Commerce Platform - Database Setup

## XAMPP Setup Instructions

1. **Open XAMPP Control Panel**
   - Start Apache and MySQL services

2. **Open phpMyAdmin**
   - Go to: http://localhost/phpmyadmin
   - Login with Username: root (Password: empty)

3. **Create Database**
   - Click on "New" to create a new database
   - Database name: `daraz_ecommerce`
   - Collation: `utf8mb4_unicode_ci`
   - Click "Create"

4. **Run the Following SQL Queries**

### Users Table
```sql
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) UNIQUE NOT NULL,
  phone VARCHAR(20) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  first_name VARCHAR(100),
  last_name VARCHAR(100),
  city VARCHAR(100),
  address TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### Remember Me Tokens
```sql
CREATE TABLE remember_me_tokens (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  token VARCHAR(255) UNIQUE NOT NULL,
  expires_at DATETIME NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

### Products Table
```sql
CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  price DECIMAL(10, 2) NOT NULL,
  category VARCHAR(100),
  stock INT DEFAULT 0,
  image_url VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### Cart Table
```sql
CREATE TABLE cart (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  product_id INT NOT NULL,
  quantity INT DEFAULT 1,
  added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);
```

### Orders Table
```sql
CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  total_amount DECIMAL(10, 2) NOT NULL,
  status ENUM('pending', 'processing', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
  shipping_address TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

### Order Items Table
```sql
CREATE TABLE order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  quantity INT NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
  FOREIGN KEY (product_id) REFERENCES products(id)
);
```

### Sample Products
```sql
INSERT INTO products (name, description, price, category, stock, image_url) VALUES
('Samsung Galaxy A12', 'Latest Samsung smartphone with great camera', 12999, 'Electronics', 50, 'products/samsung-a12.jpg'),
('Apple AirPods Pro', 'Premium wireless earbuds with noise cancellation', 24999, 'Electronics', 30, 'products/airpods-pro.jpg'),
('Nike Running Shoes', 'Comfortable and durable running shoes', 5999, 'Fashion', 100, 'products/nike-shoes.jpg'),
('Laptop Bag', 'Professional laptop backpack 15 inch', 1299, 'Accessories', 75, 'products/laptop-bag.jpg'),
('Power Bank 20000mAh', 'High capacity power bank with fast charging', 1899, 'Electronics', 200, 'products/powerbank.jpg');
```

## Project Structure
```
Lab/
├── index.html (Login Page)
├── register.html (Registration Page)
├── dashboard.html (Homepage with Products)
├── product-detail.html (Single Product Page)
├── cart.html (Shopping Cart)
├── checkout.html (Checkout Page)
├── orders.html (User Orders)
├── admin.html (Admin Dashboard)
├── config.php (Database Connection)
├── login.php (Login API)
├── register.php (Registration API)
├── logout.php (Logout)
├── get-products.php (Product API)
├── add-to-cart.php (Add to Cart)
├── remove-from-cart.php (Remove from Cart)
├── get-cart.php (Get Cart Items)
├── place-order.php (Place Order)
├── css/
│   ├── style.css (Main stylesheet)
│   └── admin.css (Admin styling)
├── js/
│   ├── auth.js (Authentication logic)
│   ├── cart.js (Cart logic)
│   └── admin.js (Admin logic)
└── DATABASE.md (This file)
```
