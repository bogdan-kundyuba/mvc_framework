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

        $pdo29 = $db->prepare("DELETE FROM category WHERE id=?");
        $pdo29->bindParam(1,$id);
        $pdo29->execute();
        $pdo29->fetchAll();
        return $pdo29;
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
            case '0':
                return 'Скрыто';
                break;
        }
    }

    public static function createCategory($name, $sortOrder, $status) {
        // Database connection
        $db = self::getConnection();

        //
        $sql = "INSERT INTO category(name, sort_order, status) VALUES(:name,:sort_order,:status)";
        $pdo28 = $db->prepare($sql);
        $pdo28->bindParam(':name', $name, \PDO::PARAM_STR);
        $pdo28->bindParam(':sort_order', $sortOrder, \PDO::PARAM_INT);
        $pdo28->bindParam(':status', $status, \PDO::PARAM_INT);
        $pdo28->execute();
        return $pdo28;
    }
}

?>