<?php

namespace models;

class Product extends \components\Db {
    
    public static $SHOW_BY_DEFAULT = 10;
    
    public static function getLatestProducts() {
        // Database connection
        $db = self::getConnection();
        
        $pdo2 = $db->prepare("SELECT * FROM product LIMIT 0,".static::$SHOW_BY_DEFAULT);
        $pdo2->execute();
        $productList = $pdo2->fetchAll(\PDO::FETCH_ASSOC);
        return $productList;
    }

    public static function getProductsListByCategory($categoryId = false, $page = 1) {
        if($categoryId){
            $offset = ($page - 1) * static::$SHOW_BY_DEFAULT;
            // Database connection
            $db = self::getConnection();
            
            $pdo3 = $db->prepare("SELECT id, name, price, is_new FROM product WHERE status='1' AND category_id = ? ORDER BY id DESC LIMIT ".static::$SHOW_BY_DEFAULT." OFFSET ".$offset); 
            $pdo3->bindParam(1,$categoryId);
            $pdo3->execute();
            $products = $pdo3->fetchAll(\PDO::FETCH_ASSOC);
            return $products;
        }
    }

    public static function getProductById($id) {
        if($id){
            // Database connection
            $db = self::getConnection();
            
            $pdo4 = $db->prepare("SELECT * FROM product WHERE id=?");
            $pdo4->bindParam(1,$id);
            $pdo4->execute();
            $result = $pdo4->fetch(\PDO::FETCH_ASSOC);
            return $result;
        }
    }
    
    public static function getTotalProductsInCategory($categoryId) {
        // Database connection
        $db = self::getConnection();
        
        $pdo5 = $db->prepare("SELECT COUNT(id) AS count FROM product WHERE status = '1' AND category_id = ?");
        $pdo5->bindParam(1,$categoryId);
        $pdo5->execute();
        $row = $pdo5->fetch(\PDO::FETCH_ASSOC);
        return $row['count']; 
    }

    public static function getProductsByIds($idsArray) {
        // Database connection
        $products = [];
        $db = self::getConnection();

        $idStr = implode(',', $idsArray);

        $pdo12 = $db->query("SELECT * FROM product WHERE status='1' AND id IN ($idStr)");
//        $pdo12->bindParam(1,$id);
        $products = $pdo12->fetchAll(\PDO::FETCH_ASSOC);
        return $products;
    }

    public static function getRecommendedProducts() {
        // Database connection
        $db = self::getConnection();

        $pdo15 = $db->query("SELECT id, name, price, is_new FROM product WHERE status='1' AND is_recommended='1' ORDER BY id DESC");
        $prodList = $pdo15->fetchAll(\PDO::FETCH_ASSOC);
        return $prodList;
    }

    public static function getImage($id) {
        // Название изображения-пустышки
        $noImage ='no-image.jpg';

        // Путь к папке с товарами
        $path = '/upload/images/products/';

        // Путь к изображению товара
        $pathToProductImage = $path. $id.'.jpg';

        if(file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)){
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }
        // Возвращаем путь изображения-пустышки
        return $path. $noImage;
    }

    public static function getProductList() {
        // Database connection
        $db = self::getConnection();
        $prodList = [];

        // Получение и возврат результатов
        $pdo16 = $db->prepare("SELECT id, name, price, code FROM product ORDER BY id ASC");
        $pdo16->execute();
        $prodList = $pdo16->fetchAll(\PDO::FETCH_ASSOC);
        return $prodList;
    }

    public static function createProduct($options){
        // Database connection
        $db = self::getConnection();

        // Query text to DB
        $sql = 'INSERT INTO product '
            . '(name, code, price, category_id, brand, availability,'
            . 'description, is_new, is_recommended, status)'
            . 'VALUES '
            . '(:name, :code, :price, :category_id, :brand, :availability,'
            . ':description, :is_new, :is_recommended, :status)';

        // Receive and return results. Used prepared request
        $pdo20 = $db->prepare($sql);
        $pdo20->bindParam(':name', $options['name'], \PDO::PARAM_STR);
        $pdo20->bindParam(':code', $options['code'], \PDO::PARAM_STR);
        $pdo20->bindParam(':price', $options['price'], \PDO::PARAM_STR);
        $pdo20->bindParam(':category_id', $options['category_id'], \PDO::PARAM_INT);
        $pdo20->bindParam(':brand', $options['brand'], \PDO::PARAM_STR);
        $pdo20->bindParam(':availability', $options['availability'], \PDO::PARAM_INT);
        $pdo20->bindParam(':description', $options['description'], \PDO::PARAM_STR);
        $pdo20->bindParam(':is_new', $options['is_new'], \PDO::PARAM_INT);
        $pdo20->bindParam(':is_recommended', $options['is_recommended'], \PDO::PARAM_INT);
        $pdo20->bindParam(':status', $options['status'], \PDO::PARAM_INT);
        if($pdo20->execute()){
            return $db->lastInsertId();
        }
        return 0;
    }

    public static function deleteProductById($id){
        // Database connection
        if($id){
            $db = self::getConnection();

            $pdo19 = $db->prepare("DELETE FROM product WHERE id=?");
            $pdo19->bindParam(1, $id, \PDO::PARAM_INT);
            $result = $pdo19->execute();
            return $result;
        }
    }

    public static function updateProductById($id, $options) {
        // Database connection
        $db = self::getConnection();

        // Query text to DB
        $sql = "UPDATE product
            SET 
              name = :name, 
                code = :code, 
                price = :price, 
                category_id = :category_id, 
                brand = :brand, 
                availability = :availability, 
                description = :description, 
                is_new = :is_new, 
                is_recommended = :is_recommended, 
                status = :status
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, \PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], \PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], \PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], \PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], \PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], \PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], \PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], \PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], \PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], \PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], \PDO::PARAM_INT);
        return $result->execute();
    }
}

?>