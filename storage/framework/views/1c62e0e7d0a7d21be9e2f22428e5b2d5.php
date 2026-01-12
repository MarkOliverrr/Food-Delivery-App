

<?php $__env->startSection('title', 'Order Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12">
            <h3 class="text-primary">Order #<?php echo e($order->o_id); ?></h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <p><strong>User:</strong> <?php echo e(optional($order->user)->username ?? trim((optional($order->user)->f_name.' '.optional($order->user)->l_name)) ?: 'guest'); ?></p>
            <p><strong>Address:</strong> <?php echo e($order->address ?? optional($order->user)->address ?? 'Not provided'); ?></p>
            <p><strong>Status:</strong> <?php echo e($order->status ?? 'Not set'); ?></p>
            <p><strong>Total:</strong> ₱<?php echo e(number_format($order->price, 2)); ?></p>

            <form method="POST" action="<?php echo e(route('admin.orders.update-status', $order)); ?>" class="form-inline">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="form-group mr-2">
                    <label class="mr-2">Update Status</label>
                    <select name="status" class="form-control">
                        <option value="in process" <?php if($order->status==='in process'): ?> selected <?php endif; ?>>in process</option>
                        <option value="closed" <?php if($order->status==='closed'): ?> selected <?php endif; ?>>closed</option>
                        <option value="rejected" <?php if($order->status==='rejected'): ?> selected <?php endif; ?>>rejected</option>
                    </select>
                </div>
                <div class="form-group mr-2">
                    <input name="remark" class="form-control" placeholder="Remark (optional)" />
                </div>
                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Owner\Desktop\Final Project - Food delivery\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>