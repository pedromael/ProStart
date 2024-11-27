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
    <link rel="icon" href="/src/img/glou_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="/src/css/temas/<?=pegar_tema()?>.css">
    <link href="/bibliotecas/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/bibliotecas/codemirror-5.7/lib/codemirror.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/css/stilo.css">
    <link rel="stylesheet" href="/src/css/coder.css">
    <title>Pro-Coder</title>
</head>
<body"> 
    <script src="/bibliotecas/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/src/js/script.js"></script>
    <script>var indereco = "../"</script>
    <?php
    require "../include/nav.php";
    ?>
    <div class="corpos">
      <div class="corpo3 crp"></div>
      <div id="corpo" class="crp">
          <div id="pbl_abrir" onmouseover="personalizar('#pbl_abrir')" onclick="publicar('novo repositorio')">
              <button>novo repositorio</button>
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
                  <div id="pbl1">
                      <div><button name="btn_repositorio">Criar</button></div>
                  </div>
              </form>
          </div>
          <div class="codigos">
              <?php
              require "../sent.php";
              $_SESSION['visualizado'] = array();
              $_SESSION['code_visualizado'] = array();
              $s = new selecionar_feed();
              $s->selecionar_poste("codigos");
              ?>
          </div>
      </div>
      <div class="corpo2 crp"></div>
    </div>
    <?php include "../include/footer.php"; ?>
    <?php mysqli_close($link);?>
    <script src="/bibliotecas/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/src/js/fim_script.js"></script>
    <script src="/src/js/coder.js"></script>
</body>
</html>