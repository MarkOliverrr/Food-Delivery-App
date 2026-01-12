# PAANO I-RUN ANG LARAVEL FOOD DELIVERY SYSTEM

## ✅ Database Structure - OK NA!

Lahat ng database tables ay ready na:
- ✅ admins
- ✅ res_categories  
- ✅ restaurants
- ✅ dishes
- ✅ users
- ✅ users_orders
- ✅ remarks

## STEP-BY-STEP SETUP

### STEP 1: Install Composer Dependencies

```bash
composer install
```

### STEP 2: Create .env File

Kung wala pa `.env` file, copy from example:

**Windows PowerShell:**
```powershell
copy .env.example .env
```

**Or manually create `.env` file** at lagay ang database settings:

```env
APP_NAME="Food Delivery System"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=code_camp_bd_fos
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
```

### STEP 3: Generate Application Key

```bash
php artisan key:generate
```

### STEP 4: Create Database

Gumawa ng database sa MySQL:
- Database name: `code_camp_bd_fos`

### STEP 5: Run Migrations (Gumawa ng Tables)

```bash
php artisan migrate
```

Ito ang gagawa ng lahat ng tables sa database mo.

### STEP 6: Seed Admin User

```bash
php artisan db:seed
```

Ito ang gagawa ng admin user:
- Username: `ccbd`
- Password: `ccbd123`

### STEP 7: Copy Assets

**IMPORTANTE:** Copy mo ang existing assets:

1. Copy `css/` folder → `public/css/`
2. Copy `js/` folder → `public/js/`
3. Copy `images/` folder → `public/images/`
4. Copy `admin/` folder contents → `public/admin/`

**Windows PowerShell commands:**
```powershell
xcopy css public\css\ /E /I /Y
xcopy js public\js\ /E /I /Y
xcopy images public\images\ /E /I /Y
xcopy admin public\admin\ /E /I /Y
```

### STEP 8: Start Laravel Server

```bash
php artisan serve
```

Bubukas ang application sa: **http://localhost:8000**

## ACCESS POINTS:

1. **Frontend (User):** http://localhost:8000
2. **Admin Login:** http://localhost:8000/admin/login
   - Username: `ccbd`
   - Password: `ccbd123`

## TROUBLESHOOTING:

### Kung may error sa database:
```bash
php artisan migrate:fresh
php artisan db:seed
```

### Kung may error sa cache:
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Kung wala pa MySQL:
I-install mo muna ang XAMPP o WAMP para sa MySQL.

## READY NA! 🎉

Pagkatapos ng lahat ng steps, ready na ang application!

