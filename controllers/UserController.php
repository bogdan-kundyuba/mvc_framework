<?php

require_once ROOT ."/models/User.php";

class UserController {
    
    public function actionRegister() {

        $name = '';
        $email = '';
        $password = '';
        $result = false;
        
        if(isset($_POST['submit'])){
            $name = trim(htmlspecialchars($_POST['name']));
            $email = trim(htmlspecialchars($_POST['email']));
            $password = trim(htmlspecialchars($_POST['password']));
            
//            $errors = true;
            $errors = false;

            if(!\models\User::checkName($name)){
                $errors[] = "Имя не должно быть короче 2-x символов!";
//                $errors = false;
//                echo "<div class='col-sm-4 col-sm-offset-4 padding-right'><ul><li> Имя не должно быть короче 2-x символов!</li></ul></div>";
            }

            if(!\models\User::checkEmail($email)){
                $errors[] = "Неправильный email!";
//                $errors = false;
//                echo "<ul><li> Неправильный email!</li></ul>";
            }

            if(!\models\User::checkPassword($password)){
                $errors[] = "Пароль не должнен быть короче 6-символов!";
//                $errors = false;
//                echo "<ul><li> Пароль не должнен быть короче 6-символов!</li></ul>";
            }

            if(\models\User::checkEmailExists($email)){
                $errors[] = "Такой email уже существует!";
//                $errors = false;
//                echo "<ul><li> Такой email уже существует!</li></ul>";
            }
            
            if($errors == false){
                $result = \models\User::register($name, $email, $password);
            } 
        }
        
        require_once (ROOT. "/views/user/register.php");
        
        return true;
    }
    
    public function actionLogin() {
        
        $email = "";
        $password = "";
        
        if(isset($_POST['submit'])){
            $email = trim(htmlspecialchars($_POST['email']));
            $password = trim(htmlspecialchars($_POST['password']));
            
            $errors = false;
//            $errors = true;
            
            // Валидация полей
            if(!\models\User::checkEmail($email)){
                $errors[] = "Неправильный email!";
            }

            if(!\models\User::checkPassword($password)){
                $errors[] = "Пароль не должнен быть короче 6-символов!";
            }
            
            //Проверяем существует ли пользователь
            $userId = \models\User::checkUser($email,$password);
            
            if($userId == false){
                // Если данные неправильные - показываем ошибку
                $errors[] = "Неправильные данные для входа на сайт";
            } else {
                // Если данные правильные, запоминаем пользователя (сессия)
                \models\User::auth($userId);
                
                // Перенаправляем пользователя в закрытую часть - кабинет 
                header("Location: http://mysite.loc/cabinet/");
            }
        }
        
        require_once (ROOT. "/views/user/login.php");
        return true;
    }
    
    
    public function actionLogout() {
        unset($_SESSION['user']);
        header("Location: http://mysite.loc/");

        return true;
    }
}

?>