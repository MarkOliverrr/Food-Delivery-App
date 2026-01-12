

<?php $__env->startSection('title', 'Add Category'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12">
            <h3 class="text-primary">Add Category</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('admin.categories.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label>Name</label>
                    <input name="c_name" class="form-control" required />
                </div>
                <button class="btn btn-primary">Save</button>
                <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title">Existing Categories</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Date</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($category->c_id); ?></td>
                                <td><?php echo e($category->c_name); ?></td>
                                <td><?php echo e(optional($category->created_at)->format('Y-m-d H:i:s')); ?></td>
                                <td class="text-right">
                                    <form action="<?php echo e(route('admin.categories.destroy', $category)); ?>" method="POST" style="display:inline-block;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Delete this category?');">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    <a href="<?php echo e(route('admin.categories.edit', $category)); ?>" class="btn btn-sm btn-primary" title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="text-center">No categories yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Owner\Desktop\Final Project - Food delivery\resources\views/admin/categories/create.blade.php ENDPATH**/ ?>