<?php include 'app\views\layout\header.php'; ?>
<?php include 'app\views\layout\footer.php'; ?>
<div class="container mt-5">
<h4><?php if(!empty($_SESSION['hasMembership'])){echo "You have membership and will automatically receive 10% off your order";}?></h4>

    <div class="row">
        <div class="col-sm-12">
            <h1>Carts</h1>
        </div>
    </div>
    <div class="row">
        <?php  if($carts){?>
        <form method="post" action="/Order/create">
        <div class="col-sm-12">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th width="50%">Product</th>
                    <th>Price</th>
                    <th width="10%">Qty</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $subTotal = 0;
                $discount = 0;
                foreach ($carts as $cart) {
                    $productTotal = $cart->qty * $cart->price;
                    $subTotal +=$productTotal;
                    ?>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-sm-2"><img src="<?php echo "/public/images/" . $cart->image; ?>"
                                                           width="50" height="50"/></div>
                                <div class="col-sm-10">
                                    <a href="/home/productDetail/<?php echo $cart->product_id; ?>"><?php echo $cart->name; ?></a>
                                    <br />
                                    <br />
                                    <a href="/Cart/delete/<?php echo $cart->cart_id; ?>" onclick="return confirm('Are you sure want to delete it?')" class="text-danger">Delete</a>

                                </div>
                            </div>
                        </td>
                        <td>
                            $<?php echo $cart->price; ?>
                        </td>
                        <td>
                          <div>
                                 <form>
                                     <input type="number" name="qty" value="<?php echo $cart->qty; ?>" id="<?php echo $cart->cart_id; ?>" class="form-control" required >
                                     <button type="button" class="btn btn-sm btn-primary mt-1" onclick="updateQty(<?php echo $cart->cart_id; ?>)" name="updateCart">Update</button>

                                 </form>                          </div>
                        </td>
                        <td>$<?php echo $productTotal; ?></td>


                    </tr>
                <?php } ?>
                <tr>
                    <th colspan="3" class="text-end">Sub Total:</th>
                    <td>$<?php echo $subTotal;?></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td class="text-end">
                        <form action="" method="get">
                            <input type="text" name="coupon" class="form-control" value="<?php  echo $code; ?>" placeholder="Apply coupon code">
                            <?php if($coupon){echo "<p class='text-success'>Valid! get $coupon->discount_per % off</p>";}?>
                            <button type="submit" class="btn btn-sm btn-warning mt-1" name="apply">Apply</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <th colspan="3" class="text-end">Discount:</th>
                    <td>$<?php
                        if($coupon){
                            $discount = ($subTotal * $coupon->discount_per) / 100;

                        };
                        echo $discount;
                        ?></td>
                </tr>
                <tr>
                    <th colspan="3" class="text-end">Pay:</th>
                    <td>$<?php echo $subTotal-$discount;?></td>
                </tr>
                </tbody>
            </table>

        </div>
        <div class="row">
            <div class="col-sm-12 text-end">
                <input type="hidden" name="coupon_code"  value="<?php  echo $code; ?>">
                <button type="submit" name="newOrder" class="btn btn-lg btn-success">Place Order</button>
            </div>
        </div>
        </form>
        <?php }else{
            echo "<h4>No products in the cart</h4>";
        }?>
    </div>
</div>
<script>
    function updateQty(id){
        var qty = Math.abs($("#"+id).val());
        $.ajax({
            url:"/Cart/update/"+id,
            type:"POST",
            data:{'qty': qty},
            success: function() {
            window.location.reload();
            }
        })
    }
</script>