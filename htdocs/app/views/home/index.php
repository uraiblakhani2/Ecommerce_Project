<?php include 'app\views\layout\header.php'; ?>
<?php include 'app\views\layout\footer.php'; ?>

<div class="container my-5">
    <div class="row">
        <h1>Products</h1>
        <form action="/" method="get">
            <div class="row">
                <div class="col-sm-3">
                    <input type="text" name="search" class="form-control" placeholder="Search...">
                </div>
                <div class="col-sm-2">
                    <select class="form-control" name="price">
                        <option value="">Filter by Price</option>
                        <option value="100">Below $100</option>
                        <option value="200">Below $200</option>
                        <option value="500">Below $500</option>
                        <option value="1000">Below $1000</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <select class="form-control" name="category">
                        <option value="">Filter by Category</option>
                        <?php
                        foreach ($categories as $category){
                            echo "<option value='".$category->category_id."'>$category->category_name</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <select class="form-control" name="available">
                        <option value="">Filter by Availability</option>
                        <option value="Yes">Yes</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <select class="form-control" name="rating">
                        <option value="">Filter by Rating</option>
                        <option value="top">Top Rating</option>
                        <option value="low">Low Rating</option>
                    </select>
                </div>
                <div class="col-sm-1">
                   <button type="submit" class="btn btn-warning" name="filter">Go</button>
                </div>
            </div>

        </form>

    </div>
    <hr>
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