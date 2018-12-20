<?php

require_once ROOT . "/models/AdminBase.php";
require_once ROOT. "/models/Category.php";

class AdminCategoryController extends AdminBase {

    public function actionIndex() {
        // Check access
        parent::__construct();
        // Get category list
        $categoryList = \models\Category::getCategoriesListAdmin();
        echo "<pre>";
        print_r($categoryList);
        echo "</pre>";

        require_once (ROOT. "/views/admin_category/index.php");
        return true;
    }

    public function actionCreate() {
        // Check access
        parent::__construct();
    }

    /**
     * Action для страницы "Добавить категорию"
     */
    public function actionUpdate($id) {
        // Check access
        parent::__construct();

        // Get data from about a specific category
        $category = \models\Category::getCategoryById($id);
        echo "<pre>";
        print_r($category);
        echo "</pre>";

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

            header("Location: http://mysite.loc/admin/category");
        }
        require_once(ROOT. "/views/admin_category/delete.php");
        return true;
    }
}