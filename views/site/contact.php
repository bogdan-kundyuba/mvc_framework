<?php include_once ROOT . "/views/layouts/header.php"; ?>

<section>
    <div class="container">
        <div class="row">

           <div class="col-sm-4 col-sm-offset-4 padding-right">

               <?php if ($result) { ?>
                   <p>Сообщение отправлено! Мы ответим Вам на указанный email!</p>
               <?php } ?>
               <?php if (isset($errors) && is_array($errors)) { ?>
                   <ul>
                       <?php foreach ($errors as $error) { ?>
                           <li><?php echo $error; ?></li>
                       <?php } ?>
                   </ul>
               <?php } ?>

               <div class="signup-form">
                   <h2>Обратная связь</h2>
                   <h5>Есть вопросы? Напишите нам</h5>
                   <br>
                   <form method="post">
                       <p>Ваша почта</p>
                       <input type="email" name="userMail" placeholder="Email"/>
                       <p>Сообщение</p>
                       <input type="text" name="userText" placeholder="Сообщение" />
                       <input type="submit" name="submit" class="btn btn-default" value="Регистрация">
                   </form>
               </div>

               <br>
               <br>
           </div>
        </div>
    </div>
</section>

<?php include_once ROOT . "/views/layouts/footer.php"; ?>

