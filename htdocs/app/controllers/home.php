<?php

namespace app\controllers;

use app\models\Product;

class home extends \app\core\Controller{
    

    public function index()
    {
        //Get all products
        $productModel = new Product();
        $products = $productModel->getAll();
        require 'app/views/layout/header.php';
        require 'app/views/home/index.php';
        require 'app/views/layout/footer.php';
    }

    function productDetail($productId){
        $productModel = new Product();
        $product = $productModel->getById($productId);
        require 'app/views/layout/header.php';
        require 'app/views/home/product_detail.php';
        require 'app/views/layout/footer.php';
    }


}
