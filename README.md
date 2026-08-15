# 📚 EMIS - Education Management Information System

A modern, fully responsive Education Management Information System built with **Laravel 8** and **PHP 8**. Designed to streamline school management with an intuitive and attractive interface.

---

## ⚡ QUICK START — XAMPP (Simplest Way — No Commands Needed!)

This is the **easiest way** — just like your old projects. **No `php artisan serve`, no port 8000.**

### Step 1: Download
Copy the project folder into:
```
C:\xampp\htdocs\emis
```

### Step 2: Install Dependencies (ONE TIME ONLY)
Open Command Prompt and run:
```bash
cd C:\xampp\htdocs\emis
composer install
```

### Step 3: Create the database
Open **http://localhost/phpmyadmin** → click **New** → name it **`emis`** → **Create**

### Step 4: Connect the database
Open `C:\xampp\htdocs\emis` → copy `.env.example` → rename the copy to **`.env`**

Then edit `.env` and set your MySQL credentials:
```env
APP_URL=http://localhost/emis
DB_DATABASE=emis
DB_USERNAME=root
DB_PASSWORD=
```
> If your MySQL has a password, type it after `DB_PASSWORD=`

### Step 5: Insert the tables
In phpMyAdmin:
1. Click the **`emis`** database
2. Click **Import** tab
3. Choose the file: `C:\xampp\htdocs\emis\database\emis.sql`
4. Click **Go** ✅

### Step 6: Run it!
Open your browser and visit:

### 🌐 **http://localhost/emis**

| Login | Value |
|-------|-------|
| **Email** | `admin@emis.local` |
| **Password** | `password` |

### 🔍 Having issues?
Visit **http://localhost/emis/setup.php** — it checks everything automatically and tells you exactly what's wrong. Then **delete setup.php** when done.

---

## 🚀 Installation Method 2 — Laravel Dev Server (Port 8000)

If you prefer the official Laravel method:

```bash
git clone <repository-url> emis
cd emis
composer install
cp .env.example .env
php artisan key:generate
# Edit .env with database credentials
php artisan migrate --seed
php artisan serve
```
Visit **http://localhost:8000**

---

## ✨ Features

### 👨‍🎓 Student Management
- Add, edit, view, and delete student records
- Track admission numbers, classes, sections, and roll numbers
- Guardian information management
- Student photo upload

### 👨‍🏫 Teacher Management
- Complete teacher profiles with qualification & experience tracking
- Subject assignment
- Employee ID generation

### 🏫 Class & Subject Management
- Manage classes with sections
- Subject assignment per class
- Subject code system

### 📋 Attendance Management
- Daily attendance marking by class
- Status options: Present, Absent, Late, Holiday
- Attendance reports and statistics

### 📝 Exams & Results
- Exam types configuration (First Term, Final Exam, etc.)
- Subject-wise exam scheduling
- Marks entry with grade assignment
- Pass/Fail status calculation

### 💰 Fee Management
- Fee types configuration
- Track paid, partial, and unpaid fees
- Due amount calculation

### 👥 User Management
- Role-based access (Admin, Teacher, Student, Parent)
- User account creation with status control
- Profile management

### 📊 Dashboard & Analytics
- Admin dashboard with statistics and charts
- Monthly enrollment trends
- Today's attendance overview
- Recent students and teachers lists

### 🎨 Modern UI
- Clean, modern design with gradient accents
- Fully responsive (mobile, tablet, desktop)
- Smooth animations and transitions
- Interactive sidebar navigation
- Toast notifications with SweetAlert2
- Detail cards and stat cards

---

## 🔧 Requirements

- **PHP** >= 8.0 (XAMPP 8.x recommended)
- **Composer** (Dependency Manager for PHP)
- **MySQL** >= 5.7 / MariaDB >= 10.3
- **Web Server**: Apache (XAMPP) with mod_rewrite enabled

> ⚠️ **For XAMPP users:** Make sure you have XAMPP with PHP 8. You can check by running `php -v`. Old XAMPP (PHP 7.x) won't run this app.

---

## 📁 Project Structure

