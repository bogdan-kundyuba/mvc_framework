<?php

require_once ROOT . "/models/AdminBase.php";

class AdminController extends AdminBase {
    
    public function actionIndex() {
        // Проверить пользователя
        parent::__construct();

        require_once (ROOT ."/views/admin/index.php");
        return true;
    }


}