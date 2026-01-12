

<?php $__env->startSection('title', 'Add Restaurant'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12">
            <h3 class="text-primary">Add Restaurant</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('admin.restaurants.store')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Category</label>
                        <select name="c_id" class="form-control">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->c_id); ?>"><?php echo e($category->c_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Title</label>
                        <input name="title" class="form-control" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Phone</label>
                        <input name="phone" class="form-control" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Open Hours</label>
                        <input name="o_hr" class="form-control" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Close Hours</label>
                        <input name="c_hr" class="form-control" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Open Days</label>
                        <input name="o_days" class="form-control" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Address</label>
                        <input name="address" class="form-control" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Website (optional)</label>
                        <input type="url" name="url" class="form-control" />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" required />
                    </div>
                </div>
                <button class="btn btn-primary">Save</button>
                <a href="<?php echo e(route('admin.restaurants.index')); ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Owner\Desktop\Final Project - Food delivery\resources\views/admin/restaurants/create.blade.php ENDPATH**/ ?>