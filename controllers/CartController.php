<?php

require_once ROOT. "/models/Cart.php";
require_once ROOT. "/models/Category.php";
require_once ROOT. "/models/Product.php";
require_once ROOT. "/models/User.php";
require_once ROOT. "/models/Order.php";

class CartController {

    public function actionAdd($id) {
        // Добавляем товар в корзину
        Cart::addProduct($id);

        // Возвращаем пользователя на страницу
        $refId = $_SERVER['HTTP_REFERER'];
        header("Location: $refId");
    }

    public function actionAddAjax($id) {
        // Добавляем товар в корзину
        echo Cart::addProduct($id);
        return true;
    }

    public function actionDelete($id) {

        Cart::deleteProducts($id);

        header("Location: http://mysite.loc/cart/");
    }
    public function actionIndex() {
        // Выводим категорию товаров
        $categories = \models\Category::getCategoriesList();

        $prodCart = false;

        // Получим данные из корзины
        $prodCart = Cart::getProducts();

        if($prodCart){
            // Получаем полную информацию о товарах для списка
            $prodId = array_keys($prodCart);

            $products = \models\Product::getProductsByIds($prodId);

            // Получаем общую стоимость товара
            $totPrice = Cart::getTotalPrice($products);
        }
        require_once (ROOT ."/views/cart/index.php");
        return true;
    }

    public function actionCheckout() {

        // Список категорий для левого меню
        $categories = \models\Category::getCategoriesList();

        // Статус успешного оформления заказа
        $result = false;

        // Форма отправлена?
        if (isset($_POST['submit'])) {
            $userName = trim(htmlspecialchars($_POST['userName']));
            $userPhone = trim(htmlspecialchars($_POST['userPhone']));
            $userComment = trim(htmlspecialchars($_POST['userComment']));

            // Валидация полей
            $errors = false;
//            $errors = true;

            if (!\models\User::checkName($userName)) {
                $errors[] = 'Неправильное имя';
            }
            if (!\models\User::checkPhone($userPhone)) {
                $errors[] = 'Неправильный телефон';
            }

            // Форма заполнена корректно?
            if ($errors == false) {
                // Собираем информацию о заказе
                $prodCart = Cart::getProducts();
                if (\models\User::isGuest()) {
                    $userId = false;
                } else {
                    $userId = \models\User::checkLogged();
                }

                // Сохраняем заказ в БД
                $result = \models\Order::save($userName, $userPhone, $userComment, $userId, $prodCart);

                if ($result) {
                    $adMail = 'kundyuba@gmail.com';
                    $message = 'http://mysite.loc/admin/orders';
                    $subject = 'Новый заказ';
                    mail($adMail, $subject, $message);

                    // Очищаем корзину
                    Cart::clear();
                }
            } else {
                // Итоги: общая стоимость, количество товаров
                $prodCart = Cart::getProducts();
                $prodId = array_keys($prodCart);
                $products = \models\Product::getProductsByIds($prodId);
                $totPrice = Cart::getTotalPrice($products);
                $totQuantity = Cart::countItems();
            }
        } else {
            // Форма отправлена? - Нет
            // Получием данные из корзины
            $prodCart = Cart::getProducts();
            // В корзине есть товары?
            if ($prodCart == false) {
                // Отправляем пользователя на главную искать товары
                header("Location: http://mysite.loc/");
            } else {
                // В корзине есть товары? - Да
                // Итоги: общая стоимость, количество товаров
                $prodId = array_keys($prodCart);
                $products = \models\Product::getProductsByIds($prodId);
                echo $totPrice = Cart::getTotalPrice($products);
                echo $totQuantity = Cart::countItems();

                $userName = false;
                $userPhone = false;
                $userComment = false;

                // Пользователь авторизирован?
                if (\models\User::isGuest()) {
                    // Значения для формы пустые
                } else {
                    // Получаем информацию о пользователе из БД по id
                    $userId = \models\User::checkLogged();
                    $user = \models\User::getUserById($userId);
                    // Подставляем в форму
                    $userName = $user['name'];
                }
            }
        }

        require_once(ROOT . "/views/cart/checkout.php");

        return true;
    }

}