



/** inicio funções de mascara telefone */
/* exemplo de como usar as mascaras
  <input type="text" class="form-control" id="telefone_fixo" aria-describedby="telefone_fixo" onkeypress="maskTelefoneFixo(this, formatTelefoneFixo);" onblur="maskTelefoneFixo(this, formatTelefoneFixo);" >
*/
function maskCelular(o, f) {
  setTimeout(function () {
    var v = formatCelular(o.value);
    if (v != o.value) {
      o.value = v;
    }
  }, 1);
}
function formatCelular(v) {
  let r = v.replace(/\D/g, "");
  r = r.replace(/^0/, "");
  if (r.length > 11) {
    r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
  } else if (r.length > 7) {
    r = r.replace(/^(\d\d)(\d{5})(\d{0,4}).*/, "($1) $2-$3");
  } else if (r.length > 2) {
    r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
  } else if (v.trim() !== "") {
    r = r.replace(/^(\d*)/, "($1");
  }
  return r;
}
function maskTelefoneFixo(o, f) {
  setTimeout(function () {
    var v = formatTelefoneFixo(o.value);
    if (v != o.value) {
      o.value = v;
      console.log()
    }
  }, 1);
}
function formatTelefoneFixo(v) {
  let r = v.replace(/\D/g, "");
  r = r.replace(/^0/, "");
  if (r.length > 11) {
    r = r.replace(/^(\d\d)(\d{4})(\d{4}).*/, "($1) $2-$3");
  } else if (r.length > 6) {
    r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
  } else if (r.length > 2) {
    r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
  } else {
    r = r.replace(/^(\d*)/, "($1");
  }
  return r;
}
/** fim das funções de mascara telefone */

function mostrarOcultarElemento(id){
  /*
    o id a ser passado para este função e do elemento oculto e a função deve ser chamada no elemento visivel 
    exemplo no menu
  */
      let ulBloc = document.getElementById(id);
      if( ulBloc.classList.contains('d-none')){
          ulBloc.classList.remove("d-none");
      }else{
          ulBloc.classList.add("d-none");
      }
    
  }

 var offcanvasElementList = [].slice.call(document.querySelectorAll('.offcanvas'))
var offcanvasList = offcanvasElementList.map(function (offcanvasEl) {
  //return new bootstrap.Offcanvas(offcanvasEl)
})

  function mostarModalcadastro(){
    console.log("canva")


  }
  function toasty(msg = "Sucesso" , colorClass ){
    let toastEl = document.getElementById('alertToast')
    let toastmsg = document.getElementById('txt-toast-alert')
    toastmsg.innerText = msg
    if(colorClass){
      toastEl.classList.remove("bg-success")
      toastEl.classList.add("bg-danger")
    }else{
      toastEl.classList.remove("bg-danger")
      toastEl.classList.add("bg-success")
    }
    let option={animation:false,autohide: false,delay:2000  }
    let toastElement = new bootstrap.Toast(toastEl, option)
    toastElement.show()
    setTimeout(function () {
      window.location.reload();
    }, 2000);
  }

  function toastPrincipal(msg = "Sucesso" , colorClass ){
    let toastEl = document.getElementById('alertToastPrinical')
    let toastmsg = document.getElementById('txt-toast-alert-principal')
    toastmsg.innerText = msg
    if(colorClass){
      toastEl.classList.remove("bg-success")
      toastEl.classList.add("bg-danger")
    }else{
      toastEl.classList.remove("bg-danger")
      toastEl.classList.add("bg-success")
    }
    let option={animation:false,autohide: false,delay:2000  }
    let toastElement = new bootstrap.Toast(toastEl, option)
    toastElement.show()
    setTimeout(function () {
      window.location.reload();
    }, 2000);
  }