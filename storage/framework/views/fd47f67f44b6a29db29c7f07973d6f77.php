

<?php $__env->startSection('title', 'Orders'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body" style="padding-top:0;">
            <div style="background:#5b45d8;color:#fff;border-radius:4px;margin:-20px -20px 20px -20px;padding:14px 18px;">
                <strong>All Orders</strong>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width:140px;">User</th>
                            <th>Title</th>
                            <th style="width:90px;">Quantity</th>
                            <th style="width:120px;">Price</th>
                            <th>Address</th>
                            <th style="width:140px;">Status</th>
                            <th style="width:150px;">Reg-Date</th>
                            <th style="width:120px;" class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(optional($order->user)->username ?? trim((optional($order->user)->f_name.' '.optional($order->user)->l_name)) ?: 'guest'); ?></td>
                                <td><?php echo e($order->title ?? ($order->items_title ?? '—')); ?></td>
                                <td><?php echo e($order->quantity ?? 1); ?></td>
                                <td>₱<?php echo e(number_format($order->price, 2)); ?></td>
                                <td><?php echo e($order->address ?? optional($order->user)->address ?? '—'); ?></td>
                                <td>
                                    <form method="POST" action="<?php echo e(route('admin.orders.update-status', $order)); ?>" class="form-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <input type="hidden" name="remark" value="">
                                        <select name="status" class="form-control input-sm" style="height:32px;padding:2px 6px;display:inline-block;width:auto;">
                                            <option value="in process" <?php if($order->status==='in process'): ?> selected <?php endif; ?>>in process</option>
                                            <option value="closed" <?php if($order->status==='closed'): ?> selected <?php endif; ?>>closed</option>
                                            <option value="rejected" <?php if($order->status==='rejected'): ?> selected <?php endif; ?>>rejected</option>
                                        </select>
                                        <button class="btn btn-primary btn-sm" style="margin-left:6px;">
                                            <i class="fa fa-bars"></i> Dispatch
                                        </button>
                                    </form>
                                </td>
                                <td><?php echo e(optional($order->created_at)->format('Y-m-d H:i:s')); ?></td>
                                <td class="text-right">
                                    <a class="btn btn-info btn-sm" href="<?php echo e(route('admin.orders.show', $order)); ?>" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <form method="POST" action="<?php echo e(route('admin.orders.destroy', $order)); ?>" style="display:inline-block;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this order?');" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="8" class="text-center">No orders.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Owner\Desktop\Final Project - Food delivery\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>