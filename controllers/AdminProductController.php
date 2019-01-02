<?php

require_once ROOT . "/models/AdminBase.php";
require_once ROOT . "/models/Product.php";
require_once ROOT . "/models/Category.php";

class AdminProductController extends AdminBase {

    public function actionIndex() {
        // Check access
        parent::__construct();

        // Получаем список товаров
        $prodList = \models\Product::getProductList();

        // Include view file
        require_once(ROOT . "/views/admin_product/index.php");
        return true;
    }

    public function actionCreate() {
        // Check access
        parent::__construct();

        // Get the list of categories for the drop-down list
        $categoriesList = \models\Category::getCategoriesListAdmin();
//        print_r($categoriesList);

        if(isset($_POST['submit'])){
            $options['name'] = trim($_POST['name']);
            $options['code'] = trim($_POST['code']);
            $options['price'] = trim($_POST['price']);
            $options['category_id'] = trim($_POST['category_id']);
            $options['brand'] = trim($_POST['brand']);
            $options['availability'] = trim($_POST['availability']);
            $options['description'] = trim($_POST['description']);
            $options['is_new'] = trim($_POST['is_new']);
            $options['is_recommended'] = trim($_POST['is_recommended']);
            $options['status'] = trim($_POST['status']);

            // Errors flag
            $errors = false;

            if (!isset($options['name']) || empty($options['name'])){
                $errors [] = 'Заполните поля!';
            }

            if($errors == false){
                // if no errors
                // add new product
                $id = \models\Product::createProduct($options);

                //if query added
                if ($id){
                    // Check whether the images were loaded through the form
//                    echo "<pre>"; print_r($_FILES['image']); die();
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])){
                        move_uploaded_file($_FILES["image"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."/upload/images/products/{$id}.jpg");
                    }
                }
                // Redirecting the user to the product management page
                header("Location: http://mysite.loc/admin/product");
            }
        }
        require_once (ROOT. "/views/admin_product/create.php");
        return true;
    }

    public function actionUpdate($id) {
        // Check access
        parent::__construct();

        // Get the list of categories for the drop-down list
        $categoriesList = \models\Category::getCategoriesListAdmin();
        print_r($categoriesList);

        $product = \models\Product::getProductById($id);
//        print_r($product);

        // Form processing
        if (isset($_POST['submit'])) {
            $options['name'] = trim($_POST['name']);
            $options['code'] = trim($_POST['code']);
            $options['price'] = trim($_POST['price']);
            $options['category_id'] = trim($_POST['category_id']);
            $options['brand'] = trim($_POST['brand']);
            $options['availability'] = trim($_POST['availability']);
            $options['description'] = trim($_POST['description']);
            $options['is_new'] = trim($_POST['is_new']);
            $options['is_recommended'] = trim($_POST['is_recommended']);
            $options['status'] = trim($_POST['status']);

            // Save changes
            if ($res = \models\Product::updateProductById($id, $options)) {
//                print_r($res);
                // if record saved
                // Check if the image is loaded via the form
                if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                    // If downloaded, move it to the desired folder, give a new name.
                    move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] ."/upload/images/products/{$id}.jpg");
                }
            }
            // Redirect user to product management page
            header("Location: http://mysite.loc/admin/product");
        }

        require_once (ROOT. "/views/admin_product/update.php");
        return true;
    }

    public function actionDelete($id) {
        // check access
        parent::__construct();

        if(isset($_POST['submit'])){
           // if form is send
           // delete product
           \models\Product::deleteProductById($id);

           // redirect user to product management page
           header("Location: http://mysite.loc/admin/product");
        }
        // Include view file
        require_once (ROOT . "/views/admin_product/delete.php");
        return true;
    }
}

