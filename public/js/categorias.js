


function sendFormulario(event) {
  event.preventDefault()

  let nome = document.getElementById('nome').value
  let descricao = document.getElementById('descricao').value

  if (nome == '') {
    /** tem que refatorar o insert para poder usar a função msgErroCampoNome ou deixa a validação a aqui */
    let msgErroClass = document.getElementById('nome');
    msgErroClass.classList.add("is-invalid");
    let msg = "Este campo e obrigatório!";
    document.getElementById("nomeFeedback").innerHTML = msg;
  }
  let url = 'http://localhost:8000/adm/cadastro_categoria'
  axios.post(url, {
    nome: nome,
    descricao: descricao
  })
    .then(function (response) {
      toastr.success('Cadastro realizado com sucesso.')
      document.getElementById('nome').value = ''
      document.getElementById('descricao').value = ''
      setTimeout(function () {
        location.reload()
      }, 2000);
    })
    .catch(function (error) {
      console.log(error)
    })
}

function editCategoria(id) {

  console.log(id)
  let cat_id = id
  let ctn = 'cat_id' + cat_id
  let categoria = document.getElementById(ctn)
  console.log(categoria)
  let cat_nome = categoria.getAttribute('catNome')
  let cat_descricao = categoria.getAttribute('catDescricao')
  document.getElementById('cat_id_edit').value = id
  document.getElementById('cat_nome_edit').value = cat_nome
  document.getElementById('cat_descricao_edit').value = cat_descricao
  let canvaCategoria = document.getElementById('offcanvasEditar-categoria')
  canvaCategoria.classList.add("show");
}

function closeCanva() {
  let canvaCategoria = document.getElementById('offcanvasEditar-categoria')
  canvaCategoria.classList.remove("show");
  window.location.reload();
}


function saveCategoriaEditada() {
  event.preventDefault()
  let cat_id = document.getElementById('cat_id_edit').value
  let cat_nome = document.getElementById('cat_nome_edit').value
  let cat_descricao = document.getElementById('cat_descricao_edit').value
  if (cat_nome == '') {
    msgErroCampoNome("Este campo e obrigatório!")
    return false;
  }

  let url = 'http://localhost:8000/adm/edicao_categoria'
  axios.post(url, {
    cat_id: cat_id,
    cat_nome: cat_nome,
    cat_descricao: cat_descricao
  })
    .then(function (response) {
      if (response.data = "Nome categoria deve ter no minimo 3 caracter." && response.data != "") {
        msgErroCampoNome(response.data)
      }
      toastr.success('Cadastro atualizado com sucesso.')
      setTimeout(function () {
        closeCanva()
      }, 2000);
    })
    .catch(function (error) {
      console.log(error)
    })
  function msgErroCampoNome(msgtext) {
    let msgErroClass = document.getElementById('cat_nome');
    msgErroClass.classList.add("is-invalid");
    document.getElementById("cat_nomeFeedback").innerHTML = msgtext;
  }
}
function deletarCategoria(id) {
  let url = 'http://localhost:8000/adm/delete_categoria'
  axios.post(url, {
    cat_id: id,
  })
    .then(function (response) {
      toastr.success('Categoria excluida com sucesso.')
      // window.location.reload();
      setTimeout(function () {
        window.location.reload();
      }, 2000);
    })
    .catch(function (error) {
      console.log(error)
    })
}

$(document).ready(function () {
  $('#categoria').DataTable({
  //  dom: "Bfrtip",
    processing: true,
    serverSide: true,
    ajax: {
      url: 'http://localhost:8000/adm/tabela_categorias',
      type: "POST"
    },
    "columns": [
      { "data": "cat_id" },
      { "data": "cat_nome" },
      { "data": "cat_descricao" },
      { "data": "cat_acao" },
    ],
    "language":{
      "url":"//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json"
    }

  });
});