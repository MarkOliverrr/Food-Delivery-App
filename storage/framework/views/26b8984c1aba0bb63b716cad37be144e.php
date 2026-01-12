

<?php $__env->startSection('title', 'My Orders'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-wrapper">
    <div class="inner-page-hero bg-image" data-image-src="<?php echo e(asset('images/img/pimg.jpg')); ?>">
        <div class="container"></div>
    </div>
    <div class="result-show">
        <div class="container">
            <div class="row"></div>
        </div>
    </div>

    <section class="restaurants-page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bg-gray">
                        <div class="row">
                            <table class="table table-bordered table-hover">
                                <thead style="background: #404040; color:white;">
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td data-column="Item"><?php echo e($order->title); ?></td>
                                            <td data-column="Quantity"><?php echo e($order->quantity); ?></td>
                                            <td data-column="price">₱<?php echo e(number_format($order->price, 2)); ?></td>
                                            <td data-column="status">
                                                <?php if(empty($order->status) || $order->status == 'NULL'): ?>
                                                    <button type="button" class="btn btn-info">
                                                        <span class="fa fa-bars" aria-hidden="true"></span> Dispatch
                                                    </button>
                                                <?php elseif($order->status == 'in process'): ?>
                                                    <button type="button" class="btn btn-warning">
                                                        <span class="fa fa-cog fa-spin" aria-hidden="true"></span> On The Way!
                                                    </button>
                                                <?php elseif($order->status == 'closed'): ?>
                                                    <button type="button" class="btn btn-success">
                                                        <span class="fa fa-check-circle" aria-hidden="true"></span> Delivered
                                                    </button>
                                                <?php elseif($order->status == 'rejected'): ?>
                                                    <button type="button" class="btn btn-danger">
                                                        <i class="fa fa-close"></i> Cancelled
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                            <td data-column="Date"><?php echo e($order->created_at->format('Y-m-d H:i:s')); ?></td>
                                            <td data-column="Action">
                                                <form action="<?php echo e(route('orders.destroy', $order->o_id)); ?>" method="POST" style="display:inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10" onclick="return confirm('Are you sure you want to cancel your order?');">
                                                        <i class="fa fa-trash-o" style="font-size:16px"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="6" class="text-center">You have No orders Placed yet.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Owner\Desktop\Final Project - Food delivery\resources\views\orders\my-orders.blade.php ENDPATH**/ ?>