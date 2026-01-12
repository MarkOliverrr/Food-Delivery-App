

<?php $__env->startSection('title', 'Restaurants'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-wrapper">
    <div class="top-links">
        <div class="container">
            <ul class="row links">
                <li class="col-xs-12 col-sm-4 link-item active"><span>1</span><a href="#">Choose Restaurant</a></li>
                <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Pick Your favorite food</a></li>
                <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay</a></li>
            </ul>
        </div>
    </div>
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
                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3"></div>
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-9">
                    <div class="bg-gray restaurant-entry">
                        <div class="row">
                            <?php $__currentLoopData = $restaurants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restaurant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
                                    <div class="entry-logo">
                                        <a class="img-fluid" href="<?php echo e(route('dishes.show', $restaurant->rs_id)); ?>">
                                            <img src="<?php echo e(asset('admin/Res_img/' . $restaurant->image)); ?>" alt="Food logo">
                                        </a>
                                    </div>
                                    <div class="entry-dscr">
                                        <h5><a href="<?php echo e(route('dishes.show', $restaurant->rs_id)); ?>"><?php echo e($restaurant->title); ?></a></h5>
                                        <span><?php echo e($restaurant->address); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
                                    <div class="right-content bg-white">
                                        <div class="right-review">
                                            <a href="<?php echo e(route('dishes.show', $restaurant->rs_id)); ?>" class="btn btn-purple">View Menu</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Owner\Desktop\Final Project - Food delivery\resources\views/restaurants/index.blade.php ENDPATH**/ ?>