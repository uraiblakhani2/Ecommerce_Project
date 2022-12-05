<?php

namespace app\models;

class SellerFeedback extends \app\core\Model
{
    public function create()
    {
        $SQL = "INSERT INTO seller_feedbacks (seller_id,buyer_id,feedback)
         VALUES(:seller_id,:buyer_id,:feedback)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['seller_id' => $this->seller_id,'buyer_id' => $this->buyer_id,'feedback' => $this->feedback]);
    }


    
   public function getFeedbacksBySellerId($seller_id)
    {

        $SQL = "SELECT * FROM  seller_feedbacks inner join buyers on buyers.buyer_id=seller_feedbacks.buyer_id WHERE seller_id=:seller_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['seller_id' => $seller_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
        return $STMT->fetchAll();
    }

    public function checkFeedbacks($buyer_id)
    {
        $SQL = "SELECT * FROM  seller_feedbacks WHERE buyer_id=:buyer_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['buyer_id' => $buyer_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
        return $STMT->fetchAll();
    }


    
}