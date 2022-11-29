
$(document).ready(function () {

  $('#unidadeMedida').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: 'http://localhost:8000/adm/tabela_unidade',
      type: "POST"
    },
    "columns": [
      { "data": "unid_id" },
      { "data": "unid_nome" },
      { "data": "unid_acao" }
    ],
    "language":{
      "url":"//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json"
    }
  });
});


function deletarUnidadeMedida(id){

let url = 'http://localhost:8000/adm/delete_unidade'
  axios.post(url, {
    unid_id: id,
  })
    .then(function (response) {
      toastPrincipal('Cadastro excluído com sucesso')
    
    })
    .catch(function (error) {
      console.log(error)
    })
}

function editUnidadeMedida(id){

  let unid_id = id
  let ctn = 'unid_codigo' + unid_id
  let unidadeMedida = document.getElementById(ctn)
  let unid_nome = unidadeMedida.getAttribute('unid_nome')
  document.getElementById('titulo-unidade-medida').innerHTML ="Edição unidade medida"
  document.getElementById('unidId').value = id
  document.getElementById('unidNome').value = unid_nome
  let canva = document.getElementById('offcanvasRight-unidade-medida')
  canva.classList.add("show")

}

 function closeCanvaUnidadeMedida(){
  console.log('4458')
  let canvaUnidadeMedida = document.getElementById('offcanvasRight-unidade-medida')
  canvaUnidadeMedida.classList.remove("show")
  window.location.reload();
}

function sendFormularioUnidadeMedida(event){
  event.preventDefault()
  let uniId =document.getElementById('unidId').value
  let unidnome =document.getElementById('unidNome').value

  if(unidnome =="" ){
    toasty("Nome unidade de medida e obrigatório.","ERROR")
    return false;
  }
  let msdAlerta = uniId?"Cadastro atualizado":"Cadastro adicionado"
  let url = document.getElementById('HTTP_HOST').value +'/adm/adicionar-atualizar'
  console.log(url)
  axios.post(url, {
    unid_id:uniId,
    unid_nome:unidnome
  })
    .then(function (response) {
      toasty(msdAlerta)
     
    })
    .catch(function (error) {
      console.log(error)
    })

}
