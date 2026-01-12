

<?php $__env->startSection('title', 'Registration'); ?>

<?php $__env->startSection('content'); ?>
<div style="background-image: url('<?php echo e(asset('images/img/pimg.jpg')); ?>'); min-height: 100vh;">
    <div class="page-wrapper">
        <section class="contact-page inner-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="widget">
                            <div class="widget-body">
                                <form action="<?php echo e(route('register')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="username">User-Name</label>
                                            <input class="form-control" type="text" name="username" id="username" value="<?php echo e(old('username')); ?>" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="firstname">First Name</label>
                                            <input class="form-control" type="text" name="firstname" id="firstname" value="<?php echo e(old('firstname')); ?>" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="lastname">Last Name</label>
                                            <input class="form-control" type="text" name="lastname" id="lastname" value="<?php echo e(old('lastname')); ?>" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="email">Email Address</label>
                                            <input type="email" class="form-control" name="email" id="email" value="<?php echo e(old('email')); ?>" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="phone">Phone number</label>
                                            <input class="form-control" type="text" name="phone" id="phone" value="<?php echo e(old('phone')); ?>" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="password_confirmation">Confirm password</label>
                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="address">Delivery Address</label>
                                            <textarea class="form-control" id="address" name="address" rows="3" required><?php echo e(old('address')); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p><input type="submit" value="Register" name="submit" class="btn theme-btn"></p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Owner\Desktop\Final Project - Food delivery\resources\views\auth\register.blade.php ENDPATH**/ ?>