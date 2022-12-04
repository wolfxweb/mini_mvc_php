

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
      "language":{
        "url":"//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json"
      }
    });
  });

  function editProduto(id){

    alert(id)
  }
  function deletarProduto(id){
    console.log(id)
    let url = 'http://localhost:8000/adm/deletar-produto'
    axios.post(url, {
      pro_id: id,
    })
      .then(function (response) {
        if(response.data == "Item não encontrado."){
          toastPrincipal('Item não encontrado.', 'bg-danger')
        }else{
          toastPrincipal('Cadastro excluído com sucesso')
        }
      
      })
      .catch(function (error) {
        console.log(error)
      })
  }