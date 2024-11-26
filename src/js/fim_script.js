function verificar_tela() {
  var corpo2 = document.querySelector(".corpo2");
  var corpo3 = document.querySelector(".corpo3");
  navegando = false;
  corpo2.addEventListener('onmouseover', function(){
    navegando = true;
  });

  if (window.innerWidth > 749 && !navegando) {
      var xhr_sms = new XMLHttpRequest();
      xhr_sms.open('POST', indereco+'include/mensagens.php', true);
      xhr_sms.setRequestHeader('Content-Type', 'application/json');

      xhr_sms.onload = function() {
        if (xhr_sms.status === 200) {
          corpo2.innerHTML = xhr_sms.responseText;
        }
      };
      var data = {
        indereco: indereco 
      };

      var jsonData = JSON.stringify(data);
      
      xhr_sms.send(jsonData);
  }else{
    corpo2.innerHTML = "";
  }
  if (corpo3.innerHTML == "") {
    if (window.innerWidth > 1049) {
      var xhr_code = new XMLHttpRequest();
      xhr_code.open('POST', indereco+'include/codigos.php', true);
      xhr_code.setRequestHeader('Content-Type', 'application/json');

      xhr_code.onload = function() {
        if (xhr_code.status === 200) {
          corpo3.innerHTML = xhr_code.responseText;
        }
      };
      var data = {
        indereco: indereco 
      };

      var jsonData = JSON.stringify(data);
      
      xhr_code.send(jsonData);
    }else{
      corpo3.innerHTML = "";
    }
  }else{
    if (window.innerWidth < 1050) {
      corpo3.innerHTML = "";
    }
  }
  
}
verificar_tela()
setInterval(verificar_tela,3000);
function maisPbl() {
  var mais_pbl = document.querySelector('.mais_pbl_process')
  if (!mais_pbl.classList.contains('false')) {
    // Crie um objeto XMLHttpRequest
    var xhr = new XMLHttpRequest();
    
    // Defina o método e a URL do script PHP
    xhr.open('POST', 'algoritimos/mais_pbl.php', true);
    
    // Defina o cabeçalho para enviar dados JSON
    xhr.setRequestHeader('Content-Type', 'application/json');
    
    // Defina o callback para manipular a resposta
    xhr.onload = function() {
      if (xhr.status === 200) {
        if (xhr.responseText == "") {
          return true;
        }
        const corpo_principal = document.querySelector(".pbls");
        corpo_principal.style.overflowY = "hidden"
        event.preventDefault()
        event.stopPropagation()
        p = document.createElement('div');
        classe = "novo"+Date.now();
        p.classList.add(classe);
        p.textContent = xhr.responseText;
        corpo_principal.innerHTML += "<div class="+classe+">"+xhr.responseText+"</div>";
        corpo_principal.style.overflowY = "scroll"
        var textareas = document.querySelectorAll("."+classe+" .ver_code");
        textareas.forEach(function(textarea) {
            CodeMirror.fromTextArea(textarea, {
            lineNumbers: true,
            extraKeys: {"Ctrl-Space": "autocomplete"},
            autoCloseBrackets: true,
            matchBrackets: true,
            showCursorWhenSelecting: true,
            mode: "javascript",
            theme: "dracula",
            scrollbars: "none",
            readOnly: true
          });
        });
      }
    };
    xhr.send();
  }
}
function actualizar() {
    var xhr = new XMLHttpRequest();

    xhr.open('POST', indereco+'algoritimos/actualizar.php', true);

    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onload = function() {
      if (xhr.status === 200) {

        var respostaJSON = JSON.parse(xhr.responseText)
        var chat = respostaJSON.chat;

        if (true) {
          const info = document.querySelector(".info_qtd_chat");

          if (!info.classList.contains('info_qtd_c')) {
            info.classList.add('info_qtd_c')
          }
          info.innerHTML = chat
          if (info.innerText == "") {
            info.classList.remove('info_qtd_c')
          }
        }
        //alert(xhr.responseText);
      }
    };
    xhr.send();
}
setInterval(actualizar, 500)

const corpo_principal = document.querySelector("#corpo");
let scrollTimer;
corpo_principal.addEventListener('scroll', function() {
  var atraso_de_processo = 300;//em px
  if (corpo_principal.scrollTop + corpo_principal.clientHeight >= corpo_principal.scrollHeight - atraso_de_processo) {
    if (document.querySelector('.mais_pbl_process')) {
      maisPbl(corpo_principal);
    }
  }
});
maisPbl(corpo_principal);





