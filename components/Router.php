<?php

/**
 * Created by PhpStorm.
 * User: Ivany
 * Date: 07.06.2016
 * Time: 23:08
 */
class Router
{
    private $routes;

    public function  __construct()
    {
        $routesPatch = ROOT.'/config/routes.php';
        $this->routes = include ($routesPatch);
    }

    private function getUri(){
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'],'/');
        }
}

    public function run(){
        // получаем строку с адресом
         $uri = $this->getUri();
        // ищем адрес в нашем масиве
        foreach($this->routes as $uriPattern => $path){

            if(preg_match("~$uriPattern~", $uri )){
                // Получаем внутрений путь из внешного
                $internalRouter = preg_replace("~$uriPattern~",$path ,$uri);
                // достаем имя контролера и екшена
                $segments = explode('/',$internalRouter);
                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action'.ucfirst(array_shift($segments));
                // Получаем параметры с урл
                $parameters = $segments;

                // подключаем контролер, создаем екземпляр класса и вызываем нужный екшен
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';

                if(file_exists($controllerFile)){
                    include_once ($controllerFile);
                }
                 $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if($result != null){
                    break;
                }
            }
        }

    }

}