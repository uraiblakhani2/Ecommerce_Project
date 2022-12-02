<?php include 'app\views\layout\header.php'; ?>
<?php include 'app\views\layout\footer.php'; ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <h2>Edit Product</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <a href="/SellerProduct/index">Go to product list</a>
            <form action="/SellerProduct/update/<?php echo $product->product_id; ?>" method="post" class="mt-3" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-12 mb-3">
                        <label for="">Product Name</label>
                        <input type="text" name="name" value="<?php echo $product->name;?>" class="form-control" required>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label for="">Price</label>
                        <input type="number" name="price" value="<?php echo $product->price;?>" class="form-control" required>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label for="">Brand</label>
                        <input type="text" name="brand" value="<?php echo $product->brand;?>" class="form-control" required>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label for="">UPC</label>
                        <input type="text" name="upc" value="<?php echo $product->upc;?>" class="form-control" required>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label for="">Stock</label>
                        <input type="number" name="stock" value="<?php echo $product->stock;?>" class="form-control" required>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label for="">Category</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">-Select-</option>
                            <?php
                            foreach ($categories as $category){
                                $selected ='';
                                if($product->category_id === $category->category_id){
                                    $selected ="selected";
                                }
                            echo "<option value='".$category->category_id."' $selected>$category->category_name</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control">
                        <div><a href="<?php echo "/public/images/".$product->image;?>" target="_blank">Old Image</a></div>
                    </div>
                    <div class="col-sm-12 mb-3">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control" required><?php echo $product->name;?></textarea>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <button class="btn btn-success" type="submit" name="saveProduct">Submit</button>
                        <button class="btn btn-default" type="reset" >Reset</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
