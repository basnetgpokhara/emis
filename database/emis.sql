-- =====================================================
-- EMIS - Education Management Information System
-- Complete Database Schema with Sample Data
-- Laravel 8 / PHP 8 Compatible
-- =====================================================

-- IMPORTANT: Drop existing tables if you want a fresh start
-- Uncomment the DROP statements below if you want to remove old tables first
-- DROP TABLE IF EXISTS fees;
-- DROP TABLE IF EXISTS fee_types;
-- DROP TABLE IF EXISTS results;
-- DROP TABLE IF EXISTS exams;
-- DROP TABLE IF EXISTS exam_types;
-- DROP TABLE IF EXISTS attendance;
-- DROP TABLE IF EXISTS enrollments;
-- DROP TABLE IF EXISTS subjects;
-- DROP TABLE IF EXISTS classes;
-- DROP TABLE IF EXISTS teachers;
-- DROP TABLE IF EXISTS students;
-- DROP TABLE IF EXISTS personal_access_tokens;
-- DROP TABLE IF EXISTS failed_jobs;
-- DROP TABLE IF EXISTS password_resets;
-- DROP TABLE IF EXISTS users;

SET FOREIGN_KEY_CHECKS = 0;

-- =====================================================
-- TABLE: users
-- =====================================================
CREATE TABLE IF NOT EXISTS `users` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `email_verified_at` TIMESTAMP NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('admin', 'teacher', 'student', 'parent') NOT NULL DEFAULT 'student',
    `phone` VARCHAR(20) NULL,
    `address` TEXT NULL,
    `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    `photo` VARCHAR(255) NULL,
    `remember_token` VARCHAR(100) NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: password_resets
-- =====================================================
CREATE TABLE IF NOT EXISTS `password_resets` (
    `email` VARCHAR(255) NOT NULL,
    `token` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NULL,
    INDEX `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: failed_jobs
-- =====================================================
CREATE TABLE IF NOT EXISTS `failed_jobs` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `uuid` VARCHAR(255) NOT NULL,
    `connection` TEXT NOT NULL,
    `queue` TEXT NOT NULL,
    `payload` LONGTEXT NOT NULL,
    `exception` LONGTEXT NOT NULL,
    `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: personal_access_tokens
-- =====================================================
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `tokenable_type` VARCHAR(255) NOT NULL,
    `tokenable_id` BIGINT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `token` VARCHAR(64) NOT NULL,
    `abilities` TEXT NULL,
    `last_used_at` TIMESTAMP NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
    INDEX `personal_access_tokens_tokenable_index` (`tokenable_type`, `tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: classes
-- =====================================================
CREATE TABLE IF NOT EXISTS `classes` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `numeric_name` INT NOT NULL,
    `section` VARCHAR(10) NULL,
    `description` TEXT NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: subjects
-- =====================================================
CREATE TABLE IF NOT EXISTS `subjects` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `code` VARCHAR(20) NOT NULL,
    `class_id` BIGINT UNSIGNED NULL,
    `description` TEXT NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `subjects_code_unique` (`code`),
    INDEX `subjects_class_id_index` (`class_id`),
    CONSTRAINT `subjects_class_id_foreign`
        FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: students
-- =====================================================
CREATE TABLE IF NOT EXISTS `students` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NULL,
    `admission_no` VARCHAR(255) NOT NULL,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `gender` ENUM('male', 'female', 'other') NOT NULL,
    `dob` DATE NOT NULL,
    `phone` VARCHAR(20) NOT NULL,
    `email` VARCHAR(255) NULL,
    `address` TEXT NULL,
    `guardian_name` VARCHAR(255) NOT NULL,
    `guardian_phone` VARCHAR(20) NOT NULL,
    `class_id` BIGINT UNSIGNED NULL,
    `section` VARCHAR(10) NULL,
    `roll_no` VARCHAR(20) NULL,
    `status` ENUM('active', 'inactive', 'graduated', 'transferred') NOT NULL DEFAULT 'active',
    `photo` VARCHAR(255) NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `students_admission_no_unique` (`admission_no`),
    INDEX `students_user_id_index` (`user_id`),
    INDEX `students_class_id_index` (`class_id`),
    CONSTRAINT `students_user_id_foreign`
        FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
    CONSTRAINT `students_class_id_foreign`
        FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: teachers
