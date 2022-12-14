<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;

class SellerProduct extends \app\core\Controller
{
    public function index(){
        
        $productModel = new Product();
        $products = $productModel->getBySeller();
        $report = new Product();
        $reports = $report->getReports();
        require 'app/views/seller/product/index.php';
        
    }

    public function create(){
        
        //Get all categories for dropdown
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();
        require 'app/views/seller/product/create.php';
        
    }

    public function save(){
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
        

        //Get all categories for dropdown
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        //Get selected products detail
        $productModel = new Product();
        $product = $productModel->getById($productId);
        require 'app/views/seller/product/edit.php';
        
    }

    public function update($productId){
        //Get selected products detail
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

    public function delete($productId){
        $productModel = new Product();
        $isProduct = $productModel->getById($productId);
        if($isProduct){
            $productModel->deleteById($productId);
        }
        header("location:/SellerProduct/index");
    }

    public function report($productId){
        if(!empty($_SESSION['buyer_id']) ) {
            $buyerId = $_SESSION['buyer_id'];
            $report = new Product();
            $report->buyer_id = $buyerId;
            $report->product_id = $productId;
            $report->createReport();
        }
        header("location:/home/productDetail/$productId");
    }
}