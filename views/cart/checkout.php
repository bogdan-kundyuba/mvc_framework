<?php require_once ROOT . "/views/layouts/header.php"; ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Каталог</h2>
                        <div class="panel-group category-products">
                            <?php foreach ($categories as $categoryItem) { ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="http://mysite.loc/category/<?php echo $categoryItem['id']; ?>">
                                                <?php echo $categoryItem['name']; ?>
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items">
                        <h2 class="title text-center">Корзина</h2>

                        <?php if ($result){ ?>
                            <p>Заказ оформлен. Мы Вам перезвоним.</p>

                        <?php } else { ?>
                            <p>Выбрано товаров: <?php echo $totQuantity; ?>, на сумму: <?php echo $totPrice; ?>, грн.</p>
                            <br>
                            <div class="col-sm-4">
                                <?php if (isset($errors) && is_array($errors)){?>
                                    <ul>
                                        <?php foreach ($errors as $error){ ?>
                                            <li> - <?php echo $error; ?></li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>

                                <p>Для оформления заказа заполните форму. Наш менеджер свяжется с Вами.</p>

                                <div class="login-form">
                                    <form method="post">
                                        <p>Ваша имя</p>
                                        <input type="text" name="userName" placeholder="Ваше имя" value="<?php echo $userName; ?>"/>

                                        <p>Номер телефона</p>
                                        <input type="text" name="userPhone" placeholder="Ваш номер телефона" value="<?php echo $userPhone; ?>"/>

                                        <p>Комментарий к заказу</p>
                                        <input type="text" name="userComment" placeholder="Сообщение" value="<?php echo $userComment; ?>"/>

                                        <br/>
                                        <br/>
                                        <input type="submit" name="submit" class="btn btn-default" value="Оформить"/>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

<?php require_once ROOT . "/views/layouts/footer.php"; ?>