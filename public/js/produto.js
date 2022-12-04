

$(document).ready(function () {

  $('#tabelaProduto').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: 'http://localhost:8000/adm/tabela-produto',
      type: "POST"
    },
    "columns": [
      { "data": "pro_id" },
      { "data": "prod_nome" },
      { "data": "cat_id" },
      { "data": "unid_id" },
      { "data": "prod_preco" },
      { "data": "acao" }
    ],
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json"
    }
  });
});

function editProduto(id) {
  let canvaProduto = document.getElementById('offcanvasRight-produto')
  console.log(id)
  let url = 'http://localhost:8000/adm/categorias-unidades-medidas-produto'
    axios.post(url, {
      pro_id: id,
    })
      .then(function (response) {
       
        response.data.categorias.forEach(function (categoria) {
          let selecionado = false;
          if(response.data.produto != undefined  && parseInt(categoria.cat_id) === parseInt(response.data.produto[0].cat_id)){
            selecionado = true;
          }
          addOption(categoria.cat_id, categoria.cat_nome,selecionado,'categoria-select' ) 
        });
        response.data.unidadesMedidas.forEach(function (unidadeMedida) {
          let selecionado = false;
          if(response.data.produto != undefined  && parseInt(unidadeMedida.unid_id) === parseInt(response.data.produto[0].unid_id)){
            selecionado = true;
          }
          addOption(unidadeMedida.unid_id, unidadeMedida.unid_nome, selecionado,'unidade-medida-select')
        });
        
        console.log(response.data.produto[0])
        if(response.data.produto != undefined){
          console.log(response.data.produto[0])
          document.getElementById("proId").value = response.data.produto[0].pro_id
          document.getElementById("prodNome").value = response.data.produto[0].prod_nome
          document.getElementById("prodDescricao").value = response.data.produto[0].prod_descricao
          document.getElementById("prodPreco").value = response.data.produto[0].prod_preco
          
        }


      })
      .catch(function (error) {
        console.log(error)
      })

  canvaProduto.classList.add("show")
}

function addOption(valor, nome , select, idSelect ) {
  var option = new Option(nome, valor ,false, select);
  var select = document.getElementById(idSelect);
  select.add(option);
}



function deletarProduto(id) {
  console.log(id)
  let url = 'http://localhost:8000/adm/deletar-produto'
  axios.post(url, {
    pro_id: id,
  })
    .then(function (response) {
      if (response.data == "Item não encontrado.") {
        toastPrincipal('Item não encontrado.', 'bg-danger')
      } else {
        toastPrincipal('Cadastro excluído com sucesso')
      }

    })
    .catch(function (error) {
      console.log(error)
    })
}
function closeCanvaProduto() {
  let canvaProduto = document.getElementById('offcanvasRight-produto')
  canvaProduto.classList.remove("show")
  window.location.reload();
}