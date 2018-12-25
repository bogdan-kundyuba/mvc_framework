<?php

require_once ROOT . "/models/AdminBase.php";
require_once ROOT . "/models/Order.php";
require_once ROOT . "/models/Product.php";

class AdminOrderController extends AdminBase {

    public function actionIndex(){
        // Check access
        parent::__construct();

        // Get order list
        $orderList = \models\Order::getOrderList();

        // Include template file
        require_once(ROOT. "/views/admin_order/index.php");
        return true;
    }

    public function actionView($id){
        // Check access
        parent::__construct();

        // Получаем данные о конкретном заказе
        $order = \models\Order::getOrderById($id);

        // Получаем массив с идентификаторами и количеством товаров
        $productsQuantity = json_decode($order['products'], true);

        // Получаем массив с индентификаторами товаров
        $prodIds = array_keys($productsQuantity);

        // Получаем список товаров в заказе
        $products = \models\Product::getProductsByIds($prodIds);

        require_once(ROOT. "/views/admin_order/view.php");
        return true;
    }

    public function actionUpdate($id){
        // Check access
        parent::__construct();

        // Получаем данные о конкретном заказе
        $order = \models\Order::getOrderById($id);

        // Process form data
        if(isset($_POST['submit'])){
            // If form send
            // Get data from form
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            $date = $_POST['date'];
            $status = $_POST['status'];

            // Save changes
            \models\Order::updateOrderById($id, $userName, $userPhone, $userComment, $date, $status);

            // Redirect user to the order management page
            header("Location: http://mysite.loc/admin/order/view/$id");
        }

        require_once(ROOT. "/views/admin_order/update.php");
        return true;
    }

    public function actionDelete($id){
        // Check access
        parent::__construct();

        if(isset($_POST['submit'])){

            \models\Order::deleteOrderById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: http://mysite.loc/admin/order");
        }

        require_once(ROOT. "/views/admin_order/delete.php");
        return true;
    }
}