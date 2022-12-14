<?php
namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap{

    protected function iniRoutes(){
        $routes['home'] =array(
            'route'=> '/',
         //   'controller'=> 'IndexController',
         //  'action'=>'index'  
             'controller'=> 'PainelAdmController',
             'action'=>'loadTelaAdm'    
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
        $routes['edicao_categoria'] =array(
            'route'=> '/adm/edicao_categoria',
            'controller'=> 'CategoriasController',
            'action'=>'edicaoCategoria'   
        );
        $routes['delete_categoria'] =array(
            'route'=> '/adm/delete_categoria',
            'controller'=> 'CategoriasController',
            'action'=>'deleteCategoria'   
        );
        $routes['filtrar_categoria'] =array(
            'route'=> '/adm/filtrar_categoria',
            'controller'=> 'CategoriasController',
            'action'=>'filtrarCategoria'   
        );
        $routes['tabela_categorias'] =array(
            'route'=> '/adm/tabela_categorias',
            'controller'=> 'CategoriasController',
            'action'=>'tabelaCategorias'   
        );
        
         /** rotas unidade mendidas */
        $routes['unidade_medida'] =array(
            'route'=> '/adm/unidade_medida',
            'controller'=> 'UnidadeMedidaController',
            'action'=>'loadTelaUnidadeMedida'   
        );
        $routes['tabela_unidade'] =array(
            'route'=> '/adm/tabela_unidade',
            'controller'=> 'UnidadeMedidaController',
            'action'=>'tabelaUnidadeMedida'   
        );
        $routes['delete_unidade'] =array(
            'route'=> '/adm/delete_unidade',
            'controller'=> 'UnidadeMedidaController',
            'action'=>'deleteUnidadeMedida'   
        );
        $routes['adicionar-atualizar'] =array(
            'route'=> '/adm/adicionar-atualizar',
            'controller'=> 'UnidadeMedidaController',
            'action'=>'adicionarAtualizarUnidadeMedida'   
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
        $routes['tabela_produto'] =array(
            'route'=> '/adm/tabela-produto',
            'controller'=> 'ProdutoController',
            'action'=>'tabelaProdutos'   
        );
        $routes['deletar_produto'] =array(
            'route'=> '/adm/deletar-produto',
            'controller'=> 'ProdutoController',
            'action'=>'deletarProduto'   
        );
        $routes['categorias-unidades-medidas-produto'] =array(
            'route'=> '/adm/categorias-unidades-medidas-produto',
            'controller'=> 'ProdutoController',
            'action'=>'categoriasUnidadesMedidasProduto'   
        );
        $routes['acao-produto'] =array(
            'route'=> '/adm/acao-produto',
            'controller'=> 'ProdutoController',
            'action'=>'acaoProduto'   
        );
        //**pedido */
        $routes['pedido'] =array(
            'route'=> '/adm/pedido',
            'controller'=> 'PedidoController',
            'action'=>'getTelaPedido'   
        );
         //**pedido */
         $routes['api-categoria'] =array(
            'route'=> '/api-categoria',
            'controller'=> 'CategoriasController',
            'action'=>'apiGetAllCategoria'   
        );
        $routes['api-categoria-id'] =array(
            'route'=> '/api-categoria-id',
            'controller'=> 'CategoriasController',
            'action'=>'apiGetCategoriaId'   
        );
       $this->setRoutes($routes);
    }
}