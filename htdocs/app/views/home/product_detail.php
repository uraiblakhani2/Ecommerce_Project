<div class="container mt-5">
    <div class="row">
        <h2>Product Detail</h2>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <img src="<?php echo "/public/images/".$product->image;?>" />
        </div>
        <div class="col-sm-8">
            <h2><?php echo $product->name;?></h2>
            <h4 class="text-success">$ <?php echo $product->price;?></h4>
            <table class="">
                <tr>
                    <th>Brand: </th>
                    <td>&nbsp;<?php echo $product->brand;?></td>
                </tr>
                <tr>
                    <th>UPC: </th>
                    <td>&nbsp;<?php echo $product->upc;?></td>
                </tr>
            </table>
            <br />
            <p><b>Description</b> <?php echo $product->description;?></p>
            <form action="/Cart/add/<?php echo $product->product_id;?>" method="post">
                <div class="row">
                    <div class="col-sm-2">
                        <input type="number" name="qty" class="form-control" value="1">
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" name="cart" class="btn btn-success"> Add to cart</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <h4>Reviews</h4>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        Praveen <?php echo date('y-m-d h:i') ?><br />
                        *****
                        <p>Its good</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>