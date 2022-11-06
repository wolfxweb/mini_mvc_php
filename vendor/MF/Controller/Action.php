<?php

namespace MF\Controller;


abstract class Action{

    protected  $view;

    public function __construct(){
      $this->view = new \stdClass;
    }
    protected function render($view , $layout = false){
      /*
        caso tem mais de um layot pode ser passado no paramentro layout
        inportante atualmente esta verificado a raiz na pasta view
      */
      if(!$layout){
        $layout ="layout";
      }

      $this->view->page = $view;
      require_once"../App/View/".$layout.".phtml";
     // $this->content();
    }
    protected  function content(){
      require_once"../App/View/".$this->view->page.".phtml";
    }
    

}