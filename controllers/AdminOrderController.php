<?php

require_once ROOT . "/models/AdminBase.php";
require_once ROOT . "/models/Order.php";

class AdminOrderController extends AdminBase {

    public function actionIndex(){
        // Check access
        parent::__construct();

        // Get order list
        $orderList = \models\Order::getOrderList();
        print_r($orderList);

        // Include template file
        require_once(ROOT. "/views/admin_order/index.php");
        return true;
    }

    public function actionView($id){
        // Check access
        parent::__construct();

        // Получаем данные о конкретном заказе
        $order = \models\Order::getOrderById($id);

        if(isset($_POST['submit'])){
            // If form send
            // Get data from form
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
        }
    }

    public function actionUpdate(){

    }

    public function actionDelete(){

    }
}