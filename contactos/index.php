<?php
 require "../algoritimos/atalho.php";
 require "../algoritimos/seguranca.php";
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

 if (isset($_GET['abrir'])) {
    $novos = "pdd";
 }else {
    $novos = false;
 }
 $link = conn();
 $user = mysqli_query($link, "SELECT * FROM usuarios WHERE id_user=$id_user");
 $user = mysqli_fetch_assoc($user);
 $imagen = pegar_foto_perfil('perfil',$id_user);
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
        <div id="aps">
            <h5 style="color: transparent;">.</h5>
            <div class="inline">
                <a href="./index.php" class="link btn_simples 
                <?php
                    if (!isset($_GET['abrir'])) {
                        echo "selecionado";
                    }
                ?>
                ">encontrar novos</a>
            </div>
            <div class="inline">
                <?php
                if ($c->verificar_qtd("pdd",$id_user) > 0) {
                    ?>
                    <a href="index.php?abrir=pdd" class="link btn_simples
                    <?php
                        if (isset($_GET['abrir'])) {
                            if ($_GET['abrir'] == 'pdd') {
                                echo "selecionado";
                            } 
                        }
                    ?>
                    ">
                            pedidos de contactos (<span><?=$c->verificar_qtd("pdd",$id_user)?></span>)
                    </a>
                    <?php
                }
                ?>
            </div>
        </div>
        
        <div id="corpo_contactos">
            <?php
            if($novos == "pdd"){
                ?>
                <div class="pdd">
                    <?php 
                    if (isset($_GET['id']) && isset($_GET['case'])) {
                        if ($_GET['case'] == "aceitar") {
                            $id = descriptografar($_GET['id']);
                            $nome = descriptografar($_GET['nome']);
                            if ($resultado = $c->aceitar_contacto($id)) {
                                ?>
                                    <div class="info_corrente">pedido de contacto de <span><?=$nome?></span> aceite com sucesso</div>
                                <?php
                            }
                        }
                    }
                    if (isset($_GET['id']) && isset($_GET['case'])) {
                        if ($_GET['case'] == "apagar") {
                            $id = descriptografar($_GET['id']);
                            $nome = descriptografar($_GET['nome']);
                            if ($resultado = $c->eliminar_pedido_contacto($id)) {
                                ?>
                                    <div class="info_corrente">pedido de contacto de <span><?=$nome?></span> aliminado com sucesso</div>
                                <?php
                            }
                        }
                    }
                        

                    $sql = mysqli_query($link, "SELECT * FROM contacto WHERE id_user_dest=$id_user");
                    while ($row = mysqli_fetch_assoc($sql)) {
                        $id_contacto = $row['id_contacto'];
                        $sqll = mysqli_query($link, "SELECT count(*) as valor FROM $bdnome2.contacto_aceite WHERE id_contacto = $id_contacto");
                        $sqll = mysqli_fetch_assoc($sqll);
                        if ($sqll['valor'] <= 0) {
                            $id_dest = $row['id_user'];

                            $user = mysqli_query($link, "SELECT * FROM usuarios WHERE id_user=$id_dest");
                            $user = mysqli_fetch_assoc($user);

                            $imagen = pegar_foto_perfil("perfil",$id_dest);
                            ?>
                            <div class="sms">
                                    <div id="img_user" class="c1 cp1" style=" background-image: url(../media/img/<?=$imagen?>);"></div>                    
                                <div class="c1 cp2">
                                    <div class="c2 nome"><a href="../perfil/?user=<?=criptografar($id_dest)?>"><?=$user['nome']?></a></div>
                                    <a href="./index.php?abrir=pdd&id=<?=criptografar($row['id_contacto'])?>&nome=<?=criptografar($user['nome'])?>&case=apagar">
                                        <div class="c2 cont btn-sec-red">
                                            eliminar
                                        </div>
                                    </a>
                                    <a href="./index.php?abrir=pdd&id=<?=criptografar($row['id_contacto'])?>&nome=<?=criptografar($user['nome'])?>&case=aceitar">
                                        <div class="c2 cont btn-pri">
                                            aceitar
                                        </div>
                                    </a>
                                </div>  
                            </div>
                            <?php
                        }
                    }
                ?>
                </div>
                <?php
            } 
            if($novos == false) {
                ?>
                <div>
                <?php
                if (isset($_GET['user'])) {
                    $id = descriptografar($_GET['user']);
                    $nome = descriptografar($_GET['nome']);
                    if ($resultado = $c->solicitar_contacto($id)) {
                        if ($resultado == 1) {
                        ?>
                            <div class="info_corrente">selicitacao de amizade enviada para <span><?=$nome?></span> com sucesso.</div>
                        <?php
                        } elseif($resultado == 2) {
                        ?>
                            <div><span><?=descriptografar($nome)?></span> agora faz parte dos seus contactos</div>
                        <?php
                        } elseif($resultado == 3) {
                            ?>
                                <div>ja tem um pedido feito para esse usuario <span><?=descriptografar($nome)?></span></div>
                            <?php
                        }
                    }
                }
                ?>
                <?php
                $id_user = $_SESSION['id_user'];
                $sql = mysqli_query($link, "SELECT * FROM usuarios WHERE id_user!=$id_user AND id_user!=4");              
                $pessoas_sugeridas = array();

                function comparar_peso($a,$b){
                    return $b['ligacao'] - $a['ligacao'];//ordem descrescente pelo caso do b estar primeiro
                }
                while ($row = mysqli_fetch_assoc($sql)) {
                    $id = $row['id_user'];
                    $sqll = mysqli_query($link, "SELECT count(*) AS total FROM contacto WHERE (id_user = $id
                    AND id_user_dest = $id_user) OR (id_user = $id_user AND id_user_dest = $id)");
                    $sqll = mysqli_fetch_assoc($sqll);
                    if ($sqll['total'] <= 0) {
                        $row["ligacao"] = analizar_ligacao_entre_usuario($id);
                        array_push($pessoas_sugeridas, $row);
                        usort($pessoas_sugeridas,'comparar_peso');
                    }
                }
                foreach ($pessoas_sugeridas as $pessoas_sugerida) {

                    $id = $pessoas_sugerida['id_user'];
                    $imagen = pegar_foto_perfil("perfil",$id);
                    $nome = $pessoas_sugerida['nome'];
                    ?>
                        <div class="sms">
                            <div id="img_user" class="c1 cp1" style=" background-image: url(../media/img/<?=$imagen?>);"></div>
                            <div class="c1 cp2">
                                <div class="c2 nome"><a href="../perfil/?user=<?=criptografar($id)?>"><?=$pessoas_sugerida['nome']?></a></div>
                                <div class="c2 cont btn-sec" style="border: none; font-size: 11pt;">
                                    <div>
                                        <?php
                                        if ($pessoas_sugerida['qtd'] <= 0) {
                                            # code...
                                        }elseif($pessoas_sugerida['qtd'] == 1){
                                            echo $pessoas_sugerida['qtd']," amigo em comun";
                                        }elseif($pessoas_sugerida['qtd'] > 1 && $pessoas_sugerida['qtd']  <= 15) {
                                            echo $pessoas_sugerida['qtd']," amigos em comun";
                                        }else {
                                            echo "15+ amigos em comun";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <a href="./index.php?user=<?=criptografar($id)?>&nome=<?=criptografar($nome)?>">
                                    <div class="c2 cont btn-pri">
                                        <div>fazer pedido</div>
                                    </div>
                                </a>
                            </div>  
                        </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <?php
    include "../include/footer.php";
    ?>
    <script src="../js/fim_script.js"></script>
</body>
</html>