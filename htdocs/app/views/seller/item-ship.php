
<?php include 'app\views\layout\header.php'; ?>
<?php include 'app\views\layout\footer.php'; ?>
<div class="container mt-5">

    <div class="row">
        <div class="col-sm-4 m-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Item shipped for order ID: <?php echo $orderId;?></h4>
                </div>
                <div class="card-body">
                    <form action="/Order/shipped/<?php echo $orderId;?>" method="post">
                        <div class="row">
                            <div class="col-sm-12 mb-3">
                                <label for="">Tracking number</label>
                                <input type="text" name="tracking_number" class="form-control" required>
                            </div>

                            <div class="col-sm-12">
                                <button type="submit" name="save" class="btn btn-success">Submit</button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>