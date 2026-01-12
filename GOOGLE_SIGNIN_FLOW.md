# Google Sign-In API Flow Documentation

## 📋 Overview

Ang dokumentong ito ay nagpapaliwanag ng buong flow ng Google Sign-In API implementation sa Laravel application. Ginagamit nito ang Laravel Socialite package para sa OAuth 2.0 authentication.

---

## 🔧 Prerequisites

### Required Packages
- **Laravel Socialite** - Para sa OAuth authentication
- **Google OAuth Credentials** - Client ID at Client Secret mula sa Google Cloud Console

### Configuration Files
- `config/services.php` - Google OAuth configuration
- `.env` - Environment variables para sa credentials

---

## 🔄 Complete Flow Diagram

```
┌─────────────────────────────────────────────────────────────────┐
│  STEP 1: User clicks "Login with Google" button                 │
│  📁 File: resources/views/auth/login.blade.php                  │
│  📍 Line: 40                                                    │
│  Route: route('google.login')                                   │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 2: Route redirects to GoogleAuthController                │
│  📁 File: routes/web.php                                        │
│  📍 Line: 34                                                    │
│  Route::get('/auth/google', [GoogleAuthController::class,       │
│             'redirectToGoogle'])->name('google.login');         │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 3: redirectToGoogle() method                              │
│  📁 File: app/Http/Controllers/Auth/GoogleAuthController.php    │
│  📍 Line: 16-19                                                 │
│                                                                  │
│  return Socialite::driver('google')->redirect();                │
│                                                                  │
│  Ginagawa:                                                       │
│  - Gumagamit ng Socialite package                               │
│  - Nagre-redirect sa Google OAuth consent screen               │
│  - Nagpapadala ng authorization request sa Google                │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 4: User authenticates sa Google                           │
│  🌐 External: Google OAuth Server                                │
│  - User enters Google credentials                               │
│  - Google validates credentials                                 │
│  - User grants permissions                                      │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 5: Google redirects back with authorization code          │
│  🌐 Callback URL: /auth/google/callback                         │
│  - Google sends authorization code                              │
│  - Redirects sa callback route                                  │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 6: Route handles callback                                 │
│  📁 File: routes/web.php                                        │
│  📍 Line: 35                                                    │
│  Route::get('/auth/google/callback', [GoogleAuthController::    │
│             class, 'handleGoogleCallback'])->name('google.      │
│             callback');                                         │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 7: handleGoogleCallback() method                          │
│  📁 File: app/Http/Controllers/Auth/GoogleAuthController.php    │
│  📍 Line: 24-76                                                 │
│                                                                  │
│  Process:                                                        │
│  1. Get user data from Google (line 27)                         │
│  2. Check if user exists by email (line 30)                     │
│  3. If exists: Update login_method & login (lines 32-36)        │
│  4. If new: Create new user (lines 38-66)                       │
│  5. Login user (line 36 or 68)                                  │
│  6. Redirect to home (line 71)                                  │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│  STEP 8: User is logged in and redirected                       │
│  🏠 Redirect: redirect()->intended('/')                         │
│  - User is authenticated                                        │
│  - Session is created                                           │
│  - User can access protected routes                             │
└─────────────────────────────────────────────────────────────────┘
```

---

## 📝 Step-by-Step Explanation

### **STEP 1: User Initiates Login**

**Location:** `resources/views/auth/login.blade.php` (Line 40)

```blade
<a href="{{ route('google.login') }}" ...>
    Login with Google
</a>
```

**What happens:**
- User clicks the "Login with Google" button
- Browser navigates to `/auth/google` route

---

### **STEP 2: Route Definition**

**Location:** `routes/web.php` (Line 34)

```php
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])
    ->name('google.login');
```

**What happens:**
- Route matches the `/auth/google` URL
- Calls `GoogleAuthController::redirectToGoogle()` method

---

### **STEP 3: Redirect to Google**

**Location:** `app/Http/Controllers/Auth/GoogleAuthController.php` (Lines 16-19)

```php
public function redirectToGoogle()
{
    return Socialite::driver('google')->redirect();
}
```

**What happens:**
1. **Socialite::driver('google')** - Initializes Google OAuth provider
2. **->redirect()** - Generates authorization URL and redirects user
3. User is sent to Google's OAuth consent screen

