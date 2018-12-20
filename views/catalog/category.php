<?php include_once ROOT ."/views/layouts/header.php"; ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Каталог</h2>
                        <div class="panel-group category-products">
                            <?php foreach ($categories as $categoriesItem) { ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a href="/category/<?php echo $categoriesItem['id']; ?>"
                                                                   class="<?php if ($categoryId == $categoriesItem['id']) echo 'active'; ?>"><?php echo $categoriesItem['name']; ?>
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Последние товары</h2>

                        <?php foreach ($categoryProducts as $product) { ?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="/public/images/home/product1.jpg" alt=""/>
                                            <h2><?php echo $product['price']; ?>грн.</h2>
                                            <p>
                                                <a href="/product/<?php echo $product['id']; ?>">ID:<?php echo $product['id']; ?>
                                                    , <?php echo $product['name']; ?></a>
                                            </p>
                                            <a href="http://mysite.loc/cart/add/<?php echo $product['id']; ?>" class="btn btn-default add-to-cart" data-id="<?php echo $product['id']; ?>"><i
                                                        class="fa fa-shopping-cart"></i>В корзину</a>
                                        </div>
                                        <?php if ($product['is_new']) { ?>
                                            <img src="/public/images/home/new.png" class="new" alt=""/>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- Постраничная навигация -->
                        <div class="col-md-4 col-md-offset-4">
                            <?php echo $pagination->get(); ?>
                        </div>

                    </div><!--features_items-->

                </div>
            </div>
        </div>

    </section>

<?php include_once ROOT ."/views/layouts/footer.php"; ?>