

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
  