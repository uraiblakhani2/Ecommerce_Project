<?php include 'app\views\layout\header.php'; ?>
<?php include 'app\views\layout\footer.php'; ?>
<link href="/public/css/style2.css" rel="stylesheet">


<?php
if(isset($_GET['error'])){
?>
<div class="alert alert-danger" role="alert">
	<?=$_GET['error']?>
</div>
<?php
}
?>
<?php
if(isset($_GET['message'])){
?>
<div class="alert alert-success" role="alert">
	<?=$_GET['message']?>
</div>
<?php
}
?>




<div class="container mt-5">
    <div class="row">
        <h2>Product Detail</h2>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <img src="<?php echo "/public/images/" . $product->image; ?>"/>
        </div>
        <div class="col-sm-8">
            <h2><?php echo $product->name; ?></h2>
            <h4 class="text-success">$ <?php echo $product->price; ?></h4>
            <table class="">
                <tr>
                    <th>Brand:</th>
                    <td>&nbsp;<?php echo $product->brand; ?></td>
                </tr>
                <tr>
                    <th>UPC:</th>
                    <td>&nbsp;<?php echo $product->upc; ?></td>
                </tr>
            </table>
            <br/>
            <p><b>Description</b> <?php echo $product->description; ?></p>
            <form action="/Cart/add/<?php echo $product->product_id; ?>" method="post">
                <div class="row">
                    <div class="col-sm-2">
                        <input type="number" name="qty" class="form-control" value="1">
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" name="cart" class="btn btn-success"> Add to cart</button>
                    </div>
                </div>
            </form>
            <a href="#sellerFeedback">Give seller feedback</a>&nbsp;&nbsp;
            <a href="/SellerProduct/report/<?php echo $product->product_id; ?>" onclick="return confirm('Are you sure want to report for this product')">Report Listing</a>
        </div>
    </div>
    <div class="row">
            <h5>Give a review </h5>
            <form action="/Review/create/<?php echo $product->product_id;?>" method="post" class="pb-3">
                <div class="row">
                    <div class="col-sm-4">
                        <select name="rating" required class="form-control">
                            <option value="">-Select Rating</option>
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                    <div class="col-sm-8">
                        <textarea name="comment" required class="form-control" placeholder="Enter your comment"></textarea>
                    </div>
                    <div class="col-sm-8">
                        <button type="submit" name="saveReview" class="btn btn-warning">Submit your review</button>
                    </div>
                </div>
            </form>

            <hr/>


        <h4>Reviews</h4>
        <div class="row">
            <?php foreach ($reviews as $review){?>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo $review->first_name." ".$review->last_name;?><br/>
                        <?php for($i=0;$review->rating > $i; $i++){?>
                        <span class="text-warning fs-2">*</span>
                        <?php }?>
                        <p> <?php echo $review->comment;?></p>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>

        <p></p>
        <p></p>
        <p></p>
        <p></p>
        <p></p>
        <p></p>
        <p></p>
        <p></p>

        <h4>Seller Feedback</h4>
        <div class="row">
            <?php foreach ($feedbacks as $item) {
                echo "
                <div class=card>
                <div class=card-body>
                $item->feedback by $item->first_name
                </div>
              </div>";
            }
            ?>


          
        </div>

    
    
        <p></p>
        <p></p>
        <p></p>
        <p></p>

    <div class="row py-3" id="sellerFeedback">
        <h4>Give Seller Feedback</h4>
        <form action="/Seller/feedbackSave/<?php echo $product->seller_id;?>/<?php echo $product->product_id;?>" method="post" class="pb-3">
            <div class="row">

                <div class="col-sm-12">
                    <textarea name="feedback" required class="form-control" placeholder="Enter your feedback"></textarea>
                </div>
                <div class="col-sm-8 mt-3">
                    <button type="submit" name="saveFeedback" class="btn btn-warning">Submit your feedback</button>
                </div>
            </div>
        </form>


    </div>
</div>