-- =====================================================
CREATE TABLE IF NOT EXISTS `teachers` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NULL,
    `employee_id` VARCHAR(255) NOT NULL,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `gender` ENUM('male', 'female', 'other') NOT NULL,
    `dob` DATE NOT NULL,
    `phone` VARCHAR(20) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `address` TEXT NULL,
    `qualification` VARCHAR(255) NOT NULL,
    `experience` DECIMAL(4, 1) NULL DEFAULT 0,
    `subject_id` BIGINT UNSIGNED NULL,
    `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    `photo` VARCHAR(255) NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `teachers_employee_id_unique` (`employee_id`),
    UNIQUE KEY `teachers_email_unique` (`email`),
    INDEX `teachers_user_id_index` (`user_id`),
    INDEX `teachers_subject_id_index` (`subject_id`),
    CONSTRAINT `teachers_user_id_foreign`
        FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
    CONSTRAINT `teachers_subject_id_foreign`
        FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: enrollments
-- =====================================================
CREATE TABLE IF NOT EXISTS `enrollments` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `student_id` BIGINT UNSIGNED NOT NULL,
    `class_id` BIGINT UNSIGNED NOT NULL,
    `academic_year` VARCHAR(20) NOT NULL,
    `status` ENUM('active', 'inactive', 'graduated', 'transferred') NOT NULL DEFAULT 'active',
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    INDEX `enrollments_student_id_index` (`student_id`),
    INDEX `enrollments_class_id_index` (`class_id`),
    CONSTRAINT `enrollments_student_id_foreign`
        FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
    CONSTRAINT `enrollments_class_id_foreign`
        FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: attendance
-- =====================================================
CREATE TABLE IF NOT EXISTS `attendance` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `student_id` BIGINT UNSIGNED NOT NULL,
    `class_id` BIGINT UNSIGNED NOT NULL,
    `date` DATE NOT NULL,
    `status` ENUM('present', 'absent', 'late', 'holiday') NOT NULL,
    `remark` TEXT NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `attendance_student_class_date_unique` (`student_id`, `class_id`, `date`),
    INDEX `attendance_class_id_index` (`class_id`),
    CONSTRAINT `attendance_student_id_foreign`
        FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
    CONSTRAINT `attendance_class_id_foreign`
        FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: exam_types
-- =====================================================
CREATE TABLE IF NOT EXISTS `exam_types` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: exams
-- =====================================================
CREATE TABLE IF NOT EXISTS `exams` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `exam_type_id` BIGINT UNSIGNED NOT NULL,
    `class_id` BIGINT UNSIGNED NOT NULL,
    `subject_id` BIGINT UNSIGNED NOT NULL,
    `date` DATE NOT NULL,
    `total_marks` DECIMAL(6, 2) NOT NULL,
    `passing_marks` DECIMAL(6, 2) NOT NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    INDEX `exams_exam_type_id_index` (`exam_type_id`),
    INDEX `exams_class_id_index` (`class_id`),
    INDEX `exams_subject_id_index` (`subject_id`),
    CONSTRAINT `exams_exam_type_id_foreign`
        FOREIGN KEY (`exam_type_id`) REFERENCES `exam_types` (`id`) ON DELETE CASCADE,
    CONSTRAINT `exams_class_id_foreign`
        FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
    CONSTRAINT `exams_subject_id_foreign`
        FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: results
-- =====================================================
CREATE TABLE IF NOT EXISTS `results` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `student_id` BIGINT UNSIGNED NOT NULL,
    `exam_id` BIGINT UNSIGNED NOT NULL,
    `subject_id` BIGINT UNSIGNED NOT NULL,
    `marks_obtained` DECIMAL(6, 2) NOT NULL,
    `grade` VARCHAR(2) NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `results_student_exam_subject_unique` (`student_id`, `exam_id`, `subject_id`),
    INDEX `results_exam_id_index` (`exam_id`),
    INDEX `results_subject_id_index` (`subject_id`),
    CONSTRAINT `results_student_id_foreign`
        FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
    CONSTRAINT `results_exam_id_foreign`
        FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
    CONSTRAINT `results_subject_id_foreign`
        FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: fee_types
-- =====================================================
CREATE TABLE IF NOT EXISTS `fee_types` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `amount` DECIMAL(10, 2) NOT NULL,
    `description` TEXT NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE: fees
-- =====================================================
CREATE TABLE IF NOT EXISTS `fees` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `student_id` BIGINT UNSIGNED NOT NULL,
    `fee_type_id` BIGINT UNSIGNED NOT NULL,
    `amount` DECIMAL(10, 2) NOT NULL,
    `paid_amount` DECIMAL(10, 2) NOT NULL DEFAULT 0,
    `due_amount` DECIMAL(10, 2) NOT NULL DEFAULT 0,
    `payment_date` DATE NULL,
    `status` ENUM('paid', 'partial', 'unpaid') NOT NULL DEFAULT 'unpaid',
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    INDEX `fees_student_id_index` (`student_id`),
    INDEX `fees_fee_type_id_index` (`fee_type_id`),
    CONSTRAINT `fees_student_id_foreign`
        FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fees_fee_type_id_foreign`
        FOREIGN KEY (`fee_type_id`) REFERENCES `fee_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;

-- =====================================================
-- SAMPLE DATA (Initial Seed for new installations)
-- =====================================================

-- Default Admin User (Password: password)
INSERT INTO `users` (`name`, `email`, `password`, `role`, `status`, `phone`, `created_at`, `updated_at`) VALUES
('Admin EMIS', 'admin@emis.local', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'active', '9800000000', NOW(), NOW());

-- Sample Classes
INSERT INTO `classes` (`name`, `numeric_name`, `section`, `description`, `created_at`, `updated_at`) VALUES
('Class One', 1, 'A', 'Class One Section A', NOW(), NOW()),
('Class Two', 2, 'A', 'Class Two Section A', NOW(), NOW()),
('Class Three', 3, 'A', 'Class Three Section A', NOW(), NOW()),
('Class Four', 4, 'A', 'Class Four Section A', NOW(), NOW()),
('Class Five', 5, 'A', 'Class Five Section A', NOW(), NOW()),
('Class Six', 6, 'A', 'Class Six Section A', NOW(), NOW()),
('Class Seven', 7, 'A', 'Class Seven Section A', NOW(), NOW()),
('Class Eight', 8, 'A', 'Class Eight Section A', NOW(), NOW()),
('Class Nine', 9, 'A', 'Class Nine Section A', NOW(), NOW()),
('Class Ten', 10, 'A', 'Class Ten Section A', NOW(), NOW());

-- Sample Subjects
INSERT INTO `subjects` (`name`, `code`, `class_id`, `description`, `created_at`, `updated_at`) VALUES
('Mathematics', 'SUB-001', 1, 'Mathematics subject', NOW(), NOW()),
('English', 'SUB-002', 2, 'English subject', NOW(), NOW()),
('Nepali', 'SUB-003', 3, 'Nepali subject', NOW(), NOW()),
('Science', 'SUB-004', 4, 'Science subject', NOW(), NOW()),
('Social Studies', 'SUB-005', 5, 'Social Studies subject', NOW(), NOW()),
('Computer', 'SUB-006', 6, 'Computer subject', NOW(), NOW()),
('Health & PE', 'SUB-007', 7, 'Health & Physical Education', NOW(), NOW()),
('Moral Education', 'SUB-008', 8, 'Moral Education subject', NOW(), NOW());

-- Sample Exam Types
INSERT INTO `exam_types` (`name`, `description`, `created_at`, `updated_at`) VALUES
('First Term', 'First Term examination', NOW(), NOW()),
('Second Term', 'Second Term examination', NOW(), NOW()),
('Third Term', 'Third Term examination', NOW(), NOW()),
('Final Exam', 'Final Year examination', NOW(), NOW()),
('Mid-Term', 'Mid-Term examination', NOW(), NOW()),
('Pre-Board', 'Pre-Board examination', NOW(), NOW());

-- Sample Fee Types
INSERT INTO `fee_types` (`name`, `amount`, `description`, `created_at`, `updated_at`) VALUES
('Tuition Fee', 5000.00, 'Monthly tuition fee', NOW(), NOW()),
('Admission Fee', 2000.00, 'One-time admission fee', NOW(), NOW()),
('Exam Fee', 1000.00, 'Examination fee', NOW(), NOW()),
('Library Fee', 500.00, 'Library access fee', NOW(), NOW()),
('Sports Fee', 300.00, 'Sports activities fee', NOW(), NOW()),
('Transport Fee', 1500.00, 'School transport fee', NOW(), NOW());

-- =====================================================
-- LOGIN CREDENTIALS
-- =====================================================
-- Email: admin@emis.local
-- Password: password
-- =====================================================