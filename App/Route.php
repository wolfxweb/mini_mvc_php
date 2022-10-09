<?php
namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap{

    protected function iniRoutes(){
        $routes['home'] =array(
            'route'=> '/',
            'controller'=> 'IndexController',
            'action'=>'index'   
        );
        $routes['sobre_nos'] =array(
            'route'=> '/sobre_nos',
            'controller'=> 'IndexController',
            'action'=>'sobreNos'   
        );
        $routes['cadastro_usuario'] =array(
            'route'=> '/cadastro_usuario',
            'controller'=> 'usuarioController',
            'action'=>'getFomularioCadastro'   
        );
        $routes['adicionar_usuario'] =array(
            'route'=> '/adicionar_usuario',
            'controller'=> 'usuarioController',
            'action'=>'setUsuario'   
        );
        $routes['login'] =array(
            'route'=> '/login',
            'controller'=> 'usuarioController',
            'action'=>'getFormLogin'   
        );
       $this->setRoutes($routes);
    }
}