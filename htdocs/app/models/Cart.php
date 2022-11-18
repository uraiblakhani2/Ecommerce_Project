<?php

namespace app\models;

class Cart extends \app\core\Model
{
    function create()
    {
        $SQL = "INSERT INTO carts (
                    buyer_id,
                    product_id,
                    qty
                    ) VALUES
                          (
                           :buyer_id,
                           :product_id,
                           :qty
                          )";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute([
            'buyer_id' => $this->buyer_id,
            'product_id' => $this->product_id,
            'qty' => $this->qty
        ]);


    }

    public function getByBuyerId()
    {
        $buyerId = $_SESSION['buyer_id'];
        $SQL = "SELECT carts.*, name, image, price FROM carts inner join products on products.product_id=carts.product_id WHERE buyer_id=:buyer_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['buyer_id' => $buyerId]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
        return $STMT->fetchAll();
    }

    public function checkIsAdded($productId, $buyerId)
    {
        $SQL = "SELECT * FROM carts  WHERE buyer_id=:buyer_id and product_id=:product_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['buyer_id' => $buyerId, 'product_id' => $productId]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
        return $STMT->fetch();
    }

    function updateById($cartId)
    {
        $SQL = "UPDATE carts SET 
                    qty=:qty
                    where cart_id=:cart_id 
                    ";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute([
            'qty' => $this->qty,
            'cart_id' => $cartId
        ]);

    }

    function delete($cartId)
    {
        $SQL = "DELETE FROM carts where cart_id=:cart_id 
                    ";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute([
            'cart_id' => $cartId
        ]);

    }

}