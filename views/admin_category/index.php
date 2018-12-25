<?php include ROOT. "/views/layouts/header_admin.php"; ?>
<?php require_once ROOT. "/models/Category.php"; ?>

<section>
    <div class="container">
        <div class="row">
            <br>
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление категориями</li>
                </ol>
            </div>
            <a href="/admin/category/create" class="btn btn-default back"><i class="fa fa-plus"> Добавить категорию</i></a>
            <h4>Список категорий</h4>
            <br>
            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID категории</th>
                    <th>Название категории</th>
                    <th>Порядковый номер</th>
                    <th>Статус</th>
                    <th>Редактирование</th>
                    <th></th>
                </tr>
                <?php foreach($categoryList as $category){ ?>
                <tr>
                    <td><?php echo $category['id']; ?></td>
                    <td><?php echo $category['name']; ?></td>
                    <td><?php echo $category['sort_order']; ?></td>
                    <td><?php echo \models\Category::getStatusText($category['status']); ?></td>
                    <td><a href="/admin/category/update/<?php echo $category['id'];?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                    <td><a href="/admin/category/delete/<?php echo $category['id'];?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

</section>

<?php require_once ROOT. "/views/layouts/footer_admin.php"; ?>