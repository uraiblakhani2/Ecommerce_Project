<?php

namespace app\controllers;

use app\models\SellerFeedback;

class Seller extends \app\core\Controller
{
    public function feedbackSave($sellerId, $productId){
        if((empty($_SESSION['buyer_id']) && isset($_POST['saveFeedback']))){
            header("location:/home/productDetail/$productId"."?error=please login before leaving a seller feedback");


        }
 

        if(!empty($_SESSION['buyer_id']) && isset($_POST['saveFeedback'])) {
            

            $buyerId = $_SESSION['buyer_id'];
            $feedback = new SellerFeedback();
            $feedback->seller_id = $sellerId;
            $feedback->buyer_id = $buyerId;
            $feedback->feedback = $_POST['feedback'];


            $feedbacks = $feedback->checkFeedbacks($_SESSION['buyer_id']);
            if(!empty($feedbacks)){
                header("location:/home/productDetail/$productId"."?error=You are not allowed to leave more then 1 feedback");

            }

            else{
                $feedback->create();
                header("location:/home/productDetail/$productId");
    
            }
            
            
        }

    }
}