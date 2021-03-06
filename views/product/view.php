<?php require_once ROOT. "/views/layouts/header.php";?>
       
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            <?php foreach($categories as $categoryItem){ ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="/category/<?php echo $categoryItem['id'];?>"><?php echo $categoryItem['name'];?></a></h4>
                                </div>
                            </div>
                            <?php  } ?>

                        </div><!--/category-products-->

                    </div>
                </div>

                    <div class="col-sm-9 padding-right">
                        <div class="product-details"><!--product-details-->
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="view-product">
                                        <img src="/public/images/product-details/1.jpg" alt="" />
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="product-information"><!--/product-information-->
                                        <img src="/public/images/product-details/new.jpg" class="newarrival" alt="" />
                                        <h2><?php echo $prod['name'];?></h2>
                                        <p>Код товара: <?php echo $prod['code'];?></p>
                                        <span>
                                            <span><?php echo $prod['price'];?></span>
                                            <label>Количество:</label>
                                            <input type="text" value="1" />
                                            <a href="http://mysite.loc/cart/add/<?php echo $prod['id'];?>" class="btn btn-default cart" data-id="<?php echo $prod['id']; ?>" >
                                                <i class="fa fa-shopping-cart"></i>
                                                В корзину
                                            </a>
                                        </span>
                                        <p><b>Наличие:</b> На складе</p>
                                        <p><b>Состояние:</b> Новое</p>
                                        <p><b>Производитель:</b> <?php echo $prod['brand'];?></p>
                                    </div><!--/product-information-->
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-sm-12">
                                    <h5>Описание товара</h5>
                                    <p><?php echo $prod['description'];?></p>
                                </div>
                            </div>
                        </div><!--/product-details-->

                    </div>
                </div>
            </div>
        </section>

<?php require_once ROOT. "/views/layouts/footer.php";?>     