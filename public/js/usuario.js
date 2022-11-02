

document.addEventListener("DOMContentLoaded", () => {
  
   // document.querySelector("div_alert").style.setProperty("display", "none", "important")
    document.getElementById("div_alert").style.setProperty("display", "none", "important")
  });
function setUsuario(event) {
  //  event.preventDefault()
    let camposObrigatorios = ['nome', 'email','senha','senhaConfirma']
   // event.submitter.disabled = true // desabilita o botão
 //   event.submitter.firstChild.hidden = false // adiciona load no botão

    for (let i = 0; i < event.srcElement.length; i++) {
        if (camposObrigatorios.indexOf(event.srcElement[i].id) > -1) {
            if (event.srcElement[i].value == '') {
               let msgErroClass = document.getElementById(event.srcElement[i].id);
                msgErroClass.classList.add("is-invalid");
                let msg = "Este campo e obrigatório!";
                document.getElementById(event.srcElement[i].id + "Feedback").innerHTML = msg;
              //  event.submitter.disabled = false // desabilita o botão
            //    event.submitter.firstChild.hidden = true // adiciona load no botão
                return
            }
            if(event.srcElement[i].value != ''){
                let msgSuccess = document.getElementById(event.srcElement[i].id);
                msgSuccess.classList.remove("is-invalid");
                msgSuccess.classList.add("is-valid");
            }
        }
     
    }

  
    
}

function sendFormulario(event){
    event.preventDefault()

    setUsuario(event)

    let nome  = document.getElementById('nome').value
    let email  = document.getElementById('email').value
    let senha  = document.getElementById('senha').value
    let senhaConfirma  = document.getElementById('senhaConfirma').value
    let status  = document.getElementById('status').value
    let usuarioTipo  = document.getElementById('usuario_tipo').value

    if(senha !== senhaConfirma){
      document.getElementById("div_alert").style.setProperty("display", "block", "important")
    } else if(senha === senhaConfirma){
      
     // document.getElementById('btn_load').style.display = 'block';
    }
    
    let url  ='/adicionar_usuario'
    axios.post(url,{
       nome:nome,
       email:email,
       senha:senha,
       status:status,
       usuarioTipo:usuarioTipo
    })
    .then(function(response){
      console.log('response');
     
      console.log(response.data);
      if(response.data ==='formato-email-invalido'){
        setMsgResponseEmail("Formato e-mail invalido.")
       /* let msgSuccess = document.getElementById('email');
        msgSuccess.classList.remove("is-valid");
        msgSuccess.classList.add("is-invalid");
        let msg = "Formato e-mail invalido";
        document.getElementById("emailFeedback").innerHTML = msg;
        */
      }
      if(response.data === 'email-informado-cadastrado'){
        setMsgResponseEmail("E-mail informado já esta sendo utilizado.")
      }
      if(response.data === 'senha-curta'){
        let msgSuccess = document.getElementById('senha');
        msgSuccess.classList.remove("is-valid");
        msgSuccess.classList.add("is-invalid");
        let msg = "Senha deve ter no minimo 6 caracteres.";
        document.getElementById("senhaFeedback").innerHTML = msg;
        let msgSuccess2 = document.getElementById('senhaConfirma');
        msgSuccess2.classList.remove("is-valid");
        msgSuccess2.classList.add("is-invalid");
       
        document.getElementById("senhaConfirmaFeedback").innerHTML = msg;
      }
      if(response.data === 'nome-curto'){
        let msgSuccess = document.getElementById('nome');
        msgSuccess.classList.remove("is-valid");
        msgSuccess.classList.add("is-invalid");
        let msg = "Campo nome deve ter no minimo 3 caracteres.";
        document.getElementById("nomeFeedback").innerHTML = msg;
      }
      if(response.data ==='cadastro-realizado'){

        window.onload = (event)=> {
          let myAlert = document.querySelector('.toast');
          let bsAlert = new  bootstrap.Toast(myAlert);
          bsAlert.show();
         }
      }
      if(response.data ==='falha-cadastro'){
        toast.show()
      }
    //  senha-muito-curta
    })
    .catch(function(error){
      console.log('error');
      console.log(error);
    })
    /*
    const formCadastro = document.getElementById('form_cadastro')
    console.log(formCadastro);
    
    const request = new XMLHttpRequest();
    request.open("POST","/adicionar_usuario",true)
  
  
  
   
    request.send(new FormData(formCadastro));
    request.onload =  function(){
         console.log(request.responseText)
        
     }
    document.getElementById('btn_load').style.display = 'nome';
    */
}
function setMsgResponseEmail(msg){
            
  let msgSuccess = document.getElementById('email');
  msgSuccess.classList.remove("is-valid");
  msgSuccess.classList.add("is-invalid");
//  let msg = "Formato e-mail invalido";
  document.getElementById("emailFeedback").innerHTML = msg;
}
function getEnederecoPeloCep(cep) {
   
    let url = `https://viacep.com.br/ws/${cep}/json/`
    fetch(url).then(function (response) {
      response.json().then(function (data) {
        document.getElementById("rua").value = data.logradouro;
        document.getElementById("bairro").value = data.bairro;
        document.getElementById("cidade").value = data.localidade;
        document.getElementById("estado").value = data.uf;
      })
    })
    .catch(function(erro){
        document.getElementById("div_alert").style.setProperty("display", "block", "important")
    })
  }
