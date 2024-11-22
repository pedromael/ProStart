<?php
include "../algoritimos/atalho.php";
include "../algoritimos/seguranca.php";

$e_sugestao = false;
if (isset($_GET['coder'])) {
    $id_code = descriptografar($_GET['coder']);
    unset($_GET['coder']);
}else {
  if (isset($_GET['sug'])) {
    $id_code = descriptografar($_GET['sug']);
    $e_sugestao = true;
  }else{
    ?>
    <script>
        window.history.back();
    </script>
    <?php
  }
}
$c = new process;
$coder = new codigos;
if ($e_sugestao) {
  $dados = $coder->sugestao($id_code);
  $dados['titulo'] = "Sugestao";
  if (!isset($dados['id_code'])) {
    ?>
    <script>
        alert("erro 403: nao conseguimos abrir o codigo <?=$id_code?>");
        //window.history.back();
    </script>
    <?php
  }
}else {
  $dados = $coder->codigo($id_code);  
}

$imagen = pegar_foto_perfil("perfil",$user['id_user']);
?>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/temas/<?=pegar_tema()?>.css">
    <link href="../bibliotecas/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bibliotecas/codemirror-5.7/lib/codemirror.css" rel="stylesheet">
    <link rel="stylesheet" href="../bibliotecas/codemirror-5.7/theme/base16-dark.css">
    <link rel="stylesheet" href="../bibliotecas/codemirror-5.7/theme/dracula.css">
    <link rel="stylesheet" href="../bibliotecas/codemirror-5.7/theme/eclipse.css">
    <script src="../bibliotecas/codemirror-5.7/lib/codemirror.js"></script>
    <script src="../bibliotecas/codemirror-5.7/lib/codemirror.js"></script>
    <script src="../bibliotecas/codemirror-5.7/addon/hint/show-hint.js"></script>
    <script src="../bibliotecas/codemirror-5.7/addon/hint/javascript-hint.js"></script>
    <script src="../bibliotecas/codemirror-5.7/mode/javascript/javascript.js"></script>
    <link rel="stylesheet" href="../css/stilo.css">
    <link rel="stylesheet" href="../css/coder.css">
    <title><?=$dados['titulo']?></title>
