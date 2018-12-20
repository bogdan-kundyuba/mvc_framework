<?php

require_once ROOT. "/models/Category.php";
require_once ROOT. "/models/Product.php";
//require_once ROOT. "/components/Pagination.php";

class CatalogController {
    
    public function actionIndex() {
        
        $categories = \models\Category::getCategoriesList();
        
        \models\Product::$SHOW_BY_DEFAULT = 10;
        $latestProducts = \models\Product::getLatestProducts();
        
        require_once (ROOT ."/views/catalog/index.php");
        
        return true;
    }
    
    public function actionCategory($categoryId, $page = 1) {
        
        $categories = \models\Category::getCategoriesList();
        
        \models\Product::$SHOW_BY_DEFAULT = 5;
        $categoryProducts = \models\Product::getProductsListByCategory($categoryId, $page);
        
        $total = \models\Product::getTotalProductsInCategory($categoryId);
        
        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, \models\Product::$SHOW_BY_DEFAULT, 'page-');
        
        require_once (ROOT."/views/catalog/category.php");
        
        return true;
    }
    
}

?>