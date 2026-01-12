# Gmail SMTP Setup Guide

This guide will help you configure Gmail SMTP for sending password reset emails.

## Step 1: Generate Gmail App Password

1. **Go to your Google Account**: https://myaccount.google.com/
2. **Enable 2-Step Verification** (if not already enabled):
   - Go to **Security** > **2-Step Verification**
   - Follow the steps to enable it
3. **Create App Password**:
   - Go to **Security** > **2-Step Verification**
   - Scroll down and click **App passwords**
   - Select **Mail** as the app
   - Select **Other (Custom name)** as device
   - Enter "Food Delivery App" as the name
   - Click **Generate**
   - **Copy the 16-character password** (you'll need this!)

## Step 2: Update .env File

Add these settings to your `.env` file:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-16-character-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

**Important:**
- Replace `your-email@gmail.com` with your actual Gmail address
- Replace `your-16-character-app-password` with the App Password you generated in Step 1
- The App Password is 16 characters (no spaces, no dashes)

## Step 3: Clear Configuration Cache

After updating `.env`, run:

```bash
php artisan config:clear
php artisan config:cache
```

## Step 4: Test the Email

1. Go to your login page: `http://localhost:8000/login`
2. Click **"Forgot Password?"**
3. Enter a registered email address
4. Click **"Send Reset Code"**
5. Check the email inbox for the reset code

## Troubleshooting

### "Authentication failed" error
- Make sure you're using the **App Password**, not your regular Gmail password
- Verify 2-Step Verification is enabled
- Check that the App Password is correct (no spaces, all 16 characters)

### "Connection refused" error
- Check your internet connection
- Verify port 587 is not blocked by firewall
- Try using port 465 with `MAIL_ENCRYPTION=ssl` instead

### Email not received
- Check spam/junk folder
- Verify the email address is correct
- Wait a few minutes (Gmail may have delays)
- Check if you hit the daily limit (500 emails/day for free Gmail)

### "Less secure app access" error
- This is outdated - use App Passwords instead (Step 1)

## Gmail Daily Limits

- **Free Gmail**: 500 emails per day
- **Google Workspace**: 2,000 emails per day

If you need to send more emails, consider using:
- Mailgun
- SendGrid
- Amazon SES
- Mailtrap (for production)

## Security Notes

- Never commit your `.env` file` to version control
- Keep your App Password secure
- Don't share your App Password
- If compromised, revoke and regenerate the App Password