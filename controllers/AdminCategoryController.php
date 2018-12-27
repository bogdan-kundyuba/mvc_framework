<?php

require_once ROOT . "/models/AdminBase.php";
require_once ROOT. "/models/Category.php";

class AdminCategoryController extends AdminBase {

    public function actionIndex() {
        // Check access
        parent::__construct();

        // Get category list
        $categoryList = \models\Category::getCategoriesListAdmin();

        // Include view file
        require_once (ROOT. "/views/admin_category/index.php");
        return true;
    }

    public function actionCreate() {
        // Check access
        parent::__construct();

        if(isset($_POST['submit'])) {
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];

            // Errors flag
            $errors = false;

            // Validate values as needed
            if (!isset($name) || empty($name)) {
                $errors[] = 'Заполните поля!';
            }

            if ($errors == false) {
                // If no errors
                // Add new category
                \models\Category::createCategory($name, $sortOrder, $status);

                // Redirect user to category managment page
                header("Location: http://mysite.loc/admin/category");
            }
        }

        require_once(ROOT. "/views/admin_category/create.php");
        return true;
    }

    /**
     * Action для страницы "Добавить категорию"
     */
    public function actionUpdate($id) {
        // Check access
        parent::__construct();

        // Get data from about a specific category
        $category = \models\Category::getCategoryById($id);
        print_r($category);

        // Form processing
        if (isset($_POST['submit'])){
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];

            // Save chenges
            \models\Category::getCategoryById($id, $name, $sortOrder, $status);

            // Redirect user to category management page
            header("Location: http://mysite.loc/admin/category");
        }

        // Include view file
        require_once(ROOT. "/views/admin_category/update.php");
        return true;
    }

    public function actionDelete($id) {
        // Check access
        parent::__construct();

        // Form processing
        if(isset($_POST['submit'])){
            // If form send
            // Delete category
            \models\Category::deleteCategoryById($id);

            // redirect user to category management page
            header("Location: http://mysite.loc/admin/category");
        }
        // Include view file
        require_once(ROOT. "/views/admin_category/delete.php");
        return true;
    }
}