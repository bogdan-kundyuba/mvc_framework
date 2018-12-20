<?php
namespace models;

class User extends \components\Db {
    
    public static function register($name, $email, $password) {
        $db = self::getConnection();

        $hash = password_hash($password,PASSWORD_DEFAULT);
        $pdo7 = $db->prepare("INSERT INTO user (name,email,password) VALUES (?,?,?)");
        $pdo7->bindParam(1,$name);
        $pdo7->bindParam(2,$email);
        $pdo7->bindParam(3,$hash);
        $pdo7->execute();
        return $pdo7;
    }

    public static function edit($id, $name, $password) {
        $db = self::getConnection();

        $pdo10 = $db->prepare("UPDATE user SET name=? password=? WHERE id=?");
        $pdo10->bindParam(1,$id);
        $pdo10->bindParam(2,$name);
        $pdo10->bindParam(3,$password);
        $pdo10->execute();
        $res = $pdo10->fetch(\PDO::PARAM_STR);
        print_r($res);
        return $res;
    }
    
    public static function checkUser($email, $password) {
        $db = self::getConnection();
        
        $pdo8 = $db->prepare("SELECT * FROM user WHERE email=?");
        $pdo8->bindParam(1,$email, \PDO::PARAM_STR);
//        $pdo8->bindParam(2,$password, \PDO::PARAM_STR);
        $pdo8->execute();
        
        $user = $pdo8->fetch();

        if(!empty($user['email'])){
            if(password_verify($password,$user['password'])) {
                return $user['id'];
            } else {
                return false;
            }
        }
    }
    
    public static function auth($userId) {
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged() {
        if(isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        header("Location: http://mysite.loc/user/login");
    }

    public static function isGuest() {
        if(isset($_SESSION['user'])){
            return false;
        }
        return true;
    }

    // Проверяет имя: не меньше чем 2 символа
    public static function checkName($name) {
        if(strlen($name) >= 2){
            return true;
        }
        return false;
    }

    public static function checkPhone($phone) {
        if(strlen($phone) >= 10){
            return true;
        }
        return false;
    }
    
    // Проверяем email
    public static function checkPassword($password) {
        if(strlen($password) >= 6){
            return true;
        }
        return false;
    }
    
     // Проверяет email: не меньше чем 6 символов
    public static function checkEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }
    
    public static function checkEmailExists($email) {
        $db = self::getConnection();

        $result = $db->prepare("SELECT * FROM user WHERE email = ?");
        $result->bindParam(1,$email);
        $result->execute();

        $array = $result->fetch();

        if(!empty($array['email'])) {
            return true;
        }else {
            return false;
        }
    }

    public static function getUserById($id) {
        if($id){
            $db = self::getConnection();

            $pdo9 = $db->prepare("SELECT * FROM user WHERE id=?");
            $pdo9->bindParam(1,$id);
            $pdo9->execute();
            $res = $pdo9->fetch(\PDO::FETCH_ASSOC);
            return $res;
        }
    }
}

?>