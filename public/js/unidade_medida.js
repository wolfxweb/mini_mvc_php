
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

  console.log(id)

let url = 'http://localhost:8000/adm/delete_unidade'
  axios.post(url, {
    unid_id: id,
  })
    .then(function (response) {
    //  toasty('Cadastro excluído com sucesso')
      setTimeout(function () {
        window.location.reload();
      }, 2000);
    })
    .catch(function (error) {
      console.log(error)
    })
}

function editUnidadeMedida(id){
  console.log(id);
  
  let unid_id = id
  let ctn = 'cat_id' + unid_id
  let unidadeMedida = document.getElementById(ctn)
  let unid_nome = unidadeMedida.getAttribute('catNome')
   document.getElementById('titulo-unidade-medida').innerHTML ="Edição unidade medida"

  document.getElementById('unid_id').value = id
  document.getElementById('unid_nome').value = unid_nome
  let canva = document.getElementById('offcanvasRight-unidade-medida')
  canva.classList.add("show")
  
}

 function closeCanvaUnidadeMedida(){
  console.log('4458')
  let canvaUnidadeMedida = document.getElementById('offcanvasRight-unidade-medida')
  canvaUnidadeMedida.classList.remove("show")
  window.location.reload();
}