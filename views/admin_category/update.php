<?php require_once ROOT. "/views/layouts/header_admin.php"; ?>

<section>
    <div class="container">
        <div class="row">
            <br>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление категориями</li>
                    <li class="active">Редактировать категорию</li>
                </ol>
            </div>

            <h4>Редактировать категорию </h4>

            <br>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post">

                        <p>Название</p>
                        <input type="text" name="name" placeholder="" value="">

                        <p>Порядковый номер</p>
                        <input type="text" name="sort_order" placeholder="" value="">

                        <p>Статус</p>
                        <select name="status">
                            <option value="1">Отображаеться</option>
                            <option value="0">Скрыто</option>
                        </select>

                        </br></br>

                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once ROOT. "/views/layouts/footer_admin.php"; ?>