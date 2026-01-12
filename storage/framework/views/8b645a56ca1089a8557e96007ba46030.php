

<?php $__env->startSection('title', 'Dishes || Online Food Ordering System'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-wrapper">
    <div class="top-links">
        <div class="container">
            <ul class="row links">
                <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="<?php echo e(route('restaurants.index')); ?>">Choose Restaurant</a></li>
                <li class="col-xs-12 col-sm-4 link-item active"><span>2</span><a href="#">Pick Your favorite food</a></li>
                <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay</a></li>
            </ul>
        </div>
    </div>

    <section class="inner-page-hero bg-image" data-image-src="<?php echo e(asset('images/img/restrrr.png')); ?>">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 profile-img">
                        <div class="image-wrap">
                            <figure>
                                <img src="<?php echo e(asset('admin/Res_img/' . $restaurant->image)); ?>" alt="Restaurant logo">
                            </figure>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                        <div class="pull-left right-text white-txt">
                            <h6><a href="#"><?php echo e($restaurant->title); ?></a></h6>
                            <p><?php echo e($restaurant->address); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="breadcrumb">
        <div class="container"></div>
    </div>

    <div class="container m-t-30">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                <div class="widget widget-cart">
                    <div class="widget-heading">
                        <h3 class="widget-title text-dark">Your Cart</h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="order-row bg-white">
                        <div class="widget-body">
                            <?php
                                $cart = session('cart', []);
                                $item_total = 0;
                            ?>
                            <?php $__empty_1 = true; $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="title-row">
                                    <?php echo e($item['title']); ?>

                                    <a href="<?php echo e(route('cart.remove', $item['d_id'])); ?>">
                                        <i class="fa fa-trash pull-right"></i>
                                    </a>
                                </div>
                                <div class="form-group row no-gutter">
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control b-r-0" value="₱<?php echo e(number_format($item['price'], 2)); ?>" readonly>
                                    </div>
                                    <div class="col-xs-4">
                                        <input class="form-control" type="text" readonly value="<?php echo e($item['quantity']); ?>">
                                    </div>
                                </div>
                                <?php
                                    $item_total += ($item['price'] * $item['quantity']);
                                ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <p class="text-center">Your cart is empty</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="price-wrap text-xs-center">
                            <p>TOTAL</p>
                            <h3 class="value"><strong>₱<?php echo e(number_format($item_total, 2)); ?></strong></h3>
                            <p>Free Delivery!</p>
                            <?php if($item_total == 0): ?>
                                <a href="#" class="btn btn-danger btn-lg disabled">Checkout</a>
                            <?php else: ?>
                                <a href="<?php echo e(route('checkout')); ?>" class="btn btn-success btn-lg active">Checkout</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="menu-widget" id="2">
                    <div class="widget-heading">
                        <h3 class="widget-title text-dark">
                            MENU
                            <a class="btn btn-link pull-right" data-toggle="collapse" href="#popular2" aria-expanded="true">
                                <i class="fa fa-angle-right pull-right"></i>
                                <i class="fa fa-angle-down pull-right"></i>
                            </a>
                        </h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="collapse in" id="popular2">
                        <?php $__empty_1 = true; $__currentLoopData = $dishes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dish): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="food-item">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-lg-8">
                                        <form method="post" action="<?php echo e(route('cart.add')); ?>">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="dish_id" value="<?php echo e($dish->d_id); ?>">
                                            <div class="rest-logo pull-left">
                                                <a class="restaurant-logo pull-left" href="#">
                                                    <img src="<?php echo e(asset('admin/Res_img/dishes/' . $dish->img)); ?>" alt="Food logo">
                                                </a>
                                            </div>
                                            <div class="rest-descr">
                                                <h6><a href="#"><?php echo e($dish->title); ?></a></h6>
                                                <p><?php echo e($dish->slogan); ?></p>
                                            </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-lg-3 pull-right item-cart-info">
                                        <span class="price pull-left">₱<?php echo e(number_format($dish->price, 2)); ?></span>
                                        <input class="b-r-0" type="number" name="quantity" style="margin-left:30px;" value="1" size="2" min="1" required />
                                        <input type="submit" class="btn theme-btn" style="margin-left:40px;" value="Add To Cart" />
                                    </div>
                                        </form>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-center">No dishes available</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Owner\Desktop\Final Project - Food delivery\resources\views\dishes\index.blade.php ENDPATH**/ ?>