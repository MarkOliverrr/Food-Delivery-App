

<?php $__env->startSection('title', 'Restaurants'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-6 align-self-center">
            <h3 class="text-primary">Restaurants</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="<?php echo e(route('admin.restaurants.create')); ?>" class="btn btn-sm btn-primary">Add Restaurant</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $restaurants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restaurant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($restaurant->title); ?></td>
                                <td><?php echo e(optional($restaurant->category)->c_name); ?></td>
                                <td><?php echo e($restaurant->email); ?></td>
                                <td><?php echo e($restaurant->phone); ?></td>
                                <td>
                                    <a href="<?php echo e(route('admin.restaurants.edit', $restaurant)); ?>" class="btn btn-sm btn-secondary">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="5" class="text-center">No restaurants found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Owner\Desktop\Final Project - Food delivery\resources\views/admin/restaurants/index.blade.php ENDPATH**/ ?>