# Laravel Food Delivery System - Setup Guide

This project has been converted from PHP to Laravel 10 with Bootstrap.

## Prerequisites

- PHP >= 8.1
- Composer
- MySQL
- Node.js and NPM (optional, for asset compilation)

## Installation Steps

### 1. Install Dependencies

```bash
composer install
```

### 2. Environment Configuration

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Or on Windows:
```powershell
copy .env.example .env
```

Edit `.env` file and configure your database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=code_camp_bd_fos
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Generate Application Key

```bash
php artisan key:generate
```

### 4. Run Migrations

```bash
php artisan migrate
```

### 5. Seed Admin User

```bash
php artisan db:seed
```

This will create an admin user:
- Username: `ccbd`
- Password: `ccbd123`

### 6. Link Storage for Images

```bash
php artisan storage:link
```

### 7. Copy Assets

Copy your existing assets (CSS, JS, images) to the `public` directory:

- Copy `css/` folder to `public/css/`
- Copy `js/` folder to `public/js/`
- Copy `images/` folder to `public/images/`
- Copy `admin/` folder contents to `public/admin/`

### 8. Start Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Admin Panel

Access the admin panel at: `http://localhost:8000/admin/login`

Default credentials:
- Username: `ccbd`
- Password: `ccbd123`

## Key Changes from Original PHP

1. **MVC Architecture**: All code is organized into Models, Views, and Controllers
2. **Eloquent ORM**: Database queries use Eloquent instead of raw SQL
3. **Blade Templates**: Views use Blade templating engine
4. **Laravel Authentication**: Uses Laravel's built-in auth system
5. **Routes**: All routes are defined in `routes/web.php`
6. **Session Management**: Cart uses Laravel session instead of PHP sessions
7. **Middleware**: Admin routes protected with middleware

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/         # Admin controllers
│   │   └── Auth/          # Authentication controllers
│   └── Middleware/        # Custom middleware
├── Models/                # Eloquent models
database/
├── migrations/            # Database migrations
└── seeders/               # Database seeders
resources/
└── views/                 # Blade templates
    ├── layouts/           # Layout files
    ├── auth/              # Authentication views
    ├── admin/              # Admin views
    └── ...                # Frontend views
routes/
└── web.php                # Web routes
public/                    # Public assets
```

## Features

- User registration and login
- Restaurant browsing
- Dish/menu viewing
- Shopping cart
- Order placement
- Order tracking
- Admin dashboard
- Restaurant management
- Category management
- Menu/Dish management
- Order management
- User management

## Notes

- Ensure your database is set up before running migrations
- Admin passwords are hashed using Laravel's Hash facade
- Images should be stored in `storage/app/public/` and linked to `public/storage`
- All existing images from `admin/Res_img/` should be copied to `public/admin/Res_img/`

## Troubleshooting

If you encounter issues:

1. Clear config cache: `php artisan config:clear`
2. Clear route cache: `php artisan route:clear`
3. Clear view cache: `php artisan view:clear`
4. Check file permissions on `storage/` and `bootstrap/cache/`

