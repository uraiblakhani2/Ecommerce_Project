<?php

namespace app\models;

class Review extends \app\core\Model
{
    function checkIsEligible($product_id)
    {
        if (!empty($_SESSION['buyer_id'])) {
            $buyerId = $_SESSION['buyer_id']; 
            $SQL = "SELECT * FROM orders WHERE product_id=:product_id AND buyer_id=:buyer_id ";
            $STMT = self::$_connection->prepare($SQL);
            $STMT->execute(['buyer_id' => $buyerId,'product_id' => $product_id]);
            $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
            return $STMT->fetch();
        }
    }

    function create()
    {
        $SQL = "INSERT INTO product_reviews (product_id,buyer_id,rating,comment)
         VALUES(:product_id,:buyer_id,:rating,:comment)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['product_id' => $this->product_id,'buyer_id' => $this->buyer_id,'rating' => $this->rating,'comment' => $this->comment]);
    }

    function getReviewsByProductId($productId)
    {
        $SQL = "SELECT * FROM  product_reviews inner join buyers on buyers.buyer_id=product_reviews.buyer_id WHERE product_id=:product_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['product_id' => $productId]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
        return $STMT->fetchAll();
    }
}