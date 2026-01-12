

<?php $__env->startSection('title', 'Edit Dish'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12">
            <h3 class="text-primary">Edit Dish</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('admin.dishes.update', $dish)); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Restaurant</label>
                        <select name="rs_id" class="form-control">
                            <?php $__currentLoopData = $restaurants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restaurant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($restaurant->rs_id); ?>" <?php if($dish->rs_id==$restaurant->rs_id): ?> selected <?php endif; ?>><?php echo e($restaurant->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Title</label>
                        <input name="title" class="form-control" value="<?php echo e($dish->title); ?>" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Slogan</label>
                        <input name="slogan" class="form-control" value="<?php echo e($dish->slogan); ?>" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Price</label>
                        <input type="number" step="0.01" name="price" class="form-control" value="<?php echo e($dish->price); ?>" required />
                    </div>
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="img" class="form-control" />
                </div>
                <button class="btn btn-primary">Update</button>
                <a href="<?php echo e(route('admin.dishes.index')); ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Owner\Desktop\Final Project - Food delivery\resources\views/admin/dishes/edit.blade.php ENDPATH**/ ?>