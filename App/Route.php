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
        $routes['adm'] =array(
            'route'=> '/adm',
            'controller'=> 'PainelAdmController',
            'action'=>'loadTelaAdm'   
        );
        /** rotas categorias */
        $routes['categorias'] =array(
            'route'=> '/adm/categorias',
            'controller'=> 'CategoriasController',
            'action'=>'loadTelaCategoria'   
        );
        $routes['cadastro_categoria'] =array(
            'route'=> '/adm/cadastro_categoria',
            'controller'=> 'CategoriasController',
            'action'=>'cadastroCategoria'   
        );
         /** rotas unidade mendidas */
        $routes['unidade_medida'] =array(
            'route'=> '/adm/unidade_medida',
            'controller'=> 'UnidadeMedidaController',
            'action'=>'loadTelaUnidadeMedida'   
        );
           /** rotas fabricantes */
        $routes['fabricante'] =array(
            'route'=> '/adm/fabricante',
            'controller'=> 'FabricanteController',
            'action'=>'loadTelaFabricante'   
        );
        /** rotas produtos */
        $routes['produto'] =array(
            'route'=> '/adm/produto',
            'controller'=> 'ProdutoController',
            'action'=>'loadTelaProduto'   
        );
       $this->setRoutes($routes);
    }
}