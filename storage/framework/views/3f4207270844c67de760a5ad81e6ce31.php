<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Password Reset - Food Delivery System</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <div style="background-color: #5c4ac7; color: white; padding: 20px; text-align: center; border-radius: 5px 5px 0 0;">
            <h2 style="margin: 0;">Password Reset Request</h2>
        </div>
        
        <div style="background-color: #f9f9f9; padding: 30px; border: 1px solid #ddd; border-top: none; border-radius: 0 0 5px 5px;">
            <p>Hello <?php echo e($user->f_name ?? $user->username); ?>,</p>
            
            <p>You requested to reset your password for your Food Delivery System account.</p>
            
            <div style="background-color: #fff; border: 2px dashed #5c4ac7; padding: 20px; text-align: center; margin: 20px 0; border-radius: 5px;">
                <p style="margin: 0; font-size: 12px; color: #666;">Your Password Reset Code:</p>
                <h1 style="margin: 10px 0; font-size: 36px; letter-spacing: 8px; color: #5c4ac7; font-family: 'Courier New', monospace;"><?php echo e($resetCode); ?></h1>
                <p style="margin: 0; font-size: 12px; color: #666;">This code will expire in 24 hours.</p>
            </div>
            
            <div style="background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 20px 0; border-radius: 4px;">
                <p style="margin: 0; font-weight: bold; color: #856404;">How to use this code:</p>
                <ol style="margin: 10px 0; padding-left: 20px; color: #856404;">
                    <li>Click the button below to go to the reset password page</li>
                    <li>Enter your email address: <strong><?php echo e($user->email); ?></strong></li>
                    <li>Enter the 6-digit code above: <strong><?php echo e($resetCode); ?></strong></li>
                    <li>Enter your new password</li>
                    <li>Click "Reset Password"</li>
                </ol>
            </div>
            
            <div style="text-align: center; margin: 30px 0;">
                <a href="<?php echo e($resetLink); ?>" style="background-color: #5c4ac7; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block; font-weight: bold;">Go to Reset Password Page</a>
            </div>
            
            <p style="font-size: 12px; color: #666; margin-top: 20px;">
                Or copy and paste this link in your browser:<br>
                <a href="<?php echo e($resetLink); ?>" style="color: #5c4ac7; word-break: break-all;"><?php echo e($resetLink); ?></a>
            </p>
            
            <p style="font-size: 12px; color: #666; margin-top: 30px;">
                If you did not request a password reset, please ignore this email or contact support if you have concerns.
            </p>
            
            <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 0;">
            
            <p style="font-size: 12px; color: #999; margin: 0;">
                This is an automated message from Food Delivery System. Please do not reply to this email.
            </p>
        </div>
    </div>
</body>
</html>

<?php /**PATH C:\Users\Owner\Desktop\Final Project - Food delivery\resources\views/emails/password-reset.blade.php ENDPATH**/ ?>