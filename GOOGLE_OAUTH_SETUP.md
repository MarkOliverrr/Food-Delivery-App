# Google OAuth Setup Instructions

This guide will help you set up Google OAuth login for your application.

## Step 1: Create Google OAuth Credentials

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select an existing one
3. Navigate to **APIs & Services** > **Credentials**
4. Click **Create Credentials** > **OAuth client ID**
5. If prompted, configure the OAuth consent screen:
   - Choose **External** (unless you have a Google Workspace)
   - Fill in the required information (App name, User support email, Developer contact)
   - Add scopes: `email` and `profile`
   - Add test users if needed (for development)
6. Create OAuth client ID:
   - Application type: **Web application**
   - Name: Your app name (e.g., "Food Delivery App")
   - Authorized JavaScript origins: 
     - `http://localhost` (for local development)
     - `http://localhost:8000` (if using Laravel's built-in server)
     - Your production domain (e.g., `https://yourdomain.com`)
   - Authorized redirect URIs:
     - `http://localhost/auth/google/callback` (for local development)
     - `http://localhost:8000/auth/google/callback` (if using Laravel's built-in server)
     - `https://yourdomain.com/auth/google/callback` (for production)
7. Click **Create**
8. Copy the **Client ID** and **Client Secret**

## Step 2: Configure Environment Variables

Add the following to your `.env` file:

```env
GOOGLE_CLIENT_ID=your_client_id_here
GOOGLE_CLIENT_SECRET=your_client_secret_here
APP_URL=http://localhost:8000
```

**Important Notes:**
- Replace `APP_URL` with your actual application URL:
  - For local development: `http://localhost:8000` or `http://localhost`
  - For production: `https://yourdomain.com`
- The redirect URI will be automatically generated as `{APP_URL}/auth/google/callback`
- Make sure the redirect URI matches exactly what you configured in Google Cloud Console

## Step 3: Clear Configuration Cache

After updating your `.env` file, run:

```bash
php artisan config:clear
php artisan cache:clear
```

## Step 4: Test the Integration

1. Visit your login page: `http://localhost/login`
2. Click the "Login with Google" button
3. You should be redirected to Google's login page
4. After logging in, you'll be redirected back to your application

## Troubleshooting

### Error: "Invalid client"
- Make sure your `GOOGLE_CLIENT_ID` and `GOOGLE_CLIENT_SECRET` are correct
- Clear your config cache: `php artisan config:clear`

### Error: "Redirect URI mismatch"
- Ensure the redirect URI in your `.env` file matches exactly what's configured in Google Cloud Console
- Check for trailing slashes - they must match exactly
- Make sure you're using `http://` for local and `https://` for production

### Error: "Access blocked"
- Check your OAuth consent screen configuration
- If in testing mode, make sure the user's email is added as a test user
- For production, your app needs to be verified by Google

## Security Notes

- Never commit your `.env` file to version control
- Keep your Client Secret secure
- Use HTTPS in production
- Regularly review and rotate your OAuth credentials

