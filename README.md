# 📚 EMIS - Education Management Information System

A modern, fully responsive Education Management Information System built with **Laravel 8** and **PHP 8**. Designed to streamline school management with an intuitive and attractive interface.

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

- **PHP** >= 8.0
- **Composer** (Dependency Manager for PHP)
- **MySQL** >= 5.7 / MariaDB >= 10.3
- **Node.js** & **NPM** (for front-end assets - optional if using CDN)
- **Web Server**: Apache/Nginx with mod_rewrite enabled
- **PHP Extensions**: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML, GD, MySQLi

---

## 🚀 Local Installation Guide

### Step 1: Clone the Repository
```bash
git clone <repository-url> emis
cd emis
```

### Step 2: Install PHP Dependencies
```bash
composer install
```

### Step 3: Environment Configuration
```bash
# Copy the example environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Configure Database
Edit the `.env` file and set your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=emis
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Step 5: Create Database
Create a MySQL database named `emis` (or your preferred name):
```sql
CREATE DATABASE emis CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Step 6: Run Migrations and Seeders
```bash
# Run database migrations
php artisan migrate

# Seed the database with initial data (admin user, classes, subjects, etc.)
php artisan db:seed
```

### Step 7: Create Storage Link
```bash
php artisan storage:link
```

### Step 8: Install Front-end Dependencies (Optional)
```bash
npm install
npm run dev
```
> **Note:** The application uses CDN links for Bootstrap, Font Awesome, and Chart.js, so this step is optional. Run it if you want to compile local assets.

### Step 9: Start Development Server
```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

---

## 🖥️ Default Login Credentials

| Role    | Email              | Password  |
|---------|--------------------|-----------|
| Admin   | admin@emis.local   | password  |

> **⚠️ IMPORTANT:** Change the default password immediately after first login.

---

## 📁 Project Structure

```
emis/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Admin controllers (CRUD operations)
│   │   │   │   ├── StudentController.php
│   │   │   │   ├── TeacherController.php
│   │   │   │   ├── ClassController.php
│   │   │   │   ├── SubjectController.php
│   │   │   │   ├── AttendanceController.php
│   │   │   │   ├── ExamController.php
│   │   │   │   ├── ResultController.php
│   │   │   │   ├── EnrollmentController.php
│   │   │   │   ├── FeeController.php
│   │   │   │   ├── UserController.php
│   │   │   │   └── SettingController.php
│   │   │   ├── Auth/           # Authentication controllers
│   │   │   ├── DashboardController.php
│   │   │   └── HomeController.php
│   │   └── Middleware/
│   │       └── RoleMiddleware.php   # Role-based access control
│   └── Models/
│       ├── User.php
│       ├── Student.php
│       ├── Teacher.php
│       ├── Classes.php
│       ├── Subject.php
│       ├── Attendance.php
│       ├── Exam.php
│       ├── ExamType.php
│       ├── Result.php
│       ├── Enrollment.php
│       ├── Fee.php
│       └── FeeType.php
├── database/
│   ├── migrations/             # Database schema
│   └── seeders/
│       └── DatabaseSeeder.php  # Initial data
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php       # Auth layout
│   │   └── admin.blade.php     # Admin dashboard layout
│   ├── auth/                   # Login/Register views
│   ├── dashboard/              # Dashboard views
│   └── admin/                  # Admin CRUD views
├── routes/
│   └── web.php                 # Application routes
├── .env.example                # Environment configuration template
├── composer.json               # PHP dependencies
└── package.json                # Front-end dependencies
```

---

## 🗄️ Database Tables

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

### 1. Blank page after installation
- Ensure `.env` file exists and `APP_KEY` is set
- Check PHP version (must be 8.0+)
- Verify storage directory permissions: `chmod -R 775 storage bootstrap/cache`

### 2. Database connection error
- Verify database credentials in `.env` file
- Ensure MySQL server is running
- Check if database exists

### 3. 404 Not Found on routes (except homepage)
- Enable Apache mod_rewrite: `sudo a2enmod rewrite`
- For Apache: Ensure `.htaccess` files are allowed in your vhost config:
  ```
  <Directory /path/to/emis/public>
      AllowOverride All
  </Directory>
  ```
- For Nginx: Add this to your server block:
  ```
  location / {
      try_files $uri $uri/ /index.php?$query_string;
  }
  ```

### 4. File uploads not working
- Ensure `storage` directory is writable
- Create storage link: `php artisan storage:link`

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
- **Icons**: Font Awesome 6

---

## 📄 License

This project is open-sourced under the MIT license.

---

## 🤝 Support

For support, please contact the system administrator or create an issue in the repository.