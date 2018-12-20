<?php session_start();
ob_start();

//$string = "17-09-2018";
//
//$pattern = "/([0-9]{2}) - ([0-9]{2}) - ([0-9]{4})/";
//
//$replace = "Год$3, месяц$2, день$1";

//echo preg_replace($pattern, $replace, $string);


//die;


// Month: 09, Day: 17, Year: 2018!

//FRONT CONTROLLER


// Composer files
include_once $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();


//1. General settings
ini_set('display_errors',1);
error_reporting(E_ALL);

//session_start();



//2. Connecting system files
define('ROOT', dirname(__FILE__));
require_once(ROOT."/Autoload.php");
require_once(ROOT.'/components/Router.php');
require_once(ROOT.'/components/Db.php');


//3. Db files connection


//4. Call Router
$router = new Router();
$router->run();