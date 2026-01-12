

<?php $__env->startSection('title', 'User Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12">
            <h3 class="text-primary"><?php echo e(trim($user->f_name . ' ' . $user->l_name) ?: $user->username); ?></h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <p><strong>Username:</strong> <?php echo e($user->username); ?></p>
            <p><strong>Name:</strong> <?php echo e(trim($user->f_name . ' ' . $user->l_name) ?: '—'); ?></p>
            <p><strong>Email:</strong> <?php echo e($user->email); ?></p>
            <p><strong>Phone:</strong> <?php echo e($user->phone ?: '—'); ?></p>
            <p><strong>Address:</strong> <?php echo e($user->address ?: '—'); ?></p>
            <p><strong>Login Method:</strong> 
                <?php if($user->login_method === 'google'): ?>
                    <span style="background-color: #4285F4; color: white; padding: 4px 8px; border-radius: 4px;">
                        <i class="fa fa-google"></i> Google Login
                    </span>
                <?php else: ?>
                    <span style="background-color: #6c757d; color: white; padding: 4px 8px; border-radius: 4px;">
                        Email/Password
                    </span>
                <?php endif; ?>
            </p>
            <p><strong>Registration Date:</strong> <?php echo e($user->created_at ? $user->created_at->format('Y-m-d H:i:s') : '—'); ?></p>
            <h5 class="mt-4">Orders</h5>
            <ul class="list-group">
                <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>#<?php echo e($order->o_id); ?> - <?php echo e($order->status); ?></span>
                        <span><?php echo e(number_format($order->price, 2)); ?></span>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <li class="list-group-item">No orders.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Owner\Desktop\Final Project - Food delivery\resources\views/admin/users/show.blade.php ENDPATH**/ ?>