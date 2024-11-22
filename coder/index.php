<?php
require "../algoritimos/atalho.php";
require "../algoritimos/seguranca.php";
$c = new process;
$n=0;


if (!isset($_SESSION['id_user'])) {
    ?>
    <script type="text/javascript">
        window.location.href="../login/";
    </script>
    <?php    
}
$id_user = $_SESSION['id_user'];
$link = conn();
$imagen = pegar_foto_perfil("perfil",$_SESSION['id_user']);

$user = mysqli_query($link, "SELECT * FROM usuarios 
WHERE id_user=$id_user");
$user = mysqli_fetch_assoc($user);

?>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/glou_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/temas/<?=pegar_tema()?>.css">
    <link href="../bibliotecas/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bibliotecas/codemirror-5.7/lib/codemirror.css" rel="stylesheet">
    <link rel="stylesheet" href="../bibliotecas/codemirror-5.7/addon/hint/show-hint.css">
    <link rel="stylesheet" href="../bibliotecas/codemirror-5.7/lib/codemirror.css">
    <link rel="stylesheet" href="../bibliotecas/codemirror-5.7/theme/3024-day.css">
    <link rel="stylesheet" href="../bibliotecas/codemirror-5.7/theme/dracula.css">
    <script src="../bibliotecas/codemirror-5.7/lib/codemirror.js"></script>
    <script src="../bibliotecas/codemirror-5.7/lib/codemirror.js"></script>
    <script src="../bibliotecas/codemirror-5.7/addon/hint/show-hint.js"></script>
    <script src="../bibliotecas/codemirror-5.7/addon/hint/javascript-hint.js"></script>
    <script src="../bibliotecas/codemirror-5.7/mode/javascript/javascript.js"></script>
    <script src="../bibliotecas/codemirror-5.7/mode/php/php.js"></script>
    <link rel="stylesheet" href="../css/stilo.css">
    <link rel="stylesheet" href="../css/coder.css">
    <title>Pro-Coder</title>
</head>
<body"> 
    <script src="../bibliotecas/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/script.js"></script>
    <script>var indereco = "../"</script>
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
              <a href="../" class="nav-link text-white">
                <a href="../" id="coder"><button>P-Start</button></a>
              </a>
            </li>
            <li>
                <a href="../mensagens/" class="nav-link text-white">
                    <img src="../bibliotecas/bootstrap/icones/chat-left-dots.svg"/> 
                    <?php
                    if($c->verificar_qtd("chat",$id_user) > 0){
                        ?>
                        <div class="info_qtd_c info_qtd_chat actualizar"><?=$c->verificar_qtd("chat",$id_user)?></div>
                        <?php
                    }else {
                        ?>
                        <div style="" class="info_qtd_chat actualizar"></div>
                        <?php
                    }
                    ?>          
            </a>
            </li>
            <li>
              <a href="../notific.php" class="nav-link text-white">
                <img src="../bibliotecas/bootstrap/icones/bell.svg"/>
                <?php
                if($c->verificar_qtd("notificacao",$id_user) > 0){
                    ?>
                    <div class="info_qtd_n info_qtd_notific actualizar"><?=$c->verificar_qtd("notificacao",$id_user)?></div>
                    <?php
                }else {
                    ?>
                    <div style="" class="info_qtd_notific actualizar"></div>
                    <?php
                }
                ?>   
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
      <div class="corpo3 crp"></div>
      <div id="corpo" class="crp">
          <div id="pbl_abrir" onmouseover="personalizar('#pbl_abrir')" onclick="publicar('partilhar codigo')">
              <button>carregar codigo</button>
          </div>
          <div id="codigo_insert" class="conteiner_pbl remover">
              <form action="" method="post" enctype="multipart/form-data">
                  <div class="pbl1">
                    <input type="text" name="titulo" class="form-control" placeholder="digite aqui o titulo de seu codigo">
                  </div>
                  <p></p>
                  <div id="pbl1" class="descricao">
                      <textarea placeholder="aqui vai a descricao do codigo" name="descricao" id=""></textarea>
                  </div>
                  <div id="pbl1" class="lingua">
                      <p>
                          Linguagem
                          <select name="linguagen" id="">
                            <option value="php">PHP</option>
                            <option value="python">PYTHON</option>
                            <option value="java">JAVA</option>
                            <option value="js">JAVA SCRIPT</option>
                            <option value="c">C</option>
                            <option value="c++">C++</option>
                            <option value="c#">C#</option>
                        </select>
                      </p>
                      <p class="">Selecionar tema: <select onchange="selectTheme()" id="select">
                        <option>3024-day</option>
                        <option selected>dracula</option>
                        </select>
                        </p>
                  </div>
                  <div id="" class="codigo">
                      <textarea name="code" id="code">//digite aqui o seu codigo</textarea>
                  </div>
                  <div id="pbl1">
                      <div><input class="file" type="file" name="doc[]" accept="image/*" multiple></div>
                      <div><button name="btn_code">postar</button></div>
                  </div>
              </form>
              <script>
                var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
                lineNumbers: true,
                extraKeys: {"Ctrl-Space": "autocomplete"},
                //keyMap: "sublime",
                autoCloseBrackets: true,
                matchBrackets: true,
                showCursorWhenSelecting: true,
                mode: {name: "javascript", globalVars: true}
              });
              var input = document.getElementById("select");

              function selectTheme() {
                var theme = input.options[input.selectedIndex].textContent;
                editor.setOption("theme", theme);
                //location.hash = "#" + theme;
              }
              selectTheme();
              </script>
          </div>
          <div class="codigos">
              <?php
              require "../sent.php";
              $_SESSION['visualizado'] = array();
              $_SESSION['code_visualizado'] = array();
              $s = new selecionar_feed();
              $s->codigos->indereco = "../";
              $s->selecionar_poste("codigos");
              ?>
          </div>
      </div>
      <div class="corpo2 crp"></div>
    </div>
        <?php
        if (isset($_GET['pbl'])) {
            ?>
            <div class="info_corrente">codigo carregado com sucesso </div>
            <?php
        }
        ?>      
    <?php include "../include/footer.php"; ?>
    <?php mysqli_close($link);?>
    <script src="../bibliotecas/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/fim_script.js"></script>
    <script src="../js/coder.js"></script>
</body>
</html>