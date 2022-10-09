

document.addEventListener("DOMContentLoaded", () => {
  
   // document.querySelector("div_alert").style.setProperty("display", "none", "important")
    document.getElementById("div_alert").style.setProperty("display", "none", "important")
  });
function setUsuario(event) {
  //  event.preventDefault()
    let camposObrigatorios = ['nome', 'email','cep','senha']
    event.submitter.disabled = true // desabilita o botão
    event.submitter.firstChild.hidden = false // adiciona load no botão

    for (let i = 0; i < event.srcElement.length; i++) {
        if (camposObrigatorios.indexOf(event.srcElement[i].id) > -1) {
            if (event.srcElement[i].value == '') {
                let msgErroClass = document.getElementById(event.srcElement[i].id);
                msgErroClass.classList.add("is-invalid");
                let msg = "Este campo e obrigatório!";
                document.getElementById(event.srcElement[i].id + "Feedback").innerHTML = msg;
                event.submitter.disabled = false // desabilita o botão
                event.submitter.firstChild.hidden = true // adiciona load no botão
                return
            }
            if(event.srcElement[i].value != ''){
                let msgSuccess = document.getElementById(event.srcElement[i].id);
                msgSuccess.classList.remove("is-invalid");
                msgSuccess.classList.add("is-valid");
            }
        }
      //  let desabilitar = document.getElementById(event.srcElement[i].id);
       // desabilitar.disabled = true
    }

    
    
  
    
  //  event.submitter.disabled = false // desabilita o botão
  //  event.submitter.firstChild.hidden = true // adiciona load no botão
}

function sendFormulario(event){
    event.preventDefault()
    const formCadastro = document.getElementById('form_cadastro')
    console.log(formCadastro);
    const request = new XMLHttpRequest();
    request.open("POST","/adicionar_usuario",true)
  
    request.onload =  function(){
        console.log(request.responseText)
    }
    setUsuario(event)
   
    request.send(new FormData(formCadastro));
    
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
