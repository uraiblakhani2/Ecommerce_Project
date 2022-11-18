<div class="container">
    <div class="row">
        <h1>Products</h1>

    </div>
    <div class="row">
        <?php foreach ($products as $product){?>
        <div class="col-sm-3">
            <div class="card" >
                <img src="<?php echo "/public/images/".$product->image;?>" class="card-img-top" alt="...">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo $product->name;?></h5>
                    <p class="card-text">$<?php echo $product->price;?></p>
                    <a href="/home/productDetail/<?php echo $product->product_id;?>" class="btn btn-primary">Product detail</a>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</div>