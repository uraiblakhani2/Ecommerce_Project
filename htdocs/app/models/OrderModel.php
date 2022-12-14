<?php

namespace app\models;

class OrderModel extends \app\core\Model
{
    public function create()
    {
        $SQL = "INSERT INTO orders (buyer_id,product_id,qty,price,order_date,order_status,coupon_code,discount_per)
         VALUES(:buyer_id,:product_id,:qty,:price,:order_date,:order_status,:coupon_code,:discount_per)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['buyer_id' => $this->buyer_id,'product_id' => $this->product_id,'qty' => $this->qty,'price' => $this->price,'order_date' => $this->order_date,'order_status' => $this->order_status,'coupon_code' => $this->coupon_code,'discount_per' => $this->discount_per]);
    }


    public function updateOrderStatus($orderId, $status)
    {
        $SQL = "UPDATE orders SET order_status=:order_status where order_id=:order_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['order_status' => $status,'order_id' => $orderId]);
    }

    public function getBuyerOrders($buyerId)
    {
        $SQL = "SELECT orders.*, name, image FROM orders inner join products on products.product_id=orders.product_id WHERE buyer_id=:buyer_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['buyer_id' => $buyerId]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
        return $STMT->fetchAll();
    }

    public function checkMembership($buyer_id)
    {
        $product_id = 1;
        $SQL = "SELECT * FROM orders  WHERE buyer_id=:buyer_id AND product_id=:product_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['buyer_id' => $buyer_id,'product_id' => $product_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
        return $STMT->fetch();
    }

    public function updateMembership($buyer_id)
    {
        $membership_status = "yes";
        $SQL = "UPDATE buyers SET membership_status=:membership_status where buyer_id=:buyer_id ";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['buyer_id' => $buyer_id,'membership_status' => $membership_status]);

    }



    public function getSellerOrders($sellerId, $params)
    {
        $SQL = "SELECT orders.*, name, image FROM orders inner join products on products.product_id=orders.product_id WHERE seller_id=:seller_id";

        if (isset($params['date']) && $params['date']) {
            $SQL .= " and order_date='$params[date]'";
        }
        if (isset($params['price']) && $params['price']) {
            $SQL .= " and orders.price < '$params[price]'";
        }
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['seller_id' => $sellerId]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
        return $STMT->fetchAll();
    }

    public function getSellerBalance($sellerId)
    {
        $SQL = "SELECT sum(orders.price * qty) as total FROM orders inner join products on products.product_id=orders.product_id WHERE seller_id=:seller_id ";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['seller_id' => $sellerId]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
        return $STMT->fetch()->total;
    }



    public function shipCreate($order_id, $tracking_number)
    {
        $SQL = "INSERT INTO shippings (order_id,tracking_number)
         VALUES(:order_id,:tracking_number)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute([
            'order_id' => $order_id,
            'tracking_number' => $tracking_number
        ]);
    }


    public function getBuyerShipments($buyer_id){
        $sql = "SELECT * FROM shippings inner join orders on orders.order_id=shippings.order_id WHERE buyer_id=:buyer_id";
		$STMT = self::$_connection->prepare($sql);
		$STMT->execute(['buyer_id' => $buyer_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
		return $STMT->fetchAll();


    }


  
    public function getAllships(){
        $sql = "SELECT * FROM shippings";
		$STMT = self::$_connection->prepare($sql);
		$STMT->execute();
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
		return $STMT->fetchAll();
    }



}