

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div style="padding-top: 10px;">
    <marquee onMouseOver="this.stop()" onMouseOut="this.start()">Welcome to our Online Food Ordering System – Fresh meals delivered fast!.</marquee>
</div>

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="card card-outline-primary">
            <div class="card-header">
                <h4 class="m-b-0 text-white">Admin Dashboard</h4>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card p-30">
                        <div class="media">
                            <div class="media-left meida media-middle">
                                <span><i class="fa fa-home f-s-40"></i></span>
                            </div>
                            <div class="media-body media-text-right">
                                <h2><?php echo e($stats['restaurants']); ?></h2>
                                <p class="m-b-0">Restaurants</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-30">
                        <div class="media">
                            <div class="media-left meida media-middle">
                                <span><i class="fa fa-cutlery f-s-40" aria-hidden="true"></i></span>
                            </div>
                            <div class="media-body media-text-right">
                                <h2><?php echo e($stats['dishes']); ?></h2>
                                <p class="m-b-0">Dishes</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-30">
                        <div class="media">
                            <div class="media-left meida media-middle">
                                <span><i class="fa fa-users f-s-40"></i></span>
                            </div>
                            <div class="media-body media-text-right">
                                <h2><?php echo e($stats['users']); ?></h2>
                                <p class="m-b-0">Users</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-30">
                        <div class="media">
                            <div class="media-left meida media-middle">
                                <span><i class="fa fa-shopping-cart f-s-40" aria-hidden="true"></i></span>
                            </div>
                            <div class="media-body media-text-right">
                                <h2><?php echo e($stats['totalOrders']); ?></h2>
                                <p class="m-b-0">Total Orders</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card p-30">
                        <div class="media">
                            <div class="media-left meida media-middle">
                                <span><i class="fa fa-th-large f-s-40" aria-hidden="true"></i></span>
                            </div>
                            <div class="media-body media-text-right">
                                <h2><?php echo e($stats['categories']); ?></h2>
                                <p class="m-b-0">Restro Categories</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-30">
                        <div class="media">
                            <div class="media-left meida media-middle">
                                <span><i class="fa fa-spinner f-s-40" aria-hidden="true"></i></span>
                            </div>
                            <div class="media-body media-text-right">
                                <h2><?php echo e($stats['processingOrders']); ?></h2>
                                <p class="m-b-0">Processing Orders</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-30">
                        <div class="media">
                            <div class="media-left meida media-middle">
                                <span><i class="fa fa-check f-s-40" aria-hidden="true"></i></span>
                            </div>
                            <div class="media-body media-text-right">
                                <h2><?php echo e($stats['deliveredOrders']); ?></h2>
                                <p class="m-b-0">Delivered Orders</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card p-30">
                        <div class="media">
                            <div class="media-left meida media-middle">
                                <span><i class="fa fa-times f-s-40" aria-hidden="true"></i></span>
                            </div>
                            <div class="media-body media-text-right">
                                <h2><?php echo e($stats['cancelledOrders']); ?></h2>
                                <p class="m-b-0">Cancelled Orders</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-30">
                        <div class="media">
                            <div class="media-left meida media-middle">
                                <span><i class="fa fa-usd f-s-40" aria-hidden="true"></i></span>
                            </div>
                            <div class="media-body media-text-right">
                                <h2>₱<?php echo e(number_format($stats['totalEarnings'], 2)); ?></h2>
                                <p class="m-b-0">Total Earnings</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Owner\Desktop\Final Project - Food delivery\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>