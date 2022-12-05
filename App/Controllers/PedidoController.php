<?php
namespace App\Controllers;


use MF\Controller\Action;

class PedidoController   extends Action{

    public function getTelaPedido(){
        $this->render('painel_adm/pedido');  
    }
    
}