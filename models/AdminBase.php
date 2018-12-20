<?php

require_once ROOT . "/models/User.php";

abstract class AdminBase {

    public function __construct() {
        // Проверяем авторизован пользователь, если нет, он будет переадресован
        $userId = \models\User::checkLogged();

        // Получаем информацию о текущем пользователе
        $user = \models\User::getUserById($userId);

        // Если роль текущего пользователя 'admin', пускаем в админпанель
        if($user['role'] == 'admin'){
            return true;
        }

        die('Access denied!');
    }
}