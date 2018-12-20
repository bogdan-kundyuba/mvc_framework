<?php

namespace models;

class Order extends \components\Db {

//    public static function save($userName, $userPhone, $userComment, $userId, $products) {
//
////        echo gettype($products);
////        echo "<pre>";
////        print_r($products);
////        echo "</pre>";
//
//        $products = json_encode($products);
////        echo gettype($products);
////        echo "<pre>";
////        print_r($products);
////        echo "</pre>";
//
////        die();
//
//        $db = self::getConnection();
//
//        $pdo13 = $db->prepare("INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products) VALUES (?,?,?,?,?)");
//        $pdo13->bindParam(1,$user_name,\PDO::PARAM_STR);
//        $pdo13->bindParam(2,$user_phone,\PDO::PARAM_STR);
//        $pdo13->bindParam(3,$user_comment,\PDO::PARAM_STR);
//        $pdo13->bindParam(4,$user_id,\PDO::PARAM_STR);
//        $pdo13->bindParam(5,$products, \PDO::PARAM_STR);
//        $result = $pdo13->execute();
//        return $result;
//    }

    public static function save($userName, $userPhone, $userComment, $userId, $products){
        $products = json_encode($products);

        $db = self::getConnection();

        $sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products) '
            . 'VALUES (:user_name, :user_phone, :user_comment, :user_id, :products)';

        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $userName, \PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, \PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, \PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, \PDO::PARAM_STR);
        $result->bindParam(':products', $products, \PDO::PARAM_STR);
        return $result->execute();
    }

    public static function getOrderList(){
        $db = self::getConnection();

    }

    public static function getOrderById($id){


    }
}