**Technical Details:**
- Socialite builds OAuth 2.0 authorization URL
- Includes: `client_id`, `redirect_uri`, `response_type=code`, `scope`, `state`
- Example URL: `https://accounts.google.com/o/oauth2/auth?client_id=...&redirect_uri=...`

---

### **STEP 4: Google Authentication**

**Location:** External (Google OAuth Server)

**What happens:**
1. User sees Google login page
2. User enters Google credentials
3. Google validates credentials
4. User grants permissions (email, profile)
5. Google generates authorization code

---

### **STEP 5: Google Callback**

**Location:** Google redirects to callback URL

**Callback URL:** `{APP_URL}/auth/google/callback`

**What happens:**
- Google redirects back to your application
- Includes authorization code in query string
- Example: `/auth/google/callback?code=4/0A...&state=...`

---

### **STEP 6: Callback Route**

**Location:** `routes/web.php` (Line 35)

```php
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])
    ->name('google.callback');
```

**What happens:**
- Route matches `/auth/google/callback`
- Calls `handleGoogleCallback()` method

---

### **STEP 7: Process Callback (Main Logic)**

**Location:** `app/Http/Controllers/Auth/GoogleAuthController.php` (Lines 24-76)

#### **7.1 Get User Data from Google**

```php
$googleUser = Socialite::driver('google')->user();
```

**What happens:**
1. Socialite exchanges authorization code for access token
2. Uses access token to fetch user info from Google API
3. Returns user object with: `id`, `name`, `email`, `avatar`, etc.

**Google API Call:**
```
GET https://www.googleapis.com/oauth2/v3/userinfo
Headers: Authorization: Bearer {access_token}
```

#### **7.2 Check if User Exists**

```php
$user = User::where('email', $googleUser->getEmail())->first();
```

**What happens:**
- Searches database for existing user with same email
- Returns User model if found, `null` if not

#### **7.3 Existing User Flow**

```php
if ($user) {
    $user->login_method = 'google';
    $user->save();
    Auth::login($user);
}
```

**What happens:**
1. Updates `login_method` to 'google'
2. Logs in the existing user
3. Creates Laravel session

#### **7.4 New User Flow**

```php
else {
    // Parse name
    $name = $googleUser->getName();
    $nameParts = explode(' ', $name, 2);
    $firstName = $nameParts[0] ?? '';
    $lastName = $nameParts[1] ?? '';
    
    // Generate unique username
    $email = $googleUser->getEmail();
    $username = explode('@', $email)[0];
    
    // Ensure uniqueness
    while (User::where('username', $username)->exists()) {
        $username = $originalUsername . '_' . $counter;
        $counter++;
    }
    
    // Create user
    $user = User::create([
        'username' => $username,
        'f_name' => $firstName,
        'l_name' => $lastName,
        'email' => $email,
        'phone' => '',
        'password' => bcrypt(Str::random(16)),
        'address' => '',
        'status' => 1,
        'login_method' => 'google',
    ]);
    
    Auth::login($user);
}
```

**What happens:**
1. **Parse Name:** Splits full name into first and last name
2. **Generate Username:** Uses email prefix (before @)
3. **Ensure Uniqueness:** Checks if username exists, appends number if needed
4. **Create User:** Inserts new user record in database
5. **Login:** Authenticates the new user

**Database INSERT:**
```sql
INSERT INTO users (username, f_name, l_name, email, phone, password, address, status, login_method)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'google');
```

#### **7.5 Redirect After Login**

```php
return redirect()->intended('/');
```

**What happens:**
- Redirects to intended URL (or home page)
- User is now authenticated and can access protected routes

#### **7.6 Error Handling**

```php
catch (\Exception $e) {
    return redirect()->route('login')
        ->with('error', 'Unable to login with Google. Please try again.');
}
```

**What happens:**
- Catches any exceptions during the process
- Redirects back to login page with error message
- Common errors: Invalid credentials, network issues, OAuth errors

---

## ⚙️ Configuration

### **1. Google Cloud Console Setup**

**Required:**
- OAuth 2.0 Client ID
- OAuth 2.0 Client Secret
- Authorized redirect URIs

**Redirect URIs to add:**
- `http://localhost/auth/google/callback` (local)
- `https://yourdomain.com/auth/google/callback` (production)

