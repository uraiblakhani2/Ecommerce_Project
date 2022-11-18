<?php

namespace app\models;

class Buyer extends \app\core\Model
{

    public function get($username)
    {

        $SQL = "SELECT * FROM buyers WHERE buyer_username=:buyer_username";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['buyer_username' => $username]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
        return $STMT->fetch();
    }

    function create()
    {
        $SQL = "INSERT INTO buyers (
                    buyer_username,
                    first_name,
                    last_name,
                    postal_code,
                    street_name,
                    city,
                    phone_number,
                    password_hash
                    ) VALUES
                          (
                            :buyer_username,
                            :first_name,
                           :last_name,
                           :postal_code,
                           :street_name,
                           :city,
                           :phone_number,
                           :password_hash
                          )";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute([
            'buyer_username' => $this->username,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'postal_code' => $this->postal_code,
            'street_name' => $this->street_name,
            'city' => $this->city,
            'phone_number' => $this->phone_number,
            'password_hash' => $this->password
        ]);

    }


}