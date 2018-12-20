<?php

namespace components;

class Db {
    
    protected static function getConnection() {
        $pdo = new \PDO("mysql: host=$_SERVER[host];dbname=$_SERVER[dbname]",$_SERVER['login'],$_SERVER['password']);
        return $pdo;
    }
}

?>