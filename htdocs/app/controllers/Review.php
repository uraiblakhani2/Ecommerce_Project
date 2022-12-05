<?php

namespace app\controllers;

class Review extends \app\core\Controller
{
    public function create($productId){
        if((empty($_SESSION['buyer_id']) && isset($_POST['saveReview']))){
            header("location:/home/productDetail/$productId"."?error=please login before leaving a review");
        }
        if(!empty($_SESSION['buyer_id']) && isset($_POST['saveReview'])) {
            $buyerId = $_SESSION['buyer_id'];
            $reviewModel = new \app\models\Review();
            $reviewModel->product_id = $productId;
            $reviewModel->buyer_id = $buyerId;
            $reviewModel->rating = $_POST['rating'];
            $reviewModel->comment = $_POST['comment'];
            
            $eligibleReview = $reviewModel->checkIsEligible($productId);
            

            $reviewModel->create();
            header("location:/home/productDetail/$productId");
        }
        header("location:/home/productDetail/$productId");
    }
}