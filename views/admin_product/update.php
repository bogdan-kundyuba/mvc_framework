<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section>

        <div class="container">
            <div class="row">
                <br>

                <div class="breadcrumbs">

                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li><a href="/admin/product">Управление товарами</a></li>
                        <li class="active">Редактировать товар</li>
                    </ol>

                </div>
                <h4>Редактировать товар</h4>

                <br>
                <div class="col-lg-4">
                    <div class="login-form">
                        <form method="post" enctype="multipart/form-data">
                            <p>Название товара</p>
                            <input type="text" name="name" placeholder="" value="">
                            <p>Артикул</p>
                            <input type="text" name="code" placeholder="" value="">
                            <p>Стоимость, $</p>
                            <input type="text" name="price" placeholder="" value="">
                            <p>Категория</p>
                            <select name="category_id">
                                <?php if (is_array($categoriesList)) { ?>
                                    <?php foreach ($categoriesList as $category) { ?>
                                        <option value="<?php $category['id']; ?>"
                                            <?php if ($product['category_id'] == $category['id']) echo 'selected="selected"'; ?>>
                                            <?php echo $category['name']; ?>
                                        </option>
                                    <?php } ?>
                                <?php } ?>
                            </select>

                            <br><br>
                            <p>Производитель</p>
                            <input type="text" name="brand" placeholder="" value="<?php echo $product['brand']; ?>">
                            <p>Изображение товара</p>
                            <img src="" width="200" alt=""/>
                            <input type="file" name="image" placeholder="" value="">
                            <p>Детальное описание</p>
                            <textarea name="description"></textarea>
                            <br><br>
                            <p>Наличие на складе</p>
                            <select name="availability">
                                <option value="1">Да</option>
                                <option value="0">Нет</option>
                            </select>

                            <br/><br/>

                            <p>Новинка</p>
                            <select name="is_new">
                                <option value="1">Да</option>
                                <option value="0">Нет</option>
                            </select>

                            <br/><br/>

                            <p>Рекомендуемые</p>
                            <select name="is_recommended">
                                <option value="1">Да</option>
                                <option value="0">>Нет</option>
                            </select>

                            <br/><br/>

                            <p>Статус</p>
                            <select name="status">
                                <option value="1">Отображается</option>
                                <option value="0">Скрыт</option>
                            </select>

                            <br/><br/>

                            <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                            <br/><br/>

                        </form>

                        </form>
                    </div>

                </div>
            </div>
        </div>

    </section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>