<?php include 'app\views\layout\header.php'; ?>
<?php include 'app\views\layout\footer.php'; ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <h1>My Orders</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th width="50%"><?= _('Product') ?></th>
                    <th><?= _('Price') ?></th>
                    <th width="10%"><?= _('Qty') ?></th>
                    <th><?= _('Discount') ?></th>
                    <th><?= _('Total') ?></th>
                    <th><?= _('Status') ?></th>
                    <th><?= _('Tracking Num') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php

                foreach ($orders as $order) {
                    $total = $order->price * $order->qty;
                    ?>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-sm-2"><img src="<?php echo "/public/images/" . $order->image; ?>"
                                                           width="50" height="50"/></div>
                                <div class="col-sm-10">
                                    <h5><a href="/home/productDetail/<?php echo $order->product_id; ?>"
                                           style="color:inherit"><?php echo $order->name; ?></a>
                                    </h5>
                                </div>
                            </div>
                        </td>
                        <td>
                            $<?php echo $order->price; ?>
                        </td>
                        <td>
                            <?php echo $order->qty; ?>
                        </td>
                        <td>
                            <?php
                            $discount = $order->discount_per ? $total * $order->discount_per / 100 : 0;
                            echo $discount;
                            ?>
                        </td>
                        <td>$<?php echo $total - $discount; ?></td>
                        <td>
                            <?php echo $order->order_status; ?>
                        </td>

                        <td>
                    

                        <?php foreach ($ships as $item) {
                            if($item->order_id == $order->order_id ){
                                 echo $item->tracking_number;

								}

                                else{
                                    echo "Not yet shipped";
                                }
                            
                            
                            }


                    ?>

               
                        </td>
                        
                        
                


                    </tr>
                <?php } ?>

               
                           
                    
                </tbody>
            </table>

        </div>

    </div>
</div>