```
emis/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/              # Admin controllers (CRUD operations)
│   │   │   ├── Auth/               # Authentication controllers
│   │   │   ├── DashboardController.php
│   │   │   └── HomeController.php
│   │   └── Middleware/
│   │       └── RoleMiddleware.php  # Role-based access control
│   └── Models/                     # Eloquent models
├── database/
│   ├── emis.sql                    # ⭐ DIRECT IMPORT FILE (phpMyAdmin)
│   ├── migrations/                 # Database schema (alternative)
│   └── seeders/
├── public/
│   ├── index.php
│   └── uploads/                    # Photo uploads folder
├── resources/views/                # All Blade templates
├── routes/web.php                  # Application routes
├── index.php                       # ⭐ Root entry (localhost/emis works!)
├── .htaccess                       # ⭐ Root rewrite rules
├── setup.php                       # ⭐ Installation checker (delete after setup)
├── .env.example
├── composer.json
└── package.json
```

---

## 🗄️ Database Tables (in emis.sql)

| Table                  | Description                    |
|------------------------|--------------------------------|
| `users`               | System users (all roles)       |
| `students`            | Student profiles               |
| `teachers`            | Teacher profiles               |
| `classes`             | Class/Room management          |
| `subjects`            | Subject definitions            |
| `enrollments`         | Student enrollment records     |
| `attendance`          | Daily attendance tracking      |
| `exam_types`          | Exam type configurations       |
| `exams`               | Exam schedules                 |
| `results`             | Student exam results           |
| `fee_types`           | Fee type configurations        |
| `fees`                | Fee payment records            |

---

## 🛠️ Troubleshooting

### 1. "localhost refused to connect"
- Make sure **Apache** is running (green) in XAMPP Control Panel
- If using port 8000: `php artisan serve` must be running in a terminal

### 2. "Composer could not find a composer.json file"
- Make sure you're in the right folder: `cd C:\xampp\htdocs\emis`
- The `composer.json` file must be present in that folder
- If you cloned the repo, use branch `arena/01a0038f-emis`

### 3. setup.php shows "✘ Composer vendor folder"
This means the `vendor` folder is missing — Laravel itself isn't installed yet. Fix it in **one of two ways**:
- **Easiest:** Double-click **`install.bat`** in the project folder — it installs everything automatically ✅
- **Manually:** Run in Command Prompt:
  ```bash
  cd C:\xampp\htdocs\emis
  composer install
  ```
- If `composer` is not recognized → install Composer from https://getcomposer.org/download/ (Composer-Setup.exe)

### 4. setup.php shows "✘ Storage writable"
Run this in Command Prompt inside `C:\xampp\htdocs\emis`:
```bash
attrib -r -s -h storage /s /d
icacls storage /grant Everyone:(OI)(CI)F /T
```
Or simply double-click **`install.bat`** — it fixes storage permissions automatically. Then reload setup.php.

### 5. 404 Not Found on routes (except homepage)
- Enable Apache mod_rewrite: In `C:\xampp\apache\conf\httpd.conf` uncomment:
  ```
  LoadModule rewrite_module modules/mod_rewrite.so
  ```
- Restart Apache in XAMPP Control Panel

### 4. Database connection error
- Verify credentials in `.env`
- Ensure MySQL is running in XAMPP
- Check the database name is `emis`

### 5. "Access denied" or permission issues
- Storage folder must be writable: `chmod -R 775 storage bootstrap/cache`

### 6. Blank page
- Check `setup.php` first: http://localhost/emis/setup.php
- Verify `vendor` folder exists (run `composer install`)
- Check PHP version is 8.0+

---

## 🔒 Security

- Password hashing with Bcrypt
- CSRF protection on all forms
- Role-based middleware for access control
- Input validation and sanitation
- XSS protection via Blade templating

---

## 📱 Responsive Design

The application is fully responsive and works on:
- Desktop (1024px+)
- Tablet (768px - 1023px)
- Mobile (320px - 767px)

---

## 🎯 Key Technologies

- **Backend**: Laravel 8.x, PHP 8.x
- **Frontend**: Bootstrap 5, Font Awesome 6, Chart.js
- **Database**: MySQL/MariaDB
- **Notifications**: SweetAlert2

---

## 📄 License

This project is open-sourced under the MIT license.
