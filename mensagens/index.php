<?php
require "../algoritimos/seguranca.php";
require "../algoritimos/atalho.php";
$c = new process;

if (!isset($_SESSION["id_user"])) {
  #header("location: ../login/");
  ?>
      <script>
          windows.location.href = "../login/"
      </script>
  <?php
}
$id_user = $_SESSION['id_user'];

if (!isset($novos)) {
  $novos = false;
}
$link = conn();
$imagen = pegar_foto_perfil("perfil",$id_user);
?>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/glou_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/temas/<?=pegar_tema()?>.css">
    <link href="../bibliotecas/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">    
    <link rel="stylesheet" href="../css/stilo.css">
    <link rel="stylesheet" href="../css/coder.css">
    <title>Contactos</title>
</head>
<body>
  <script>var indereco = "../"</script>
    <script src="../bibliotecas/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/script.js"></script>
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
              <a href="../coder/" class="nav-link text-white">
                <a href="../coder/" id="coder"><button>CODER</button></a>
              </a>
            </li>
            <li>
                <a href="./" class="nav-link text-white">
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
      <div id="corpo" class="crp">
        <div class="container overflow-y-auto">
          <?php
          $listagem = new lista_mensagens("../");
          $numero_de_sms_encontradas = $listagem->getListaAmigos();
          if ($numero_de_sms_encontradas < 1) {
            ?>
                <div class="texto_interativo">
                    aque apareceram suas <a href="" class="destaque"><span>mensagens</span></a>,
                    e seus <a href="" class="destaque"><span>contactos</span></a>
                </div>
                <div class="texto_interativo">
                    adiciona <a href="../contactos/" class="destaque"><span>contactos</span></a> com quem tenhas interesse,
                    para estares podendo trocar ideias... <a href="" class="destaque"><span>saber mais</span></a>
                </div>
              <div class="texto_interativo">
                  encontra usuarios com mesmos ideias que os seus nas 
                  <a href="../comunidade/" class="destaque"><span>comunidades</span></a>, e mantem contacto
                  os adicionando a sua lista de <a href="../contactos/" class="destaque"><span>contacto</span></a>
              </div>
          <?php
          }elseif($numero_de_sms_encontradas < 8){
            ?>
              <div class="texto_interativo">
                  adiciona <a href="../contactos/" class="destaque"><span>contactos</span></a> com quem tenhas interesse,
                  para estares podendo trocar ideias... <a href="" class="destaque"><span>saber mais</span></a>
              </div>
          <?php
          }
          ?>
        </div>
        <div class="prev_logados_chat">
          <div class="container">
            <?php
            $listagem_logados = new verificar_logados("../");
            $listagem_logados->logados();
            ?>
          </div>
        </div>
      </div>
    </div>
    
    <?php require "../include/footer.php"; ?>
    <script src="../js/fim_script.js"></script>
</body>
</html>