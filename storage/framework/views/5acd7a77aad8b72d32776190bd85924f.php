<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/login.css')); ?>">
</head>

<body>
    <div class="container">
        <div class="info">
            <h1>Admin Panel</h1>
        </div>
    </div>
    <div class="form">
        <div class="thumbnail"><img src="<?php echo e(asset('admin/images/manager.png')); ?>" /></div>
        <?php if($errors->any()): ?>
            <span style="color:red;"><?php echo e($errors->first()); ?></span>
        <?php endif; ?>
        <form class="login-form" action="<?php echo e(route('admin.login')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <input type="text" placeholder="Username" name="username" value="<?php echo e(old('username')); ?>" required autofocus />
            <input type="password" placeholder="Password" name="password" required />
            <input type="submit" name="submit" value="Login" />
        </form>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="<?php echo e(asset('admin/js/index.js')); ?>"></script>
</body>
</html>

<?php /**PATH C:\Users\Owner\Desktop\Final Project - Food delivery\resources\views\admin\auth\login.blade.php ENDPATH**/ ?>