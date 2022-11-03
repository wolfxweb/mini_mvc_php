
function sendFormulario(event){
    event.preventDefault()
    console.log(event)
    let nome  = document.getElementById('nome').value
    let   = document.getElementById('descricao').value

    if(nome == ''){
        let msgErroClass = document.getElementById('nome');
        msgErroClass.classList.add("is-invalid");
        let msg = "Este campo e obrigatório!";
        document.getElementById( "nomeFeedback").innerHTML = msg;
    }
    let url  ='adm/cadastro_categoria'
    axios.post(url,{
       nome:nome,
       descricao:descricao
    })
    .then(function(response){
        console.log('response');
       
        console.log(response.data);
   
      })
      .catch(function(error){
        console.log('error');
        console.log(error);
      })
}