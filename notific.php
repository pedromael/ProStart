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
    <link rel="icon" href="/src/img/glou_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="/src/css/temas/<?=pegar_tema()?>.css">
    <link href="/bibliotecas/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/css/stilo.css">
    <title>Notificacoes</title>
</head>
<body>
    <script>var indereco = "./";</script>
    <script src="/bibliotecas/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/src/js/script.js"></script>
    <?php
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
    <script src="/src/js/fim_script.js"></script>
</body>
</html>