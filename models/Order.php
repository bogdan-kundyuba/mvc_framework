<?php

namespace models;

class Order extends \components\Db {

    public static function save($userName, $userPhone, $userComment, $userId, $products){
//          echo gettype($products);
////        echo "<pre>";
////        print_r($products);
////        echo "</pre>";

        $products = json_encode($products);
//        echo gettype($products);
////        echo "<pre>";
////        print_r($products);
////        echo "</pre>";
//
////        die();

        $db = self::getConnection();

        $sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products) '
            . 'VALUES (:user_name, :user_phone, :user_comment, :user_id, :products)';

        // Get and return results. Used prepared request
        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $userName, \PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, \PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, \PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, \PDO::PARAM_STR);
        $result->bindParam(':products', $products, \PDO::PARAM_STR);
        return $result->execute();
    }

    public static function getOrderList(){
        // Database connection
        $db = self::getConnection();

        // Get and return results. Used prepared request
        $result = $db->prepare("SELECT id, user_name, user_phone, date, status FROM product_order ORDER BY id DESC");
        $result->execute();
        return $result;
    }

    public static function getOrderById($id){
        // Database connection
        $db = self::getConnection();

        // Get and return results. Used prepared request
        $pdo24 = $db->prepare("SELECT * FROM product_order WHERE id=?");
        $pdo24->bindParam(1,$id);
        $pdo24->execute();
        $array = $pdo24->fetch(\PDO::FETCH_ASSOC);
        return $array;
    }

    public static function getStatusText($status){
        switch ($status) {
            case '1':
                return 'Новый заказ';
                break;
            case '2':
                return 'В обработке';
                break;
            case '3':
                return 'Доставляется';
                break;
            case '4':
                return 'Закрыт';
                break;
        }
    }

    public static function updateOrderById($id, $userName, $userPhone, $userComment, $date, $status) {
        $db = self::getConnection();

        $sql = "Update product_order
        SET 
        user_name = :user_name,
        user_phone = :user_phone,
        user_comment = :user_comment,
        date = :date,
        status = :status
        WHERE id = :id";

        // Get and return results. Used prepared request
        $pdo25 = $db->prepare($sql);
        $pdo25->bindParam(':id', $id, \PDO::PARAM_INT);
        $pdo25->bindParam(':user_name', $userName, \PDO::PARAM_STR);
        $pdo25->bindParam(':user_phone', $userPhone, \PDO::PARAM_STR);
        $pdo25->bindParam(':user_comment', $userComment, \PDO::PARAM_STR);
        $pdo25->bindParam(':date', $date, \PDO::PARAM_STR);
        $pdo25->bindParam(':status', $status, \PDO::PARAM_INT);
        return $pdo25->execute();
    }

    public static function deleteOrderById($id) {
        // Database connection
        $db = self::getConnection();

        // Get and return results. Used prepared request
        $pdo26 = $db->prepare("DELETE FROM product_order WHERE id=?");
        $pdo26->bindParam(1,$id);
        $result = $pdo26->execute();
        return result;
    }
}