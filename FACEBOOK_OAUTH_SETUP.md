# Facebook OAuth Setup Instructions

This guide will help you set up Facebook OAuth login for your application.

## Step 1: Create Facebook App

1. Go to [Facebook Developers](https://developers.facebook.com/)
2. Click **My Apps** > **Create App**
3. Choose **Consumer** as app type
4. Fill in app details:
   - **App Name:** Your app name (e.g., "Food Delivery App")
   - **App Contact Email:** Your email address
   - Click **Create App**

## Step 2: Configure Facebook Login

1. In your app dashboard, click **Add Product**
2. Find **Facebook Login** and click **Set Up**
3. Choose **Web** platform
4. Enter your site URL:
   - For local: `http://localhost:8000`
   - For production: `https://yourdomain.com`
5. Click **Save**

## Step 3: Configure OAuth Settings

1. Go to **Settings** > **Basic** in your app dashboard
2. Note your **App ID** and **App Secret**
3. Click **Settings** in the left menu > **Facebook Login** > **Settings**
4. Under **Valid OAuth Redirect URIs**, add:
   - `http://localhost:8000/auth/facebook/callback` (for local)
   - `https://yourdomain.com/auth/facebook/callback` (for production)
5. Click **Save Changes**

## Step 4: Configure Environment Variables

Add the following to your `.env` file:

```env
FACEBOOK_CLIENT_ID=your_facebook_app_id
FACEBOOK_CLIENT_SECRET=your_facebook_app_secret
APP_URL=http://localhost:8000
```

**Important Notes:**
- Replace `FACEBOOK_CLIENT_ID` with your App ID from Step 3
- Replace `FACEBOOK_CLIENT_SECRET` with your App Secret from Step 3
- Replace `APP_URL` with your actual application URL:
  - For local development: `http://localhost:8000` or `http://localhost`
  - For production: `https://yourdomain.com`
- The redirect URI will be automatically generated as `{APP_URL}/auth/facebook/callback`
- Make sure the redirect URI matches exactly what you configured in Facebook App

## Step 5: Set App Public (for testing)

1. Go to **App Review** > **Permissions and Features**
2. Make sure **email** permission is enabled
3. Make your app **Public** (for development/testing):
   - Go to **Settings** > **Basic**
   - Click **Edit** next to **App Mode**
   - Switch to **Live** mode
   - Note: You'll need to add test users first

## Step 6: Add Test Users (for development)

1. Go to **Roles** > **Test Users**
2. Click **Add Test Users**
3. Create test users with email/password
4. These users can login without app review

## Step 7: Clear Configuration Cache

After updating your `.env` file, run:

```bash
php artisan config:clear
php artisan cache:clear
```

## Step 8: Test the Integration

1. Visit your login page: `http://localhost:8000/login`
2. Click the "Login with Facebook" button
3. You should be redirected to Facebook's login page
4. After logging in, you'll be redirected back to your application

## Troubleshooting

### Error: "Invalid OAuth access token"
- Make sure your `FACEBOOK_CLIENT_ID` and `FACEBOOK_CLIENT_SECRET` are correct
- Clear your config cache: `php artisan config:clear`
- Verify your redirect URI matches exactly

### Error: "Redirect URI mismatch"
- Ensure the redirect URI in your `.env` file matches exactly what's configured in Facebook App
- Check for trailing slashes - they must match exactly
- Make sure you're using `http://` for local and `https://` for production

### Error: "App Not Setup"
- Make sure Facebook Login product is added to your app
- Verify your app is in Live mode or you're using a test user
- Check that email permission is requested

### Error: "Email permission required"
- Make sure your app requests email permission
- Users need to grant email permission on first login
- Check Facebook Login settings for required permissions

## Security Notes

- Never commit your `.env` file to version control
- Keep your App Secret secure
- Use HTTPS in production
- Regularly review and rotate your OAuth credentials
- For production, you'll need to submit your app for review if you want public access

## Differences from Google OAuth

- Facebook requires app review for production use
- You need to explicitly request email permission
- Test users are required for development
- Facebook apps start in "Development" mode by default

