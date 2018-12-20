<?php

class Cart {

    public static function addProduct($id) {

        // Пустой массив для товаров в корзине
        $prodCart = [];

        // Если в корзине уже есть товары (они хранятся в сессии)
        if(isset($_SESSION['products'])){

            // То заполним наш массив товарами
            $prodCart = $_SESSION['products'];
        }

        // Если товар есть в корзине, но был добавлен еще раз, увеличим количество
        if(array_key_exists($id, $prodCart)){
            $prodCart[$id] ++;
        } else {
            // Добавляем новый товар в корзину
            $prodCart[$id] = 1;
        }

        $_SESSION['products'] = $prodCart;
//        print_r($_SESSION['products']);die();
//        unset($_SESSION['products']);

        return self::countItems();
    }

    public function actionDelete() {
        if(isset($_SESSION['products'])){
            unset($_SESSION['products']);
        }
    }

    public static function countItems() {
        if(isset($_SESSION['products'])){
            $count = 0;
            foreach($_SESSION['products'] as $id=>$quantity) {
                $count = $count + $quantity;
            }
            return $count;
        } else {
            return 0;
        }
    }

    public static function getProducts() {
        if(isset($_SESSION['products'])){
            return $_SESSION['products'];
        }
        return false;
    }

    public static function getTotalPrice($products) {

        $prodCart = self::getProducts();
        $total = 0;

        if($prodCart) {
            foreach($products as $item){
                $total += $item['price'] * $prodCart[$item['id']];
            }
        }
        return $total;
    }

    public static function clear(){
        if($_SESSION['products']){
            unset($_SESSION['products']);
        }
    }

    public static function deleteProducts($id) {
        // Плучаем индентификатор массива и количество товаров в корзине
        $prodCart = self::getProducts();
//        print_r($prodCart);

        // Удаляем элемент массива с указанным: id
        unset($prodCart[$id]);

        $_SESSION['products'] = $prodCart;
    }
}
