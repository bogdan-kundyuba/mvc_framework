<?php session_start();
ob_start();

//FRONT CONTROLLER

// Composer files
include_once $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";


// environment variables
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();


//2. General settings
ini_set('display_errors',1);
error_reporting(E_ALL);


//3. Connecting system files
define('ROOT', dirname(__FILE__));
require_once(ROOT."/Autoload.php");
require_once(ROOT.'/components/Router.php');
require_once(ROOT.'/components/Db.php');


//4. Call Router
$router = new Router();
$router->run();