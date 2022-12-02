<?php

namespace app\models;

class Coupon extends \app\core\Model
{
    public function getByCode($couponCode)
    {
        $SQL = "SELECT * FROM coupons  WHERE coupon_code=:coupon_code";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['coupon_code' => $couponCode]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
        return $STMT->fetch();
    }
}