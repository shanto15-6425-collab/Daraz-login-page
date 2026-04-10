# DARAZ E-Commerce Platform - Complete Setup Guide

## 🎯 Project Overview

This is a fully functional e-commerce platform similar to Daraz Bangladesh with:
- ✅ User Authentication & Registration
- ✅ Session & Cookie Management
- ✅ Remember Me Functionality
- ✅ Product Listing & Filtering
- ✅ Shopping Cart
- ✅ Checkout System
- ✅ Order Management
- ✅ XAMPP/MySQL Database Integration

---

## 📋 Prerequisites

1. **XAMPP** installed on your system
   - Download from: https://www.apachefriends.org/
   
2. **Web Browser** (Chrome, Firefox, Edge, Safari)

3. **Text Editor/IDE** (VS Code recommended)

---

## 🚀 Installation & Setup

### Step 1: Extract Project Files

1. Extract all files to your XAMPP htdocs folder:
   ```
   C:\xampp\htdocs\Lab\
   ```

### Step 2: Start XAMPP Services

1. Open **XAMPP Control Panel**
2. Click "Start" for **Apache**
3. Click "Start" for **MySQL**

### Step 3: Create Database

1. Open browser and go to: `http://localhost/phpmyadmin`
2. Login (Username: root, Password: leave empty)
3. Click "New" to create database
4. Database name: `daraz_ecommerce`
5. Collation: `utf8mb4_unicode_ci`
6. Click "Create"

### Step 4: Run SQL Queries

1. Click on the new database `daraz_ecommerce`
2. Go to "SQL" tab
3. Copy and paste all queries from **DATABASE.md** file
4. Click "Go" to execute

The queries will create these tables:
- `users` - User accounts
- `products` - Product catalog
- `cart` - Shopping cart
- `orders` - User orders
- `order_items` - Order details
- `remember_me_tokens` - For "Remember Me" feature

---

## 📁 Project Structure

```
Lab/
├── index.html              (Login Page)
├── register.html           (Registration Page)
├── dashboard.html          (Home/Products Page)
├── product-detail.html     (Single Product Page)
├── cart.html              (Shopping Cart)
├── checkout.html          (Checkout Page)
├── orders.html            (Order History)
├── config.php             (Database Configuration)
├── login.php              (Login Backend)
├── register.php           (Registration Backend)
├── logout.php             (Logout)
├── get-products.php       (Product API)
├── add-to-cart.php        (Cart Operations)
├── place-order.php        (Order Processing)
├── DATABASE.md            (Database Schema)
└── README.md              (This File)
```

---

## 🔐 Authentication System

### Features:

#### 1. **Login Page** (`index.html`)
- Email or Phone login
- Remember Me checkbox
- Session & Cookie support
- Password encryption

#### 2. **Registration Page** (`register.html`)
- Create new account
- Email and phone validation
- Password strength indicator
- Address & location info

#### 3. **Remember Me Functionality**
- If user checks "Remember Me", a token is generated
- Token stored in database for 30 days
- Token also stored in browser cookie (HttpOnly)
- User auto-logged-in on next visit within 30 days
- Email/phone displayed for quick login access

#### 4. **Session Management**
- Sessions stored on server (30 days lifetime)
- Session data includes: user_id, email, phone, name
- Automatic logout on browser close (optional)
- CSRF protection ready

---

## 🛍️ E-Commerce Features

### 1. **Product Listing**
- Browse all products
- Filter by category
- Sort by price
- Search functionality
- Product stock display

### 2. **Shopping Cart**
- Add products with quantity
- Update quantities
- Remove products
- Calculate totals with tax & shipping
- localStorage backup

### 3. **Checkout**
- Shipping address form
- Multiple payment methods
  - Cash on Delivery (COD)
  - Online Payment
  - Bank Transfer
- Order notes

### 4. **Order Management**
- View order history
- Track order status
  - Pending
  - Processing
  - Shipped
  - Delivered
  - Cancelled
- Order details & items

---

## 💻 Testing the System

### Test Credentials (After Database Setup):

**Existing User** (If you ran sample inserts):
- Email: `user@daraz.com`
- Phone: `01712345678`
- Password: (Create one during registration)

### Create Test Account:

1. Go to: `http://localhost/Lab/index.html`
2. Click "Register here"
3. Fill in details:
   - Name, Email, Phone
   - Password (min 6 chars)
   - City & Address
4. Click "Create Account"

### Login:

1. Use email or phone
2. Enter password
3. Check "Remember Me" (optional)
4. Click "Login"

### Test Shopping:

1. Browse products on dashboard
2. Click product to view details
3. Add to cart
4. Go to cart page
5. Review items & totals
6. Proceed to checkout
7. Fill shipping info
8. Place order

---

## 🔄 Database Tables Schema

### Users Table
```sql
- id (INT, Primary Key)
- email (VARCHAR, Unique)
- phone (VARCHAR, Unique)
- password (VARCHAR, Hashed)
- first_name, last_name
- city, address
- created_at, updated_at
```

