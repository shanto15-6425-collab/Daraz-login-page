# 🚀 CONNECT TO XAMPP & RUN PROJECT - COMPLETE GUIDE

## ✅ STEP 1: START XAMPP SERVICES

### Windows:

1. **Open XAMPP Control Panel**
   - Look for XAMPP icon on desktop or Start menu
   - Or navigate to: `C:\xampp\xampp-control.exe`

2. **Start Apache:**
   - Find "Apache" in the control panel
   - Click "Start" button next to it
   - Wait until it shows **GREEN** checkmark ✅

3. **Start MySQL:**
   - Find "MySQL" in the control panel
   - Click "Start" button next to it
   - Wait until it shows **GREEN** checkmark ✅

4. **Verify Running:**
   - Both Apache and MySQL should be GREEN
   - If port conflicts: change ports (advanced)
   - You're ready for next step! ✅

---

## ✅ STEP 2: CREATE DATABASE IN XAMPP

### Method A: Using phpMyAdmin (EASIEST)

1. **Open phpMyAdmin:**
   - Open your web browser
   - Go to: `http://localhost/phpmyadmin`
   - Login page appears

2. **Login:**
   - **Username:** root
   - **Password:** (leave empty - just click Login)
   - Click "Go" button

3. **Create New Database:**
   - Look for "New" button in left sidebar
   - Click it
   - Database name field appears

4. **Name Your Database:**
   - Enter: `daraz_ecommerce`
   - Collation: select `utf8mb4_unicode_ci`
   - Click "Create" button
   - Database created! ✅

---

## ✅ STEP 3: RUN SQL QUERIES TO CREATE TABLES

### In phpMyAdmin:

1. **Select Database:**
   - Click on `daraz_ecommerce` in left sidebar
   - Database is now selected

2. **Go to SQL Tab:**
   - At the top, click "SQL" tab
   - Large text box appears for queries

3. **Copy First Query:**
   - Below you'll find all SQL queries
   - Copy the FIRST query (Users Table)
   - Paste it in the SQL text box

4. **Execute Query:**
   - Click "Go" button
   - Message appears: "Query executed successfully" ✅
   - First table created!

5. **Repeat for All Queries:**
   - Clear the text box
   - Copy next query (Remember Me Tokens)
   - Click "Go"
   - Repeat for all 7 queries below

---

## 📋 SQL QUERIES TO RUN (Copy-Paste These)

### QUERY 1: Users Table
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

### QUERY 2: Remember Me Tokens Table
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

### QUERY 3: Products Table
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

### QUERY 4: Cart Table
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

### QUERY 5: Orders Table
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

### QUERY 6: Order Items Table
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

### QUERY 7: Insert Sample Products
```sql
INSERT INTO products (name, description, price, category, stock, image_url) VALUES
('Samsung Galaxy A12', 'Latest Samsung smartphone with great camera and performance', 12999, 'Electronics', 50, 'products/samsung-a12.jpg'),
('Apple AirPods Pro', 'Premium wireless earbuds with active noise cancellation', 24999, 'Electronics', 30, 'products/airpods-pro.jpg'),
('Nike Running Shoes', 'Comfortable and durable professional running shoes', 5999, 'Fashion', 100, 'products/nike-shoes.jpg'),
('Laptop Backpack 15 inch', 'Professional laptop backpack with organizer pockets', 1299, 'Accessories', 75, 'products/laptop-bag.jpg'),
('Power Bank 20000mAh', 'High capacity power bank with fast charging support', 1899, 'Electronics', 200, 'products/powerbank.jpg');
```

---

## ✅ STEP 4: VERIFY DATABASE SETUP

### Check Tables Created:

1. **In phpMyAdmin:**
   - Database `daraz_ecommerce` selected
   - Look at LEFT sidebar dropdown
   - You should see 6 tables:
     - ✅ users
     - ✅ remember_me_tokens
     - ✅ products
     - ✅ cart
     - ✅ orders
     - ✅ order_items

2. **Check Sample Data:**
   - Click on "products" table
   - Click "Browse" tab
   - You should see 5 products ✅

3. **If Something's Missing:**
   - Go back to SQL tab
   - Re-run the query
   - Check error message
   - Ensure database is selected

---

## ✅ STEP 5: VERIFY FILES ARE IN XAMPP

### Check Project Files Location:

1. **All files should be in:**
   ```
   C:\xampp\htdocs\Lab\
   ```

2. **Files should include:**
   ```
   ✓ index.html
   ✓ register.html
   ✓ dashboard.html
   ✓ cart.html
   ✓ checkout.html
   ✓ orders.html
   ✓ config.php
   ✓ login.php
   ✓ register.php
   ✓ logout.php
   ✓ get-products.php
   ✓ add-to-cart.php
   ✓ place-order.php
   ✓ README.md
   ✓ QUICKSTART.md
   ✓ DATABASE_SETUP.md
   ```

3. **If Files Missing:**
   - Copy all files from Desktop/Lab/
   - To: C:\xampp\htdocs\Lab\
   - Paste all files there

---

## ✅ STEP 6: VERIFY DATABASE CONNECTION

### Test Connection:

1. **Open Browser:**
   - Type: `http://localhost/Lab/config.php`
   - Should load (no errors)
   - If error: check config.php settings

