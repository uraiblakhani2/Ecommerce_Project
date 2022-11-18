<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <h1>Carts</h1>
        </div>
    </div>
    <div class="row">
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
                           <form method="post" action="/Cart/update/<?php echo $cart->cart_id; ?>">
                               <input type="number" name="qty" value="<?php echo $cart->qty; ?>" class="form-control"
                                      required>
                               <button type="submit" class="btn btn-sm btn-primary mt-1" name="updateCart">Update</button>
                           </form>
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
                        <input type="text" name="coupon" class="form-control" placeholder="Apply coupon code">
                        <button type="submit" class="btn btn-sm btn-warning mt-1" name="updateCart">Apply</button>
                    </td>
                </tr>
                <tr>
                    <th colspan="3" class="text-end">Disocunt:</th>
                    <td>$<?php echo $subTotal;?></td>
                </tr>
                <tr>
                    <th colspan="3" class="text-end">Pay:</th>
                    <td>$<?php echo $subTotal;?></td>
                </tr>
                </tbody>
            </table>

        </div>
        <div class="row">
            <div class="col-sm-12 text-end">
                <button type="submit" class="btn btn-lg btn-success">Please Order</button>
            </div>
        </div>
    </div>
</div>