<?php

namespace app\models;

class Review extends \app\core\Model
{
   public function checkIsEligible($product_id, $buyer_id)
    {
            $SQL = "SELECT * FROM orders WHERE product_id=:product_id AND buyer_id=:buyer_id ";
            $STMT = self::$_connection->prepare($SQL);
            $STMT->execute(['buyer_id' => $buyer_id,'product_id' => $product_id]);
            $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\OrderModel');
            return $STMT->fetch();
        
    }

   public function create()
    {
        $SQL = "INSERT INTO product_reviews (product_id,buyer_id,rating,comment)
         VALUES(:product_id,:buyer_id,:rating,:comment)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['product_id' => $this->product_id,'buyer_id' => $this->buyer_id,'rating' => $this->rating,'comment' => $this->comment]);
    }

   public function getReviewsByProductId($productId)
    {
        $SQL = "SELECT * FROM  product_reviews inner join buyers on buyers.buyer_id=product_reviews.buyer_id WHERE product_id=:product_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['product_id' => $productId]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
        return $STMT->fetchAll();
    }

    public function getReviewByBuyerId($buyer_id)
    {
        $SQL = "SELECT * FROM  product_reviews WHERE buyer_id=:buyer_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['buyer_id' => $buyer_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
        return $STMT->fetchAll();
    }
}