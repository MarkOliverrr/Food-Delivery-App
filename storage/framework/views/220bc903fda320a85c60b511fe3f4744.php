

<?php $__env->startSection('title', 'Reset Password'); ?>

<?php $__env->startSection('content'); ?>
<div style="min-height: 100vh; padding: 100px 0; background: url('<?php echo e(asset('images/img/pimg.jpg')); ?>') center center / cover no-repeat fixed;">
    <div class="pen-title"></div>
    <div class="module form-module">
        <div class="toggle"></div>
        <div class="form">
            <h2>Reset Password</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 20px;">Enter the 6-digit code sent to your email and your new password.</p>
            
            <div style="background-color: #e7f3ff; border-left: 4px solid #5c4ac7; padding: 12px; margin-bottom: 20px; border-radius: 4px;">
                <p style="margin: 0; font-size: 13px; color: #004085;">
                    <strong>📧 Check your email</strong> for the 6-digit reset code. Enter it in the field below.
                </p>
            </div>
            
            <?php if(session('status')): ?>
                <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #c3e6cb;">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>
            
            <?php if($errors->any()): ?>
                <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #f5c6cb;">
                    <?php echo e($errors->first()); ?>

                </div>
            <?php endif; ?>
            
            <form action="<?php echo e(route('password.update')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <input type="email" placeholder="Email Address" name="email" value="<?php echo e($email); ?>" required readonly style="background-color: #f5f5f5;" />
                <label style="display: block; margin-bottom: 5px; color: #666; font-size: 13px; font-weight: bold;">Enter 6-Digit Reset Code:</label>
                <input type="text" placeholder="000000" name="token" value="<?php echo e(old('token', $token)); ?>" required maxlength="6" pattern="[0-9]{6}" style="text-align: center; font-size: 24px; letter-spacing: 8px; font-weight: bold; font-family: 'Courier New', monospace;" />
                <p style="font-size: 11px; color: #999; margin-top: 5px; margin-bottom: 15px;">Enter the code exactly as shown in your email</p>
                <input type="password" placeholder="New Password" name="password" required minlength="6" />
                <input type="password" placeholder="Confirm New Password" name="password_confirmation" required minlength="6" />
                <input type="submit" id="buttn" name="submit" value="Reset Password" />
            </form>
        </div>
        <div class="cta">
            <a href="<?php echo e(route('login')); ?>" style="color:#5c4ac7;">Back to Login</a>
        </div>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>">
<style type="text/css">
#buttn {
    color: #fff;
    background-color: #5c4ac7;
}
input[type="text"][pattern] {
    font-family: 'Courier New', monospace;
}
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Owner\Desktop\Final Project - Food delivery\resources\views/auth/reset-password.blade.php ENDPATH**/ ?>