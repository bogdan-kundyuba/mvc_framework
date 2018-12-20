<?php

require_once ROOT ."/models/Category.php";
require_once ROOT ."/models/Product.php";

class ProductController {
    
    public function actionView($productId) {

        // Список категорий для левого меню
        $categories = \models\Category::getCategoriesList();

        // Получаем инфомрацию о товаре
        $prod = \models\Product::getProductById($productId);

        require_once (ROOT ."/views/product/view.php");
        return true;
    }
}



?>