</head>
<body>
    <script src="../js/script.js"></script>
    <script src="../bibliotecas/jquery.js"></script>
    <script>var indereco="../";</script>
    <nav id="metade_da_nav" onclick="abri_fecha('#segunda_nav')">
        <img src="../bibliotecas/bootstrap/icones/border-width.svg">
    </nav>
    <nav class="px-3 py-2">
      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

          <ul class="nav col-12 justify-content-center my-md-0 text-small">
            <li>
              <a href="../" class="nav-link text-secondary">
                <img src="../bibliotecas/bootstrap/icones/house.svg">
              </a>
            </li>
            <li>
              <a href="../comunidade/" class="nav-link text-white">
                <img src="../bibliotecas/bootstrap/icones/people.svg">
              </a>
            </li>
            <li>
              <a href="./" class="nav-link text-white">
                <a href="./" id="coder"><button>Pro-Start</button></a>
              </a>
            </li>
            <li>
                <a href="../mensagens/" class="nav-link text-white">
                    <img src="../bibliotecas/bootstrap/icones/chat-left-dots.svg"/>              
                </a>
            </li>
            <li>
              <a href="../notific.php" class="nav-link text-white">
                <img src="../bibliotecas/bootstrap/icones/bell.svg"/>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <?php
    $abrir_nav = "segundo";
    require "../include/nav.php";
    ?>
    <div class="corpos">
        <div id="corpo_coder">
          <div id="dar_sugestao_code" class="remover">
            <div class="modal modal-sheet d-block p-4 py-md-5" tabindex="-1" role="dialog" id="modalSheet">
              <div class="modal-dialog" role="document">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header border-bottom-0">
                    <h1 class="modal-title fs-5">o que deixares pode mudar tudo!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="aba_alert('#dar_sugestao_code')"></button>
                    </div>
                    <div class="modal-body py-0">
                      <p><textarea name="" id="" rows="10" class="descricao form-control" placeholder="descricacao"></textarea></p>
                    </div>
                    <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
                        <input name="btn_img" type="submit" class="btn bg-sec" value="Postar" onclick="sugerir_code('<?=criptografar($dados['id_code'])?>',meu_editor)"> 
                    </div>
                </div>
              </div>
            </div>
          </div>
            <?php
            $coder->indereco = "../";
            if ($e_sugestao) {
              if (isset($_GET['sug_n_ver'])) {
                $id_code = $coder->codigo($dados['id_code'])['id_code'];
                $dados['n_mostrar'] = 'entrar';
              }
              if(isset($_GET['comparacao'])) {
                $dados['n_mostrar'] = "comparacao";
              }
              $dados_ = $coder->codigo($dados['id_code']);
              ?>
              <div id="actualizar_sugestao_code" class="remover">
                <div class="modal modal-sheet d-block p-4 py-md-5" tabindex="-1" role="dialog" id="modalSheet">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content rounded-4 shadow">
                        <div class="modal-header border-bottom-0">
                        <h1 class="modal-title fs-5">o que mudara!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="aba_alert('#actualizar_sugestao_code')"></button>
                        </div>
                        <div class="modal-body py-0">
                          <p><textarea name="" id="" rows="10" class="descricao form-control" placeholder="descricacao"><?=$dados_['descricao']?></textarea></p>
                        </div>
                        <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
                            <input name="btn_img" type="submit" class="btn bg-sec" value="Postar nova versao" onclick="postar_nova_versao_code('<?=criptografar($dados_['id_code'])?>',<?=$dados['id_code_sugestao']?>)"> 
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php
              $coder->mostrar($dados_,true,"simples",$dados);
            }else {
              ?>
              <div id="actualizar_sugestao_code" class="remover">
                <div class="modal modal-sheet d-block p-4 py-md-5" tabindex="-1" role="dialog" id="modalSheet">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content rounded-4 shadow">
                        <div class="modal-header border-bottom-0">
                        <h1 class="modal-title fs-5">o que mudara!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="aba_alert('#actualizar_sugestao_code')"></button>
                        </div>
                        <div class="modal-body py-0">
                          <p><textarea name="" id="" rows="10" class="descricao form-control" placeholder="descricacao"><?=$dados['descricao']?></textarea></p>
                        </div>
                        <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
                            <input name="btn_img" type="submit" class="btn bg-sec" value="Postar nova versao" onclick="postar_nova_versao_code('<?=criptografar($dados['id_code'])?>',meu_editor)"> 
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php
              if (isset($_GET['modificar'])) {
                if ($_GET['modificar'] == 1) {
                  $coder->mostrar($dados,true,"codar");
                }else {
                  $coder->mostrar($dados,true,"simples");
                }
              }else {
                $coder->mostrar($dados,true,"simples");
              }
            }
            ?>
            <div class="btn_abrir_area_cmt" onclick="aba_comentar_code('.corpo_comentar_coder')"><</div>
        </div>
        <script>
          var meu_editor = CodeMirror.fromTextArea(document.getElementById("code"), {
          lineNumbers: true,
          //extraKeys: {"Ctrl-Space": "autocomplete"},
          //keyMap: "sublime",
          autoCloseBrackets: true,
          matchBrackets: true,
          showCursorWhenSelecting: true,
          theme: "dracula",
          mode: {name: "javascript", globalVars: true}
        });
        var input = document.getElementById("select");
        function selectTheme() {
          var theme = input.options[input.selectedIndex].textContent;
          meu_editor.setOption("theme", theme);
          location.hash = "#" + theme;
        }
        var choice = (location.hash && location.hash.slice(1)) || (document.location.search && decodeURIComponent(document.location.search.slice(1)));
        if (choice) {
          input.value = choice;
          editor.setOption("theme", choice);
        }
        CodeMirror.on(window, "hashchange", function() {
          var theme = location.hash.slice(1);
          if (theme) { input.value = theme; selectTheme(); }
        });
        </script>
        <script src="../js/coder.js"></script>
        <div class="corpo_comentar_coder">
            <div class="corpo_diminuido">
                <div class="comentarios">
                    <?php
                    $_SESSION['cmt_visualizado'] = array();
                    $comentarios  =  new comentarios;
                    $comentarios->id = $id_code;
                    $comentarios->pegar("code",4);
                    ?>
                </div>
                
            </div>
            <footer class="footer_cmt footer_chat">
                <div class="formulario_normal_de_envio">
                  <textarea name="texto_cmt" id="" placeholder="a tua opiniao e importante"></textarea>
                  <div class="carregar"  style="background-image: url(../bibliotecas/bootstrap/icones/file-earmark-image.svg);"></div>
                  <button name="btn_cmt" style="background-image: url(../bibliotecas/bootstrap/icones/send.svg);" class="form-control" onclick="comentar('<?=criptografar($id_code)?>','code',0)"></button>
                </div>
                <?php
                require "../sent.php";
                ?>
            </footer>
        </div>
        <script>
          if (innerWidth < 1100) {
            var cmt = document.querySelector(".corpo_comentar_coder");
            cmt.classList.add("remover");
          }
        </script>
    </div>
    <?php
    include "../include/footer.php";
    ?>
</body>
</html>