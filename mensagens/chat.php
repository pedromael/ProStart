<?php
 require "../algoritimos/atalho.php";
 require "../algoritimos/seguranca.php";
 $c = new process;

 if (!isset($_SESSION["id_user"])) {
    #header("location: ../login/");
    ?>
        <script>
            document.location.href = "../login/"
        </script>
    <?php
 }
 if (isset($_GET['user'])) {
    $id_dest = descriptografar($_GET['user']);
 } else {
    #header("location: ./");
    ?>
        <script>
            document.location.href = "./"
        </script>
    <?php
 }
 $id_user = $_SESSION['id_user'];
 $imagen = pegar_foto_perfil("perfil",$id_dest);
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
    <title><?=$user['nome']?></title>
</head>
<body>
    <script>var indereco = "../";</script>
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
    <div class="corpo3 crp"></div>
    <div id="corpo" class="crp">
      <div class="corpo_diminuido overflow-y-auto">
        
      <div class="msg">
        <?php
        $msg = new mensagens;
        $msg->receptor = $id_dest;
        $msg->selecionar();
        ?>
      </div>
  </div> 
  <footer class="footer_chat">
        <div class="formulario_normal_de_envio">
            <textarea name="texto_cmt" id="" placeholder="a tua opiniao e importante"></textarea>
            <div class="carregar"  style="background-image: url(../bibliotecas/bootstrap/icones/file-earmark-image.svg);"></div>
            <button name="btn_cmt" style="background-image: url(../bibliotecas/bootstrap/icones/send.svg);" class="form-control" onclick="enviar_mensagem('<?=criptografar($id_dest)?>')"></button>
        </div>
      <?php
      require "../sent.php";
      ?>
  </footer>
  </div> 
  <div class="corpo2 crp"></div>
</div>

<?php require "../include/footer.php"; ?>
<script>
  const corpo_chat = document.querySelector(".corpo_diminuido");
  corpo_chat.scrollTop = corpo_chat.scrollHeight
</script>
<script src="../js/fim_script.js"></script>
</body>
</html>