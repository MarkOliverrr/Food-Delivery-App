

<?php $__env->startSection('title', 'Checkout || Online Food Ordering System'); ?>

<?php $__env->startSection('content'); ?>
<div class="site-wrapper">
    <div class="page-wrapper">
        <div class="top-links">
            <div class="container">
                <ul class="row links">
                    <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="<?php echo e(route('restaurants.index')); ?>">Choose Restaurant</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Pick Your favorite food</a></li>
                    <li class="col-xs-12 col-sm-4 link-item active"><span>3</span><a href="<?php echo e(route('checkout')); ?>">Order and Pay</a></li>
                </ul>
            </div>
        </div>

        <div class="container m-t-30">
            <form action="<?php echo e(route('orders.place')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="widget clearfix">
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="cart-totals margin-b-20">
                                    <div class="cart-totals-title">
                                        <h4>Cart Summary</h4>
                                    </div>
                                    <div class="cart-totals-fields">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Cart Subtotal</td>
                                                    <td>₱<?php echo e(number_format($total, 2)); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Delivery Charges</td>
                                                    <td>Free</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-color"><strong>Total</strong></td>
                                                    <td class="text-color"><strong>₱<?php echo e(number_format($total, 2)); ?></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="payment-option">
                                    <ul class="list-unstyled">
                                        <li>
                                            <label class="custom-control custom-radio m-b-20">
                                                <input name="mod" id="radioStacked1" checked value="COD" type="radio" class="custom-control-input">
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description">Cash on Delivery</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="custom-control custom-radio m-b-10">
                                                <input name="mod" type="radio" value="paypal" disabled class="custom-control-input">
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description">Paypal <img src="<?php echo e(asset('images/paypal.jpg')); ?>" alt="" width="90"></span>
                                            </label>
                                        </li>
                                    </ul>
                                    <p class="text-xs-center">
                                        <input type="submit" onclick="return confirm('Do you want to confirm the order?');" name="submit" class="btn btn-success btn-block" value="Order Now">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Owner\Desktop\Final Project - Food delivery\resources\views\checkout.blade.php ENDPATH**/ ?>