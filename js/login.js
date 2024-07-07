function verificar_senha(senha,div_senha) {
    var tamanho_de_senha,percentagem_de_integridade,color

    tamanho_de_senha = senha.length
    percentagem_de_integridade = tamanho_de_senha * 10;
    if (percentagem_de_integridade > 90) {
        percentagem_de_integridade = 90
    }
    var i = 0,ii = tamanho_de_senha - 1;
    while (i <= ii) {

        if (senha[i] >= 0) {
            percentagem_de_integridade += 10;
            i = 0
            break
        }
        i = i+1;
    } 
    if (percentagem_de_integridade <= 40) {
        color = "red"
    }
    if (percentagem_de_integridade >= 50 && percentagem_de_integridade <= 70) {
        color = "orange"
    }
    if (percentagem_de_integridade >= 80) {
        color = "yellow"
    }
    if (percentagem_de_integridade >= 100) {
        color = "green"
    }
    div_senha.style.borderLeftColor = color
    div_senha.style.borderLeftWidth = "5px"
}
div_senha = document.querySelector("#senha_sig")
div_senha.addEventListener('input', function() {
    senha = div_senha.value
    verificar_senha(senha,div_senha)
});

function cadastrar() {
    var nome = document.querySelector("#nome").value
    var email = document.querySelector("#email").value
    var senha = document.querySelector("#senha_sig").value
    var confirmar_senha = document.querySelector("#senha_conf").value

    var xhr = new XMLHttpRequest();
    
    xhr.open('POST', '../algoritimos/login.php', true);
    
    xhr.setRequestHeader('Content-Type', 'application/json');
    
    xhr.onload = function() {
      if (xhr.status === 200) {
        var respostaJSON = JSON.parse(xhr.responseText)
        var erro = respostaJSON;

        var msg_erro = document.querySelector(".erro_ao_entrar");
        if (erro[0] == 0) {
            msg_erro.innerText = "preencha todas as abas"
        }else{
            if (erro[1] == 0) {
                msg_erro.innerText = "senhas nao correspondem"
            }else{
                if (erro[2] == 0) {
                    msg_erro.innerText = "senha nao atende aos requisitos de seguranca"
                }else{
                    if (erro[3] == 0) {
                        msg_erro.innerText = "erro ao conectar banco de dados"
                    }else{
                        if (erro[4] == 0) {
                            msg_erro.innerText = "ja existe um usuario com este email"
                        } else {
                            document.location.href = "../instrucoes"
                        }
                    }
                }
            }
        }
      }
    }
    var data = {
      nome: nome, // Adicione o valor da variável nome
      email: email,
      senha: senha,
      confirmar_senha: confirmar_senha
    };
    var jsonData = JSON.stringify(data);
    xhr.send(jsonData);
}