

function sendFormulario(event) {
  event.preventDefault()
  //  console.log(event)
  let nome = document.getElementById('nome').value
  let descricao = document.getElementById('descricao').value

  if (nome == '') {
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
