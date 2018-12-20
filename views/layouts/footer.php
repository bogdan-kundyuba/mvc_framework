<footer id="footer"><!--Footer-->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2018</p>
                <p class="pull-right">Курс PHP</p>
            </div>
        </div>
    </div>
</footer><!--/Footer-->

<!--slider-->
<script src="/public/js/jquery.js"></script>
<script src="/public/js/jquery.cycle2.min.js"></script>
<script src="/public/js/jquery.cycle2.carousel.min.js"></script>
<!--slider-->

<script src="/public/js/jquery.js"></script>
<script src="/public/js/bootstrap.min.js"></script>
<script src="/public/js/jquery.scrollUp.min.js"></script>
<script src="/public/js/price-range.js"></script>
<script src="/public/js/jquery.prettyPhoto.js"></script>
<script src="/public/js/main.js"></script>
<script>
    $(document).ready(function () {
        $(".add-to-cart").click(function () {
            var id = $(this).attr("data-id")
            $("/cart/addAjax/" + id
            {
            }
        ,

            function (data) {
                $("#cart-count").html(data);
            )
        };
        return false;
    )
    };
    )
    }
</script>
</body>
</html>