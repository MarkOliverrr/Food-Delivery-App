

<?php $__env->startSection('title', 'Forgot Password'); ?>

<?php $__env->startSection('content'); ?>
<div style="min-height: 100vh; padding: 100px 0; background: url('<?php echo e(asset('images/img/pimg.jpg')); ?>') center center / cover no-repeat fixed;">
    <div class="pen-title"></div>
    <div class="module form-module">
        <div class="toggle"></div>
        <div class="form">
            <h2>Forgot Password</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 20px;">Enter your email address and we'll send you a password reset code.</p>
            
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
            
            <form action="<?php echo e(route('password.email')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <input type="email" placeholder="Enter your email address" name="email" value="<?php echo e(old('email')); ?>" required autofocus />
                <input type="submit" id="buttn" name="submit" value="Send Reset Code" />
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
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Owner\Desktop\Final Project - Food delivery\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>