@echo off
title EMIS - Auto Installer
color 0B
echo ==========================================================
echo    EMIS - Education Management Information System
echo    One-Click Installer for Windows (XAMPP)
echo ==========================================================
echo.
cd /d "%~dp0"

REM ----------------------------------------------------------
REM STEP 1: Check PHP
REM ----------------------------------------------------------
where php >nul 2>nul
if %errorlevel% neq 0 (
    echo [ERROR] PHP not found in PATH!
    echo.
    echo Fix: Add PHP to your PATH:
    echo   1. Search "Edit environment variables" in Windows
    echo   2. System variables - Path - Edit - New
    echo   3. Add this line: C:\xampp\php
    echo   4. Click OK and CLOSE this window, then run me again.
    echo.
    pause
    exit /b 1
)
echo [OK] PHP found:
php -v | findstr /b "PHP"
echo.

REM ----------------------------------------------------------
REM STEP 2: Check Composer
REM ----------------------------------------------------------
where composer >nul 2>nul
if %errorlevel% neq 0 (
    echo [ERROR] Composer not found!
    echo.
    echo Opening Composer download page in your browser...
    echo Download "Composer-Setup.exe" and install it.
    echo Then CLOSE this window and run this installer again.
    echo.
    start https://getcomposer.org/download/
    pause
    exit /b 1
)
echo [OK] Composer found
echo.

REM ----------------------------------------------------------
REM STEP 3: Install Laravel dependencies (vendor folder)
REM ----------------------------------------------------------
if not exist "vendor\autoload.php" (
    echo [STEP] Installing Laravel dependencies... (2-5 minutes)
    echo        Please wait, do not close this window...
    echo.
    call composer install --no-interaction --no-progress
    if %errorlevel% neq 0 (
        echo.
        echo [ERROR] composer install failed!
        echo Check your internet connection and try again.
        pause
        exit /b 1
    )
    echo.
    echo [OK] Dependencies installed successfully!
) else (
    echo [OK] Dependencies already installed (vendor folder found)
)
echo.

REM ----------------------------------------------------------
REM STEP 4: Create .env file
REM ----------------------------------------------------------
if not exist ".env" (
    echo [STEP] Creating .env file...
    copy ".env.example" ".env" >nul
    echo [OK] .env file created
    echo.
    echo IMPORTANT: Now open the ".env" file and set your database:
    echo     DB_DATABASE=emis
    echo     DB_USERNAME=root
    echo     DB_PASSWORD=your_password
    echo.
) else (
    echo [OK] .env file already exists
)
echo.

REM ----------------------------------------------------------
REM STEP 5: Fix storage folder permissions
REM ----------------------------------------------------------
echo [STEP] Fixing storage folder permissions...
if not exist "storage\framework\cache\data" mkdir "storage\framework\cache\data"
if not exist "storage\framework\sessions" mkdir "storage\framework\sessions"
if not exist "storage\framework\views" mkdir "storage\framework\views"
if not exist "storage\logs" mkdir "storage\logs"
if not exist "storage\app\public" mkdir "storage\app\public"
if not exist "public\uploads\students" mkdir "public\uploads\students"
if not exist "public\uploads\teachers" mkdir "public\uploads\teachers"

attrib -r -s -h "storage" /s /d >nul 2>nul
attrib -r -s -h "public" /s /d >nul 2>nul
icacls "storage" /grant *S-1-1-0:(OI)(CI)F /T /Q >nul 2>nul
icacls "public\uploads" /grant *S-1-1-0:(OI)(CI)F /T /Q >nul 2>nul
icacls "bootstrap\cache" /grant *S-1-1-0:(OI)(CI)F /T /Q >nul 2>nul
echo [OK] Storage permissions fixed
echo.

REM ----------------------------------------------------------
REM DONE
REM ----------------------------------------------------------
echo ==========================================================
echo    INSTALLATION COMPLETE!
echo ==========================================================
echo.
echo Your NEXT STEPS:
echo.
echo  1. Create a database named "emis" in phpMyAdmin
echo     (http://localhost/phpmyadmin - New - emis - Create)
echo.
echo  2. Import the tables:
echo     phpMyAdmin - click "emis" - Import tab -
echo     choose file: database\emis.sql - Go
echo.
echo  3. Make sure Apache is RUNNING in XAMPP Control Panel
echo.
echo  4. Open your browser and go to:
echo     http://localhost/emis
echo.
echo     Login: admin@emis.local   Password: password
echo.
pause
