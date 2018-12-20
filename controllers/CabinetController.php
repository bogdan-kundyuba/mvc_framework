<?php

require_once ROOT. "/models/User.php";

class CabinetController {
    
    public function actionIndex() {

        // Получаем идентификатор пользователя из сессии
        $userId = \models\User::checkLogged();

        //
        $user = \models\User::getUserById($userId);

        require_once (ROOT . "/views/cabinet/index.php");
        
        return true;
    }

    public function actionEdit() {

        // Получаем идентификатор пользователя из сессии
        $userId = \models\User::checkLogged();

        // Получаем информацию о пользователе из БД
        $user = \models\User::getUserById($userId);

        $name = $user['name'];
        $password = $user['password'];

        $result = false;

        if(isset($_POST['submit'])) {
            $name = trim($_POST['name']);
            $password = trim($_POST['password']);

            $errors = false;

            if(!\models\User::checkName($name)){
                $errors[] = "Имя не должно быть короче 2-x символов!";
//                $errors = false;
//                echo "<ul><li> Имя не должно быть короче 2-x символов!</li></ul>";
            }

            if(!\models\User::checkPassword($password)){
//                $errors[] = "Пароль не должнен быть короче 6-символов!";
                $errors = false;
                echo "<ul><li> Пароль не должнен быть короче 6-символов!</li></ul>";
            }

            if($errors == false){
                $result = \models\User::edit($userId, $name, $password);
            }

        }
        require_once (ROOT. "/views/cabinet/edit.php");

        return true;
    }
}