2. **Check phpMyAdmin Again:**
   - Go to: `http://localhost/phpmyadmin`
   - Database should still appear
   - All tables should be there

3. **Connection is Working!** ✅

---

## ✅ STEP 7: RUN YOUR PROJECT

### Open the Application:

1. **In Browser Address Bar:**
   - Type: `http://localhost/Lab/index.html`
   - Press Enter
   - Login page appears! ✅

2. **First Time? Register:**
   - Click "Register here" link
   - Fill in your details:
     - First Name: Your Name
     - Last Name: Your Last Name
     - Email: your@email.com
     - Phone: 01712345678
     - Password: Test@123 (min 6 chars)
     - City: Dhaka
     - Address: Your Address
   - Click "Create Account"
   - Account created! ✅

3. **Now Login:**
   - Use your email or phone
   - Enter password
   - Check "Remember Me" (optional)
   - Click "Login"
   - Dashboard loads with products! ✅

4. **Start Shopping:**
   - Browse products
   - Click on product for details
   - Add to cart
   - Go to cart page
   - Proceed to checkout
   - Enter shipping info
   - Place order
   - See order in history ✅

---

## 🧪 TESTING REMEMBER ME FEATURE

### Test Auto-Login:

1. **Login First Time:**
   - Go to: `http://localhost/Lab/index.html`
   - Enter email/phone & password
   - **Check "Remember Me"** ✓
   - Click Login
   - Success! ✅

2. **Close Browser Completely:**
   - Close all browser windows
   - Completely shut down browser

3. **Reopen Browser:**
   - Open browser again
   - Go to: `http://localhost/Lab/index.html`
   - Your email/phone should appear! ✅
   - Click Login (password auto-saved)
   - Should auto-login! ✅

4. **That's Remember Me Working!** 🎉

---

## 🔧 CONFIG FILE CHECK

### Verify config.php Settings:

1. **Open config.php in text editor**
2. **Check these settings:**
   ```php
   DB_HOST = 'localhost'          ✓
   DB_USER = 'root'               ✓
   DB_PASS = ''  (empty)          ✓
   DB_NAME = 'daraz_ecommerce'    ✓
   ```

3. **If Settings Different:**
   - MySQL is on different port? Change DB_HOST
   - Username not root? Change DB_USER
   - Password set? Add to DB_PASS
   - Database name different? Change DB_NAME

4. **Save file after changes**
5. **Refresh browser**

---

## 🐛 TROUBLESHOOTING

### "Connection failed"
```
✓ Check XAMPP Apache is GREEN
✓ Check XAMPP MySQL is GREEN
✓ Check database created: daraz_ecommerce
✓ Check config.php credentials
```

### "Page not found (404)"
```
✓ Check files in C:\xampp\htdocs\Lab\
✓ Refresh browser (Ctrl+F5)
✓ Check URL: http://localhost/Lab/index.html
```

### "Database does not exist"
```
✓ Go to phpMyAdmin
✓ Create database: daraz_ecommerce
✓ Run SQL queries
✓ Refresh project page
```

### "Products not showing"
```
✓ Check products table has data
✓ Verify INSERT query ran without error
✓ Check stock > 0 for visibility
✓ Refresh page (Ctrl+F5)
```

### "Login not working"
```
✓ Check users table created
✓ Check user registered in table
✓ Verify password entered correctly
✓ Check browser console (F12) for errors
```

### "Remember Me not working"
```
✓ Check remember_me_tokens table exists
✓ Check "Remember Me" checkbox before login
✓ Clear browser cookies
✓ Close and reopen browser
✓ Try login again
```

---

## ✅ COMPLETE CHECKLIST

After following all steps:

- [ ] XAMPP Apache running (GREEN)
- [ ] XAMPP MySQL running (GREEN)
- [ ] Database `daraz_ecommerce` created
- [ ] All 6 tables created
- [ ] Sample products inserted (5 items)
- [ ] All files in `C:\xampp\htdocs\Lab\`
- [ ] Can access `http://localhost/Lab/index.html`
- [ ] Can register new account
- [ ] Can login with credentials
- [ ] Can browse products
- [ ] Can add to cart
- [ ] Can checkout
- [ ] Remember Me works

---

## 🎉 YOU'RE READY!

Your project is now **LIVE and RUNNING!**

### Quick Access:
```
Login: http://localhost/Lab/index.html
Products: http://localhost/Lab/dashboard.html
Cart: http://localhost/Lab/cart.html
Orders: http://localhost/Lab/orders.html
phpMyAdmin: http://localhost/phpmyadmin
```

### Default Test Account:
```
Email: your@email.com
Phone: 01712345678
Password: Test@123
(Create this by registering)
```

---

## 📞 NEED HELP?

### Check These Files:
- `README.md` - Full documentation
- `QUICKSTART.md` - Quick setup
- `DATABASE_SETUP.md` - Database help
- `START_HERE.md` - Getting started
- `FILE_INVENTORY.md` - All files explained

### Common Issues:
- Check XAMPP status first
- Verify database created
- Check file locations
- Read error messages
- Check browser console (F12)

---

**✨ Your Daraz E-Commerce Platform is READY!**

**Happy Shopping! 🛒💻**
