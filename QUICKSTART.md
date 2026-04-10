# ⚡ QUICK START GUIDE - 5 Minutes Setup

## 🎯 Goal
Get Daraz e-commerce platform running in 5 minutes!

---

## ✅ Step 1: Start XAMPP (1 minute)

1. **Open XAMPP Control Panel**
2. **Click "Start" next to Apache**
3. **Click "Start" next to MySQL**
   - Wait for both to show green checkmarks
4. Done! ✅

---

## ✅ Step 2: Create Database (2 minutes)

1. **Open browser** → Go to: `http://localhost/phpmyadmin`
2. **Login** (leave password empty, username = root)
3. **Create New Database:**
   - Click "New" button
   - Name: `daraz_ecommerce`
   - Collation: `utf8mb4_unicode_ci`
   - Click "Create"

---

## ✅ Step 3: Import Database Schema (1 minute)

1. **Click on** `daraz_ecommerce` database
2. **Go to "SQL" tab**
3. **Copy-paste ALL queries** from `DATABASE.md` file:
   - Create Users table
   - Create Products table
   - Create Cart table
   - Create Orders table
   - Create Remember Me Tokens table
   - Insert sample products
4. **Click "Go"** to execute all queries
5. Done! ✅

---

## ✅ Step 4: First Test (1 minute)

### Option A: Register New User
1. **Open:** `http://localhost/Lab/register.html`
2. **Fill Form:**
   - Name: Your Name
   - Email: your@email.com
   - Phone: 01712345678
   - Password: Test@123
   - City: Dhaka
   - Address: Your Address
3. **Click "Create Account"**

### Option B: Direct Login (If sample data inserted)
1. **Open:** `http://localhost/Lab/index.html`
2. **Email:** user@daraz.com
3. **Password:** password (from your database)

---

## 🎉 Now You Can:

✅ **Login/Register** - Create accounts with email or phone

✅ **Remember Me** - Checkbox saves your credentials for 30 days

✅ **Browse Products** - View all products in dashboard

✅ **Search & Filter** - Find products by category or search

✅ **Add to Cart** - Build your shopping cart

✅ **Checkout** - Enter shipping & payment info

✅ **Place Orders** - Create orders and track them

✅ **View Orders** - See order history and status

---

## 📁 Important Files

| File | Purpose |
|------|---------|
| `index.html` | Login page with Remember Me |
| `register.html` | Create new account |
| `dashboard.html` | Browse & search products |
| `cart.html` | Shopping cart |
| `checkout.html` | Order confirmation |
| `orders.html` | View order history |
| `config.php` | Database connection |
| `database.md` | SQL schema & setup |

---

## 🔐 Features Included

```
✅ User Authentication
✅ Email & Phone Login
✅ Remember Me (30 days)
✅ Session Management
✅ Secure Passwords (Bcrypt)
✅ Product Catalog
✅ Shopping Cart
✅ Order System
✅ Order History
✅ Stock Management
✅ Payment Methods (COD/Online/Bank)
✅ Responsive Design
✅ Mobile Friendly
```

---

## 🚀 Navigation Flow

```
START
  ↓
Login/Register (index.html)
  ↓
Dashboard (dashboard.html) - Browse Products
  ↓
Product Detail (product-detail.html) - View Details
  ↓
Add to Cart
  ↓
View Cart (cart.html)
  ↓
Checkout (checkout.html)
  ↓
Place Order
  ↓
View Orders (orders.html)
  ↓
Log Out
```

---

## 🔍 Test Accounts

After running sample SQL:
- **Email:** user@daraz.com
- **Phone:** 01712345678
- **Password:** (See DATABASE.md)

Or register a new account anytime!

---

## 💾 Database at a Glance

```
Tables Created:
├── users (5 sample users to add)
├── products (5 sample products included)
├── cart (empty, fills as users shop)
├── orders (empty, fills when orders placed)
├── order_items (order details)
└── remember_me_tokens (auto-managed)
```

---

## ⚙️ Configuration

All settings in: `config.php`

```php
DB_HOST = localhost
DB_USER = root
DB_PASS = (empty)
DB_NAME = daraz_ecommerce
SESSION_LIFETIME = 30 days
COOKIE_LIFETIME = 30 days
```

---

## 🐛 Quick Fixes

### "Database connection failed"
- [ ] Check MySQL is running (green in XAMPP)
- [ ] Check database name: `daraz_ecommerce`
- [ ] Re-run SQL queries

### "Products not showing"
- [ ] Check `products` table has data
- [ ] Verify SQL insert statements ran

### "Remember Me not working"
- [ ] Check `remember_me_tokens` table exists
- [ ] Clear browser cookies
- [ ] Try login again

### "Can't create account"
- [ ] Check email/phone not already registered
- [ ] Verify `users` table exists
- [ ] Check password is 6+ characters

---

## 📞 Need Help?

1. **Check README.md** - Full documentation
2. **Check DATABASE.md** - All SQL schemas
3. **Check config.php** - Database settings
4. **Browser Console** - F12 for JavaScript errors
5. **XAMPP Logs** - Check error logs

---

## ✨ What's Working

- ✅ Registration with validation
- ✅ Login with email or phone
- ✅ Remember Me with tokens
- ✅ Secure password hashing
- ✅ Product browsing
- ✅ Search & filter
- ✅ Shopping cart
- ✅ Order checkout
- ✅ Order tracking
- ✅ Session management
- ✅ Responsive design
- ✅ Mobile compatible

---

## 🎯 Next Steps

1. **Get it running** (follow above steps)
2. **Test all pages** (click through everything)
3. **Create test orders** (add to cart, checkout)
4. **Explore code** (learn PHP & MySQL)
5. **Customize it** (add your own features!)

---

**Ready? Start with Step 1 above! 🚀**

## Command Quick Reference

```bash
# Open XAMPP
Windows: C:\xampp\xampp-control.exe

# Open phpMyAdmin
Browser: http://localhost/phpmyadmin

# Access the app
Browser: http://localhost/Lab/index.html

# Stop services
XAMPP Control Panel → Click Stop
```

---

**Good luck! 🎉 You've got this!**
