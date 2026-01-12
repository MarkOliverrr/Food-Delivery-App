@echo off
echo ============================================
echo Laravel Food Delivery System - Quick Start
echo ============================================
echo.

echo [1/6] Installing Composer dependencies...
call composer install
if errorlevel 1 (
    echo ERROR: Composer install failed!
    pause
    exit /b 1
)
echo.

echo [2/6] Generating application key...
call php artisan key:generate
if errorlevel 1 (
    echo ERROR: Key generation failed!
    pause
    exit /b 1
)
echo.

echo [3/6] Checking database...
echo Please make sure MySQL is running and database 'code_camp_bd_fos' exists!
echo.
pause

echo [4/6] Running migrations (creating tables)...
call php artisan migrate
if errorlevel 1 (
    echo ERROR: Migration failed! Check your database connection in .env file
    pause
    exit /b 1
)
echo.

echo [5/6] Seeding admin user...
call php artisan db:seed
if errorlevel 1 (
    echo ERROR: Seeding failed!
    pause
    exit /b 1
)
echo.

echo [6/6] Copying assets...
if not exist "public\css" mkdir public\css
if not exist "public\js" mkdir public\js
if not exist "public\images" mkdir public\images
if not exist "public\admin" mkdir public\admin

xcopy /E /I /Y css public\css\ >nul 2>&1
xcopy /E /I /Y js public\js\ >nul 2>&1
xcopy /E /I /Y images public\images\ >nul 2>&1
xcopy /E /I /Y admin public\admin\ >nul 2>&1
echo Assets copied!
echo.

echo ============================================
echo SETUP COMPLETE!
echo ============================================
echo.
echo To start the server, run: php artisan serve
echo.
echo Admin Login:
echo - URL: http://localhost:8000/admin/login
echo - Username: ccbd
echo - Password: ccbd123
echo.
pause

