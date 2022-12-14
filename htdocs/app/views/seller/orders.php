<?php include 'app\views\layout\header.php'; ?>
<?php include 'app\views\layout\footer.php'; ?>
<div class="container mt-5">
    <div class="row">
        <button class="btn btn-success"><?= _('Seller Balance: $') ?><?php echo $balance; ?></button>

    </div>
    <hr/>
    <form action="" method="get">
        <div class="row">

            <div class="col-sm-3">
                <h2>Orders</h2>
            </div>
            <div class="col-sm-2">
                <h4>Filter By:</h4>
            </div>

            <div class="col-sm-3">
                <input type="date" name="date" value="<?php if (!empty($_GET['date'])) {
                    echo $_GET['date'];
                } ?>" class="form-control">
            </div>
            <div class="col-sm-3">
                <select class="form-control" name="price">
                    <option value=""><?= _('Filter by Price') ?></option>
                    <option value="100"><?= _('Below $100') ?></option>
                    <option value="200"><?= _('Below $200') ?></option>
                    <option value="500"><?= _('Below $500') ?></option>
                    <option value="1000"><?= _('Below $1000') ?></option>
                </select>
            </div>
            <div class="col-sm-1">
                <button type="submit" class="btn btn-warning" name="filter"><?= _('GO') ?></button>
            </div>

        </div>
    </form>
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
                                    <h5><?php echo $order->name; ?>
                                    </h5>
                                    <?php if ($order->order_status == "New") { ?>
                                        <a href="/Order/cancelOrder/<?php echo $order->order_id; ?>"
                                           class="text-warning"
                                           onclick="return confirm('Are you sure want to cancel it?')"><?= _('Cancel order') ?></a>
                                        &nbsp;&nbsp;
                                        <a href="/Order/ship/<?php echo $order->order_id; ?>"
                                           class="text-info"><?= _('Item shipped?') ?></a>
                                    <?php }
                                    elseif ($order->order_status == "Cancelled") {
                                        echo "<span class='text-danger'>Cancelled</span>";
                                    }
                                    elseif ($order->order_status == "Shipped") {
                                        echo "<span class='text-success'>Item Shipped</span>";
                                    } ?>
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


                    </tr>
                <?php } ?>

                </tbody>
            </table>

        </div>

    </div>
</div>