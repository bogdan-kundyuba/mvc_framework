<?php

require_once ROOT ."/models/User.php";
require_once ROOT ."/models/Category.php";
require_once ROOT ."/models/Product.php";

class SiteController {
    
    public function actionIndex() {

        // Список категорий для левого меню
        $categories = \models\Category::getCategoriesList();

        // Список последних товаров
        \models\Product::$SHOW_BY_DEFAULT = 5;
        $latestProducts = \models\Product::getLatestProducts();

        // Список товаров для слайдера
        $sliderProd = \models\Product::getRecommendedProducts();
        
        require_once (ROOT ."/views/site/index.php");
        return true;
    }

    public function actionContact() {

        $userMail = '';
        $userText = '';
        $result = false;

        if(isset($_POST['submit'])){
            $userMail = trim($_POST['userMail']);
            $userText = trim($_POST['userText']);

            $errors = false;

            if(!\models\User::checkEmail($userMail)){
                $errors[] = "Неправильный еmail";
//                $errors = false;
            }

            if($errors == false){
                $adminMail = 'kundyuba@gmail.com';
                $message = "Текст: {$userText}От: {$userMail}";
                $subject = 'Тема письма';
                $result = mail($adminMail, $subject, $message);
                $result = true;
            }
        }

        require_once (ROOT."/views/site/contact.php");
        return true;
    }

    public function actionAbout() {
        // Include view file
        require_once (ROOT. "/views/site/about.php");
        return true;
    }

}