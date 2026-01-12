

<?php $__env->startSection('title', 'Edit Restaurant'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12">
            <h3 class="text-primary">Edit Restaurant</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('admin.restaurants.update', $restaurant)); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Category</label>
                        <select name="c_id" class="form-control">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->c_id); ?>" <?php if($restaurant->c_id==$category->c_id): ?> selected <?php endif; ?>><?php echo e($category->c_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Title</label>
                        <input name="title" class="form-control" value="<?php echo e($restaurant->title); ?>" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo e($restaurant->email); ?>" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Phone</label>
                        <input name="phone" class="form-control" value="<?php echo e($restaurant->phone); ?>" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Open Hours</label>
                        <input name="o_hr" class="form-control" value="<?php echo e($restaurant->o_hr); ?>" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Close Hours</label>
                        <input name="c_hr" class="form-control" value="<?php echo e($restaurant->c_hr); ?>" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Open Days</label>
                        <input name="o_days" class="form-control" value="<?php echo e($restaurant->o_days); ?>" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Address</label>
                        <input name="address" class="form-control" value="<?php echo e($restaurant->address); ?>" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Website (optional)</label>
                        <input type="url" name="url" class="form-control" value="<?php echo e($restaurant->url); ?>" />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" />
                    </div>
                </div>
                <button class="btn btn-primary">Update</button>
                <a href="<?php echo e(route('admin.restaurants.index')); ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Owner\Desktop\Final Project - Food delivery\resources\views/admin/restaurants/edit.blade.php ENDPATH**/ ?>