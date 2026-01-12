

<?php $__env->startSection('title', 'Users'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12">
            <h3 class="text-primary">Users</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Login Method</th>
                            <th>Registration Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($user->username); ?></td>
                                <td><?php echo e(trim($user->f_name . ' ' . $user->l_name) ?: '—'); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td>
                                    <?php if($user->login_method === 'google'): ?>
                                        <span style="background-color: #4285F4; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;">
                                            <i class="fa fa-google"></i> Google
                                        </span>
                                    <?php else: ?>
                                        <span style="background-color: #6c757d; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;">
                                            Email
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($user->created_at ? $user->created_at->format('Y-m-d H:i') : '—'); ?></td>
                                <td>
                                    <div style="display: flex; gap: 5px;">
                                        <a class="btn btn-sm btn-info" href="<?php echo e(route('admin.users.show', $user)); ?>" title="View">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <a class="btn btn-sm btn-warning" href="<?php echo e(route('admin.users.edit', $user)); ?>" title="Edit">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <form method="POST" action="<?php echo e(route('admin.users.destroy', $user)); ?>" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="6" class="text-center">No users.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 15px;">
                    <?php echo e(session('success')); ?>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Owner\Desktop\Final Project - Food delivery\resources\views/admin/users/index.blade.php ENDPATH**/ ?>