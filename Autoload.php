<?php

spl_autoload_register(function($class_name) {
    require_once $_SERVER["DOCUMENT_ROOT"]."/components/".$class_name.".php";
});


?>