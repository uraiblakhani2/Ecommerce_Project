<?php

namespace app\models;

class Category extends \app\core\Model
{

    public function getAll()
    {

        $SQL = "SELECT * FROM categories";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute();
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Buyer');
        return $STMT->fetchAll();
    }

}