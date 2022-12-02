<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use app\models\Review;
use app\models\SellerFeedback;

class home extends \app\core\Controller{
    

    public function index()
    {
        //Get all products

        $productModel = new Product();
        $products = $productModel->getAll($_GET);
        
        //Get all categories for dropdown
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();
        
        require 'app/views/home/index.php';
    }

    public function productDetail($productId){
        $productModel = new Product();
        $product = $productModel->getById($productId);

        //Check for eligible review
        $reviewModel = new Review();
        $feedbackModel = new SellerFeedback();
        $eligibleReview = $reviewModel->checkIsEligible($productId);
        $reviews = $reviewModel = $reviewModel->getReviewsByProductId($productId);
        $feedbacks =  $feedbackModel->getFeedbacksBySellerId('2');

        require 'app/views/home/product_detail.php';
    
    }


}
