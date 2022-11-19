<?php
namespace MF\Init;


abstract class Bootstrap{

    private $routes;

    abstract protected  function iniRoutes();

    public function __construct(){
        $this->iniRoutes();
        $this->run($this->getUrl());
    }
    public function getRoutes(){
        return $this->routes;
    }
    public function setRoutes($routes){
        $this->routes = $routes;
    }
    protected function run($url){
        foreach($this->routes as $key =>$route){
          if($route['route']==$url){
             $class = "App\\Controllers\\".ucfirst($route['controller']);
             $controller = new $class;
             $action =$route['action'];
             $controller->$action();
           }
         }
      }
    protected function getUrl(){
        return parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
    }
}