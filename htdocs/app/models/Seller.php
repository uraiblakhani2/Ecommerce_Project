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

    public function create()
    {
        $SQL = "INSERT INTO sellers (seller_username,password_hash)
         VALUES(:seller_username,:password_hash)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['seller_username' => $this->username,'password_hash' => $this->password]);

    }


}