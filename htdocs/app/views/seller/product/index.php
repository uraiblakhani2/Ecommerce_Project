<?php include 'app\views\layout\header.php'; ?>
<?php include 'app\views\layout\footer.php'; ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <h2><?= _('My Products') ?></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <a href="/SellerProduct/create"><?= _('Add new Product') ?></a>
            <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th><?= _('Image') ?></th>
                    <th><?= _('Product Name') ?></th>
                    <th><?= _('Price') ?></th>
                    <th><?= _('In Stock') ?></th>
                    <th><?= _('Brand') ?></th>
                    <th><?= _('Edit') ?></th>
                    <th><?= _('Delete') ?></th>
                    <th><?= _('Reports') ?></th>
                    
                </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $product){
                    $reportes = 0;?>
                <tr>
                    <td><img src="<?php echo "/public/images/".$product->image;?>" width="50" height="50"></td>
                    <td><?php echo $product->name;?></td>
                    <td><?php echo $product->price;?></td>
                    <td><?php echo $product->stock;?></td>
                    <td><?php echo $product->brand;?></td>
                    
                    


                    <td><a href="/SellerProduct/edit/<?php echo $product->product_id;?>"><?= _('Edit') ?></a></td>
                    <td><a href="/SellerProduct/delete/<?php echo $product->product_id;?>" onclick="return confirm('Are you sure want to delete it?')" class="text-danger"><?= _('Delete') ?></a></td>
                    
                    
                    <?php foreach ($reports as $items) {
                        if($items->product_id == $product->product_id)
                           $reportes++;
                            
                            
                            }
                            

                    ?>

                    <td><?php echo $reportes;?></td>

                    
                    
                    
                    
                </tr>
                <?php }?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
