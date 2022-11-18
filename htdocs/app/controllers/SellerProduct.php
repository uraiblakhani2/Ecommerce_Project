<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;

class SellerProduct extends \app\core\Controller
{
    function index(){
        require 'app/views/layout/header.php';
        $productModel = new Product();
        $products = $productModel->getBySeller();
        require 'app/views/seller/product/index.php';
        require 'app/views/layout/footer.php';
    }

    function create(){
        require 'app/views/layout/header.php';
        //Get all categories for dropdown
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();
        require 'app/views/seller/product/create.php';
        require 'app/views/layout/footer.php';
    }

    function save(){
        if(isset($_POST['saveProduct'])){
            $product = new Product();
            $product->name = $_POST['name'];
            $product->price = $_POST['price'];
            $product->brand = $_POST['brand'];
            $product->upc = $_POST['upc'];
            $product->stock = $_POST['stock'];
            $product->category_id = $_POST['category_id'];
            $product->description = $_POST['description'];
            $product->seller_id = $_SESSION['seller_id'];

            //Save image in folder and store path in table
            if($_FILES['image']['name'] != "") {
                $fileName = $_FILES["image"]['name'];
                $movedFile = move_uploaded_file($_FILES['image']['tmp_name'],
                    __DIR__.'/../../public/images/'. $fileName);
                $product->image = $fileName;
            }else{
                $product->image = '';
            }
            $product->create();
            header("location:/SellerProduct/index");
        }else{
            header("location:/SellerProduct/create");
        }
    }

    public function edit($productId){
        require 'app/views/layout/header.php';

        //Get all categories for dropdown
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        //Get selected productd detail
        $productModel = new Product();
        $product = $productModel->getById($productId);
        require 'app/views/seller/product/edit.php';
        require 'app/views/layout/footer.php';
    }

    public function update($productId){
        //Get selected productd detail
        $productModel = new Product();
        $isProduct = $productModel->getById($productId);
        if(isset($_POST['saveProduct']) && $isProduct){


            $product = new Product();
            $product->name = $_POST['name'];
            $product->price = $_POST['price'];
            $product->brand = $_POST['brand'];
            $product->upc = $_POST['upc'];
            $product->stock = $_POST['stock'];
            $product->category_id = $_POST['category_id'];
            $product->description = $_POST['description'];
            $product->seller_id = $_SESSION['seller_id'];

            //Save image in folder and store path in table
            if($_FILES['image']['name'] != "") {
                $fileName = $_FILES["image"]['name'];
                $movedFile = move_uploaded_file($_FILES['image']['tmp_name'],
                    __DIR__.'/../../public/images/'. $fileName);
                $product->image = $fileName;
            }else{
                $product->image = $isProduct->image;
            }
            $product->updateById($productId);
            header("location:/SellerProduct/index");
        }else{
            header("location:/SellerProduct/edit/$productId");
        }
    }

    function delete($productId){
        $productModel = new Product();
        $isProduct = $productModel->getById($productId);
        if($isProduct){
            $productModel->deleteById($productId);
        }
        header("location:/SellerProduct/index");
    }
}