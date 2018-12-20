<?php

class Router {
    
    private $routes;
    
    
    public function __construct() {
        // Путь к роутам(к базовой директории файлов)
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }
    
    /**
    *
    *Returns request string
    **/
    private function getUri() {
        //   Получаем строку запроса
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        } 
    }
    
    
    public function run() {
        // Получаем строку запроса
        $getUri = $this->getUri();
        
        // Проверить наличие такого маршрута в routes.php
        foreach($this->routes as $pattern=>$route){
            
            // Сравниваем $pattern и $getUri
            if(preg_match("~$pattern$~",$getUri)){
                
                // Получаем внутренний путь из внешнего согласно правилу
                $internalRoute = preg_replace("~$pattern$~",$route,$getUri);
                
                // Разбиваем внутренний путь на сегменты.
                $segments = explode('/',$internalRoute);
//                print_r($segments);
                
                // Первый сегмент — контроллер.
                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);
                
                // Первый сегмент — контроллер.
                $actionName = 'action' . ucfirst(array_shift($segments));
//                echo "<br> Class: ".$controllerName;
//                echo "<br> Method: ".$actionName;
                
                $parameters = $segments;
                
                // Подключаем файл контроллера, если он имеется
                $controllerFile = ROOT.'/controllers/'.
                    $controllerName.'.php';
                
                if(file_exists($controllerFile)){
                    include_once($controllerFile);
                }
                
                // Создаем обьект, вызываем метод
                if(class_exists($controllerName)){
                    $controllerObject = new $controllerName;
                    
                    $res= call_user_func_array(array($controllerObject, $actionName), $parameters);
//                    $res = $controllerObject->$actionName();
                    if($res != null){
                        break;
                    }
                }  
            }
        }                   
    }
}

?>