### Products Table
```sql
- id (INT, Primary Key)
- name, description
- price (DECIMAL)
- category
- stock (INT)
- image_url
- created_at, updated_at
```

### Orders Table
```sql
- id (INT, Primary Key)
- user_id (Foreign Key)
- total_amount (DECIMAL)
- status (ENUM)
- shipping_address (TEXT)
- created_at, updated_at
```

### Cart Table
```sql
- id (INT, Primary Key)
- user_id (Foreign Key)
- product_id (Foreign Key)
- quantity (INT)
- added_at (TIMESTAMP)
```

### Remember Me Tokens Table
```sql
- id (INT, Primary Key)
- user_id (Foreign Key)
- token (VARCHAR, Unique)
- expires_at (DATETIME)
- created_at (TIMESTAMP)
```

---

## 🔒 Security Features

### Implemented:

1. **Password Security**
   - Password hashing with bcrypt (PASSWORD_BCRYPT)
   - Minimum 6 characters
   - Never stored in plain text

2. **Session Security**
   - Server-side session storage
   - Session timeout: 30 days
   - Secure cookie handling

3. **SQL Injection Prevention**
   - real_escape_string() used
   - Input validation on all fields
   - Prepared statements ready

4. **CORS/CSRF**
   - Origin validation
   - Token system ready to implement

5. **Remember Me Security**
   - Secure random token generation
   - Token stored in HttpOnly cookies
   - Token expiration date tracking
   - Database validation on each visit

---

## 🎨 Frontend Technologies

- HTML5
- CSS3 (Responsive Design)
- Vanilla JavaScript (No jQuery)
- localStorage for client-side cart backup
- Fetch API for AJAX requests

---

## ⚙️ Backend Technologies

- PHP 7.4+
- MySQL 5.7+
- Apache Server (via XAMPP)

---

## 📝 API Endpoints

### Authentication
- `POST /login.php` - User login
- `POST /register.php` - User registration
- `POST /logout.php` - User logout
- `GET /login.php` - Check auth status

### Products
- `GET /get-products.php` - Get all products
- `GET /get-products.php?category=Electronics` - Filter by category

### Cart
- `POST /add-to-cart.php` - Add/Update cart
  - `action=add, product_id, quantity`
  - `action=remove, product_id`
  - `action=update, product_id, quantity`
- `GET /add-to-cart.php` - Get cart items

### Orders
- `POST /place-order.php` - Create order
- `GET /place-order.php` - Get user orders

---

## 🐛 Troubleshooting

### Issue: "Connection failed"
**Solution:**
- Check MySQL is running in XAMPP
- Verify database `daraz_ecommerce` exists
- Check credentials in `config.php`

### Issue: "Session not persisting"
**Solution:**
- Ensure cookies are enabled
- Check browser privacy settings
- Clear browser cache

### Issue: "Remember Me not working"
**Solution:**
- Check `remember_me_tokens` table exists
- Verify token not expired
- Clear browser cookies and re-login

### Issue: "Products not showing"
**Solution:**
- Verify sample products inserted
- Check products have stock > 0
- Check database connection

---

## 🚀 Deployment Checklist

Before going live:

- [ ] Change `SITE_URL` in config.php to your domain
- [ ] Update password hashing algorithm if needed
- [ ] Set up proper error handling
- [ ] Enable HTTPS/SSL
- [ ] Set up database backups
- [ ] Configure email notifications
- [ ] Test all payment methods
- [ ] Set up admin dashboard
- [ ] Configure rate limiting
- [ ] Set up security headers

---

## 📱 Features to Add (Future)

1. Email verification for registration
2. Password reset functionality
3. Wishlist/Favorites
4. Product reviews & ratings
5. Admin dashboard
6. Payment gateway integration (bKash, Nagaad)
7. Promo/Coupon codes
8. Email notifications
9. SMS alerts
10. Advanced analytics
11. Inventory management
12. Multiple addresses
13. Product variants/sizes
14. Real-time chat support
15. Mobile app

---

## 📞 Support

For issues or questions:
1. Check DATABASE.md for schema
2. Review config.php settings
3. Check browser console for errors
4. Check server error logs in XAMPP

---

## 📄 License

This project is for educational purposes. Feel free to modify and use as needed.

---

## ✅ Quick Start Checklist

- [ ] Extract files to xampp/htdocs/Lab/
- [ ] Start Apache & MySQL in XAMPP
- [ ] Create database in phpMyAdmin
- [ ] Run SQL queries from DATABASE.md
- [ ] Open http://localhost/Lab/index.html
- [ ] Create account
- [ ] Login
- [ ] Start shopping!

---

## 🎓 Learning Outcomes

By using this project, you'll learn:
- PHP backend development
- MySQL database design
- Session & cookie management
- User authentication
- E-commerce workflow
- Responsive web design
- Frontend-backend integration
- RESTful API concepts
- Security best practices

---

**Happy Shopping! 🛒🎉**
