<?php
namespace App\Classes\Components;




class AcaoTabelaComponent{
    

    public static function acaoTabela($preFix,$id,$nome,$funcionNome){
        
        $name = $preFix.'_nome';
        $componet = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">';
        $componet.= '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal'.$preFix.$id.'"><i class="bi bi-trash"></i></button>';  
        $componet.= '<button type="button" class="btn btn-success"  onclick="edit'.$funcionNome.'('.$id.')"><i class="bi bi-pencil"></i></button>';                
        $componet.= '</div>';
        $componet.= '<div class="modal fade" id="modal'.$preFix.$id.'" data-bs-backdrop="static"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"  aria-hidden="true">';
        $componet.= '<div class="modal-dialog modal-dialog-centered">';
        $componet.= '<div class="modal-content">';
        $componet.= '<div class="modal-header"> <h5 class="modal-title" id="staticBackdropLabel">Excluir</h5>  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>';
        $componet.= '<div class="modal-body"><h6>Deseja mesmo excluir '.$nome.'?</h6><p>Esta ação e ireversivel.</p></div>';
        $componet.= '<div class="modal-footer">';
        $componet.= '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>';
        $componet.= '<button type="button" class="btn btn-danger"  onclick="deletar'.$funcionNome.'('.$id. ')">Excluir</button>';
        $componet.= '</div></div></div></div>';
        $componet.= ' <INPUT TYPE="hidden" id="'.$preFix.'_codigo'.$id.'" NAME="'.$preFix.'Edit" VALUE="'.$id.'"  $nome="'.$nome.'" >' ;
        return $componet;

    }
}