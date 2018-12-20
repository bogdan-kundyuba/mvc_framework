<?php include_once ROOT. "/views/layouts/header.php"; ?>

<section>
     <div class="container">
         <div class="row">

             <div class="col-sm-4 col-sm-offset-4 padding-right">
                 <?php if ($result) { ?>
                     <p>Вы зарегестрированы!</p>
                 <?php } ?>
                 <?php if (isset($errors) && is_array($errors)) { ?>
                     <ul>
                         <?php foreach ($errors as $error) { ?>
                             <li><?php echo $error; ?></li>
                         <?php } ?>
                     </ul>
                 <?php } ?>

                 <div class="signup-form">
                    <h2>Регистрация на сайте</h2>
                     <form method="post">
                         <input type="text" name="name" placeholder="Имя" />
                         <input type="email" name="email" placeholder="Email"/>
                         <input type="password" name="password" placeholder="Пароль" />
                         <input type="submit" name="submit" class="btn btn-default" value="Регистрация">
                     </form>
                 </div>
                 
                 <br>
                 <br>
             </div>
         </div>
     </div>   
</section>

<?php include_once ROOT ."/views/layouts/footer.php"; ?>