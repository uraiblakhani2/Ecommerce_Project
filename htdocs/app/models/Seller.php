<?php

namespace app\models;

class Seller extends \app\core\Model
{

    public function get($username)
    {

        $SQL = "SELECT * FROM sellers WHERE seller_username=:seller_username";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['seller_username' => $username]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
        return $STMT->fetch();
    }



    public function getSellerbyProductId($product_id)
    {

        $SQL = "SELECT seller_id FROM products WHERE product_id=:product_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['product_id' => $product_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Seller');
        return $STMT->fetch();
    }


    

    public function create()
    {
        $SQL = "INSERT INTO sellers (seller_username,password_hash)
         VALUES(:seller_username,:password_hash)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['seller_username' => $this->username,'password_hash' => $this->password]);

    }


}