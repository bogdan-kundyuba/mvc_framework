<?php require_once ROOT. "/views/layouts/header_admin.php"; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/order">Управление заказами</a></li>
                    <li class="active">Удалить заказ</li>
                </ol>

                <h4>Удалить категорию #<?php echo $id; ?></h4>

                <p>Вы действительно хотите удалить эту категорию?</p>

                <form method="post">
                    <input type="submit" name="submit" value="Удалить">
                </form>

            </div>

            <br>
        </div>
    </div>
</section>

<?php require_once ROOT. "/views/layouts/footer_admin.php"; ?>