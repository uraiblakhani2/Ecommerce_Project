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
            
            $eligibleReview = $reviewModel->checkIsEligible($productId, $_SESSION['buyer_id']);

            if(empty($eligibleReview)){
                header("location:/home/productDetail/$productId"."?error=You must purchase this product before you can leave a review");

            }
            else{

            //     $reviews = $reviewModel->getReviewByBuyerId($_SESSION['buyer_id']);
            // if(!empty($reviews)){
            //     header("location:/home/productDetail/$productId"."?error=You are not allowed to leave more then 1 review");

            // }
            // else{
            $reviewModel->create();
            header("location:/home/productDetail/$productId");
        }
            
            
            
        }
    }
}