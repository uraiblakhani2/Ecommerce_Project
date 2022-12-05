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

    public function create()
    {
        $SQL = "INSERT INTO buyers (buyer_username,first_name,last_name,postal_code,street_name,city,phone_number,password_hash) VALUES(:buyer_username,:first_name,:last_name,:postal_code,:street_name,:city,:phone_number,:password_hash)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['buyer_username' => $this->username,'first_name' => $this->first_name,'last_name' => $this->last_name,'postal_code' => $this->postal_code,'street_name' => $this->street_name,'city' => $this->city,'phone_number' => $this->phone_number,'password_hash' => $this->password
        ]);

    }

    public function update2fa(){
        $SQL = "UPDATE buyers SET secret_key=:secret_key WHERE buyer_id=:buyer_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['secret_key'=>$this->secret_key,
                        'buyer_id'=>$this->buyer_id]);
    }


    public function getBuyer($buyer_id){
		$SQL = "SELECT * FROM user WHERE buyer_id=:buyer_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['buyer_id'=>$buyer_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
		return $STMT->fetch();
	}

	public function updatePassword(){
		$SQL = "UPDATE user SET password_hash=:password_hash WHERE buyer_id=:buyer_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['password_hash'=>$this->password_hash,
						'buyer_id'=>$this->buyer_id]);
	}

}