<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <h2>My Products</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <a href="/SellerProduct/create">Add new Product</a>
            <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>In Stock</th>
                    <th>Brand</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $product){?>
                <tr>
                    <td><img src="<?php echo "/public/images/".$product->image;?>" width="50" height="50"></td>
                    <td><?php echo $product->name;?></td>
                    <td><?php echo $product->price;?></td>
                    <td><?php echo $product->stock;?></td>
                    <td><?php echo $product->brand;?></td>
                    <td><a href="/SellerProduct/edit/<?php echo $product->product_id;?>">Edit</a></td>
                    <td><a href="/SellerProduct/delete/<?php echo $product->product_id;?>" onclick="return confirm('Are you sure want to delete it?')" class="text-danger">Delete</a></td>
                </tr>
                <?php }?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
