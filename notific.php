<?php
require "algoritimos/atalho.php";
require "algoritimos/seguranca.php";
$c = new process;
$n=0;

if (!isset($_SESSION['id_user'])) {
    ?>
    <script type="text/javascript">
        window.location.href="login/";
    </script>
    <?php    
}
$id_user = $_SESSION['id_user'];
$imagen = pegar_foto_perfil("perfil",$_SESSION['id_user']);
?>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/glou_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/temas/<?=pegar_tema()?>.css">
    <link href="bibliotecas/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/stilo.css">
    <title>Notificacoes</title>
</head>
<body>
    <script>var indereco = "./";</script>
    <script src="bibliotecas/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>

    <nav id="metade_da_nav" onclick="abri_fecha('#segunda_nav')">
        <img src="bibliotecas/bootstrap/icones/border-width.svg">
    </nav>
    
    <nav class="px-3 py-2">
      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <ul class="nav col-12 justify-content-center my-md-0 text-small">
            <li>
              <a href="./" class="nav-link text-secondary">
                <img src="bibliotecas/bootstrap/icones/house.svg">
              </a>
            </li>
            <li>
              <a href="comunidade/" class="nav-link text-white">
                <img src="bibliotecas/bootstrap/icones/people.svg">
              </a>
            </li>
            <li>
              <a href="coder.php" class="nav-link text-white">
                <a href="coder.php" id="coder"><button>CODER</button></a>
              </a>
            </li>
            <li>
                <a href="mensagens/" class="nav-link text-white">
                    <img src="bibliotecas/bootstrap/icones/chat-left-dots.svg"/> 
                    <?php
                    if($c->verificar_qtd("chat",$id_user) > 0){
                        ?>
                        <div class="info_qtd_c info_qtd_chat"><?=$c->verificar_qtd("chat",$id_user)?></div>
                        <?php
                    }else {
                        ?>
                        <div style="" class="info_qtd_chat"></div>
                        <?php
                    }
                    ?>          
            </a>
            </li>
            <li>
              <a href="notific.php" class="nav-link text-white">
                <img src="bibliotecas/bootstrap/icones/bell.svg"/>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <?php
    $abrir_nav = "primeiro";
    require "include/nav.php";
    ?>
    <div class="corpos">
      <div id="corpo" class="crp overflow-y-auto">
          <div class="container d-flex justify-content-center w-100">
              <button class="btn btn-link text-decoration-none">
                  Marcar todas como lidas
              </button>
          </div>
          <?php
          $n = new notificacoes();
          $n->procurar();
          ?>
      </div>
      <div class="corpo2 crp"></div>
    </div>
    <div id="mais_pbl"><a href="./">Ver Mais</a></div>      
    <?php require "include/footer.php"; ?>
    <?php require "sent.php";?>
    <script src="bibliotecas/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/fim_script.js"></script>
</body>
</html>