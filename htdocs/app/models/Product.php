<?php

namespace app\models;

class Product extends \app\core\Model
{
    public function getAll()
    {
        $SQL = "SELECT * FROM products";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute();
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
        return $STMT->fetchAll();
    }

    public function getBySeller()
    {
        $sellerId = $_SESSION['seller_id'];
        $SQL = "SELECT * FROM products WHERE seller_id=:seller_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['seller_id' => $sellerId]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
        return $STMT->fetchAll();
    }


    function create()
    {
        $SQL = "INSERT INTO products (
                    name,
                    price,
                    brand,
                    upc,
                    stock,
                    category_id,
                    description,
                    image,
                    seller_id
                    ) VALUES
                          (
                            :name,
                            :price,
                           :brand,
                           :upc,
                           :stock,
                           :category_id,
                           :description,
                           :image,
                           :seller_id
                          )";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute([
            'name' => $this->name,
            'price' => $this->price,
            'brand' => $this->brand,
            'upc' => $this->upc,
            'stock' => $this->stock,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'image' => $this->image,
            'seller_id' => $this->seller_id
        ]);

    }

    function updateById($productId)
    {
        $sellerId = $_SESSION['seller_id'];
        $SQL = "UPDATE products SET 
                    name=:name,
                    price=:price,
                    brand=:brand,
                    upc=:upc,
                    stock=:stock,
                    category_id=:category_id,
                    description=:description,
                    image=:image
                    where product_id=:product_id and seller_id=:seller_id
                  ";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute([
            'name' => $this->name,
            'price' => $this->price,
            'brand' => $this->brand,
            'upc' => $this->upc,
            'stock' => $this->stock,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'image' => $this->image,
            'product_id' => $productId,
            'seller_id' => $sellerId

        ]);

    }


    public function getById($productId)
    {
        $SQL = "SELECT * FROM products WHERE product_id=:product_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['product_id' =>$productId]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
        return $STMT->fetch();
    }


    public function deleteById($productId)
    {
        $sellerId = $_SESSION['seller_id'];
        $SQL = "DELETE FROM products WHERE seller_id=:seller_id and product_id=:product_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['seller_id' => $sellerId, 'product_id' =>$productId]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
    }
}