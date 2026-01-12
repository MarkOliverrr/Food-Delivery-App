

<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('content'); ?>
<div style="min-height: 100vh; padding: 100px 0; background: url('<?php echo e(asset('images/img/pimg.jpg')); ?>') center center / cover no-repeat fixed;">
    <div class="pen-title"></div>
    <div class="module form-module">
        <div class="toggle"></div>
        <div class="form">
            <h2>Login to your account</h2>
            <form action="<?php echo e(route('login')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <input type="text" placeholder="Username" name="username" value="<?php echo e(old('username')); ?>" required autofocus />
                <input type="password" placeholder="Password" name="password" required />
                <input type="submit" id="buttn" name="submit" value="Login" />
            </form>
        </div>
        <?php if (! (request()->is('admin/*'))): ?>
        <div class="cta">Not registered? <a href="<?php echo e(route('register')); ?>" style="color:#5c4ac7;">Create an account</a></div>
        <?php endif; ?>
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


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Owner\Desktop\Final Project - Food delivery\resources\views/auth/login.blade.php ENDPATH**/ ?>