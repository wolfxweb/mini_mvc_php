
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