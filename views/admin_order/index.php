<?php require_once ROOT. "/views/layouts/header_admin.php"; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li class="active">Управление заказами</li>
                    </ol>
                    <h4>Список заказов</h4>
                </div>
                <br/>

                <table class="table-bordered table-striped table">
                    <tr>
                        <th>ID заказа</th>
                        <th>Имя покупателя</th>
                        <th>Телефон покупателя</th>
                        <th>Дата оформления</th>
                        <th>Статус</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>
                            <a href="/admin/order/view/">

                            </a>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><a href="/admin/order/view/"></a></td>
                        <td><a href="/admin/order/update/"></a></td>
                        <td><a href="/admin/order/update/"></a></td>
                    </tr>
                </table>
            </div>
        </div>
    </section>

<?php require_once ROOT. "/views/layouts/footer_admin.php"; ?>