### **2. Environment Variables (.env)**

```env
GOOGLE_CLIENT_ID=your_client_id_here
GOOGLE_CLIENT_SECRET=your_client_secret_here
APP_URL=http://localhost
```

### **3. Services Configuration**

**Location:** `config/services.php` (Lines 38-42)

```php
'google' => [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect' => env('APP_URL') . '/auth/google/callback',
],
```

**What this does:**
- Loads credentials from `.env` file
- Sets callback URL dynamically based on `APP_URL`

---

## 🗄️ Database Operations

### **User Table Structure**

**Fields used:**
- `username` - Unique username (generated from email)
- `f_name` - First name (from Google profile)
- `l_name` - Last name (from Google profile)
- `email` - Email address (from Google account)
- `phone` - Phone number (empty for Google users)
- `password` - Random hashed password (not used for Google login)
- `address` - Address (empty, can be updated later)
- `status` - Account status (1 = active)
- `login_method` - Authentication method ('google' or 'email')

### **User Creation Flow**

```
Google User Data
    ↓
Parse & Validate
    ↓
Check Uniqueness
    ↓
Create Database Record
    ↓
Login User
```

---

## 🔐 Security Considerations

### **1. OAuth 2.0 Flow**
- Uses secure authorization code flow
- Access tokens are handled by Socialite (not exposed)
- State parameter prevents CSRF attacks

### **2. Email Uniqueness**
- Email is used as unique identifier
- Prevents duplicate accounts with same email

### **3. Username Uniqueness**
- Ensures unique usernames even if email prefix is taken
- Appends counter if conflict exists

### **4. Password Handling**
- Google users get random password (not used)
- Password field required by database schema
- Users can't login with password (must use Google)

---

## 📊 Data Flow Summary

```
User Click
    ↓
Laravel Route
    ↓
Socialite Redirect
    ↓
Google OAuth Server
    ↓
User Authentication
    ↓
Authorization Code
    ↓
Callback Route
    ↓
Exchange Code for Token
    ↓
Get User Info from Google
    ↓
Check/Create User in Database
    ↓
Laravel Auth Login
    ↓
Redirect to Home
```

---

## 🐛 Common Issues & Solutions

### **Issue 1: "Redirect URI mismatch"**
**Solution:** Ensure callback URL in Google Console matches exactly with `config/services.php`

### **Issue 2: "Invalid client"**
**Solution:** Check `GOOGLE_CLIENT_ID` and `GOOGLE_CLIENT_SECRET` in `.env`

### **Issue 3: "User creation fails"**
**Solution:** Check database schema, ensure all required fields are present

### **Issue 4: "Username already exists"**
**Solution:** Code handles this automatically by appending numbers

---

## 📚 Related Files

| File | Purpose |
|------|---------|
| `app/Http/Controllers/Auth/GoogleAuthController.php` | Main controller logic |
| `routes/web.php` | Route definitions |
| `config/services.php` | OAuth configuration |
| `resources/views/auth/login.blade.php` | Login button UI |
| `app/Models/User.php` | User model |
| `.env` | Environment variables |

---

## 🔗 API Endpoints Used

### **Google OAuth Endpoints:**
1. **Authorization:** `https://accounts.google.com/o/oauth2/auth`
2. **Token Exchange:** `https://www.googleapis.com/oauth2/v4/token`
3. **User Info:** `https://www.googleapis.com/oauth2/v3/userinfo`

### **Application Endpoints:**
1. **Initiate Login:** `GET /auth/google`
2. **Callback:** `GET /auth/google/callback`

---

## ✅ Testing Checklist

- [ ] Google OAuth credentials configured
- [ ] Redirect URI matches in Google Console
- [ ] `.env` file has correct credentials
- [ ] Socialite package installed
- [ ] New user creation works
- [ ] Existing user login works
- [ ] Error handling works
- [ ] Session persists after login
- [ ] Protected routes accessible after login

---

## 📖 Additional Resources

- [Laravel Socialite Documentation](https://laravel.com/docs/socialite)
- [Google OAuth 2.0 Documentation](https://developers.google.com/identity/protocols/oauth2)
- [OAuth 2.0 Flow Explanation](https://oauth.net/2/)

---

**Last Updated:** 2024
**Version:** 1.0

