<?php
namespace models;

class Category extends \components\Db {
    
    public static function getCategoriesList() {
        // Database connection
        $db = self::getConnection();
        
        $pdo2 = $db->prepare("SELECT id, name FROM category ORDER BY sort_order ASC");
        $pdo2->execute();
        $categoryList = $pdo2->fetchAll(\PDO::FETCH_ASSOC);
        return $categoryList;
    }

    public static function getCategoriesListAdmin() {
        // Database connection
        $db = self::getConnection();

        $pdo17 = $db->prepare("SELECT id, name, sort_order FROM category ORDER BY sort_order ASC");
        $pdo17->execute();
        $categoriesList = $pdo17->fetchAll(\PDO::FETCH_ASSOC);
        return $categoriesList;
    }

    public static function deleteCategoryById($id){
        // Database connection
        $db = self::getConnection();
    }

    public static function getCategoryById($id) {
        // Database connection
        $db = self::getConnection();

        $pdo21 = $db->prepare("SELECT * FROM category WHERE id=?");
        $pdo21->bindParam(1,$id);
        $pdo21->execute();
        $res = $pdo21->fetch(\PDO::FETCH_ASSOC);
        return $res;
    }

    public static function getStatusText($status) {
        switch ($status) {
            case '1':
                return 'Отображается';
                break;
            case 'o':
                return 'Скрыто';
                break;
        }
    }
}

?>