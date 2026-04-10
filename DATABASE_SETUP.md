# 🗄️ COMPLETE DATABASE SETUP GUIDE

## Step-by-Step Database Creation

### STEP 1: Open phpMyAdmin

1. Make sure XAMPP is running (Apache & MySQL started)
2. Open browser → Go to: `http://localhost/phpmyadmin`
3. Login (Username: root, Password: leave empty/blank)

### STEP 2: Create Database

1. Click **"New"** button (left sidebar)
2. **Database Name:** `daraz_ecommerce`
3. **Collation:** Choose `utf8mb4_unicode_ci` (for Bengali support)
4. Click **"Create"** button
5. Database created! ✅

### STEP 3: Run SQL Queries

1. Click on database: `daraz_ecommerce`
2. Go to **"SQL"** tab at the top
3. Copy each query below and paste it in the SQL editor
4. Click **"Go"** button after each query
5. All queries should execute without errors

---

## 📊 COPY-PASTE SQL QUERIES BELOW

### ⬇️ QUERY 1: Create Users Table

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

**Status:** ✅ Should show "1 row inserted"

---

### ⬇️ QUERY 2: Create Remember Me Tokens Table

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

**Status:** ✅ Should show "Query executed successfully"

---

### ⬇️ QUERY 3: Create Products Table

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

**Status:** ✅ Should show "Query executed successfully"

---

### ⬇️ QUERY 4: Create Cart Table

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

**Status:** ✅ Should show "Query executed successfully"

---

### ⬇️ QUERY 5: Create Orders Table

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

**Status:** ✅ Should show "Query executed successfully"

---

### ⬇️ QUERY 6: Create Order Items Table

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

**Status:** ✅ Should show "Query executed successfully"

---

### ⬇️ QUERY 7: Insert Sample Products

```sql
INSERT INTO products (name, description, price, category, stock, image_url) VALUES
('Samsung Galaxy A12', 'Latest Samsung smartphone with great camera and performance', 12999, 'Electronics', 50, 'products/samsung-a12.jpg'),
('Apple AirPods Pro', 'Premium wireless earbuds with active noise cancellation', 24999, 'Electronics', 30, 'products/airpods-pro.jpg'),
('Nike Running Shoes', 'Comfortable and durable professional running shoes', 5999, 'Fashion', 100, 'products/nike-shoes.jpg'),
('Laptop Backpack 15 inch', 'Professional laptop backpack with organizer pockets', 1299, 'Accessories', 75, 'products/laptop-bag.jpg'),
('Power Bank 20000mAh', 'High capacity power bank with fast charging support', 1899, 'Electronics', 200, 'products/powerbank.jpg');
```

**Status:** ✅ Should show "5 rows inserted"

---

## ✅ VERIFICATION CHECKLIST

### Verify All Tables Created

1. Click **"Refresh"** (F5) on phpmyadmin
2. Look at left sidebar under `daraz_ecommerce`
3. You should see these tables:
   - [ ] users
   - [ ] remember_me_tokens
   - [ ] products
   - [ ] cart
   - [ ] orders
   - [ ] order_items

### Verify Sample Data

1. Click on **"products"** table
2. Click **"Browse"** tab
3. You should see **5 products** listed with prices

4. Click on **"orders"** table
5. Should be **empty** (0 rows) - will fill when orders placed

6. Click on **"users"** table
7. Should be **empty** (0 rows) - will fill when users register

---

## 🔍 TROUBLESHOOTING

### "Error: Table already exists"
- **Solution:** Database already created. Skip to next query.

### "Error: No database selected"
- **Solution:** Click on `daraz_ecommerce` database name first!

### "Error: Syntax error"
- **Solution:** Copy-paste query exactly as shown. Check for typos.

### "Error: Foreign key constraint rules"
- **Solution:** Ensure tables created in correct order (users before remember_me_tokens)

### "Query executed but 0 rows inserted"
- **Solution:** For table creation queries, this is normal. 0 = success.

---

## 📋 EXPECTED RESULTS

### After Running All Queries:

| Table | Rows | Purpose |
|-------|------|---------|
| users | 0 | User accounts (fills on registration) |
| remember_me_tokens | 0 | Remember Me tokens (fills on login) |
| products | 5 | Product catalog (sample data) |
| cart | 0 | Shopping carts (fills when users shop) |
| orders | 0 | Orders (fills when checkout complete) |
| order_items | 0 | Order details (fills when checkout complete) |

---

## 🧪 TEST DATABASE

### Create Test User (OPTIONAL)

If you want a pre-made test account, run this:

```sql
INSERT INTO users (email, phone, password, first_name, last_name, city, address) 
VALUES ('test@daraz.com', '01712345678', '$2y$10$ZOEiAK6/UcfmqJH0J5V3.eYDVDiHPtV7CDj8mZL/.L0tL9KFu0Cba', 'Test', 'User', 'Dhaka', 'Test Address');
```

**Test Account:**
- Email: `test@daraz.com`
- Phone: `01712345678`
- Password: `password123`

---

## 🔐 DATABASE CONNECTIONS

### Config File Location
```
Lab/config.php
```

### Connection Details in config.php
```php
define('DB_HOST', 'localhost');      // XAMPP default
define('DB_USER', 'root');           // XAMPP default
define('DB_PASS', '');               // XAMPP default (empty)
define('DB_NAME', 'daraz_ecommerce');// Database name
```

**DO NOT CHANGE** unless you've configured XAMPP differently!

---

## 🚀 NEXT STEPS

After database setup complete:

1. **Open:** `http://localhost/Lab/index.html`
2. **Register** new account with your info
3. **Login** with email or phone
4. **Check "Remember Me"** if desired
5. **Browse** products on dashboard
6. **Add** to cart and checkout
7. See orders in your profile

---

## 📊 TABLE RELATIONSHIPS

```
users (1) ←→ (many) orders
    ↓ (1)      ↓ (many)
    ├────→ remember_me_tokens    order_items → products
    │
    └────→ cart → products
```

---

## 🎯 COMPLETION STATUS

- [ ] Database created
- [ ] All 6 tables created successfully
- [ ] Sample products inserted (5 rows)
- [ ] All queries executed without error
- [ ] Ready to test application!

---

## 📞 HELP & SUPPORT

**If something goes wrong:**

1. Check query syntax (copy-paste exactly)
2. Verify XAMPP MySQL is running
3. Verify database selected before running query
4. Check error message at bottom of phpMyAdmin
5. Refresh page (F5) and try again
6. Check DATABASE.md for detailed schema info

---

## ✨ BONUS: Database Statistics

```sql
-- Count total products
SELECT COUNT(*) as total_products FROM products;

-- Count users
SELECT COUNT(*) as total_users FROM users;

-- Check product stock
SELECT name, stock FROM products;

-- Check all tables
SHOW TABLES IN daraz_ecommerce;
```

---

**Database Setup Complete! 🎉**

**Now open http://localhost/Lab/index.html and start shopping! 🛒**
