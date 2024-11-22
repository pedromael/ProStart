<?php
 require "../algoritimos/atalho.php";
 require "../algoritimos/seguranca.php";

 $c = new process;
 $cmdd = new comunidade;

 if (!isset($_SESSION["id_user"])) {
    ?>
    <script>
        document.location.href = "../login/"
    </script>
    <?php
 }else {
    $id_user = $_SESSION["id_user"];
    $user = mysqli_query(conn(), "SELECT * FROM usuarios WHERE id_user=$id_user");
    $user = mysqli_fetch_assoc($user);
    $imagen = pegar_foto_perfil("perfil",$id_user);
   }
 $id_user = $_SESSION['id_user'];

 if (isset($_GET['abrir'])) {
    if ($_GET['abrir'] == "pdd") {
        $novos = "pdd";
    }
    if ($_GET['abrir'] == "nova") {
        $novos = "nova";
    }
    if ($_GET['abrir'] == "") {
        $novos = false;
    }
 }
 if (!isset($novos)) {
    $novos = false;
 }
?>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bibliotecas/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link rel="icon" href="../img/glou_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/temas/<?=pegar_tema()?>.css">
    <link rel="stylesheet" href="../css/stilo.css">
    <link rel="stylesheet" href="../css/comunidade.css">
    <title>Contactos</title>
</head>
<body>
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
              <a href="../coder.php" class="nav-link text-white">
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
        <div id="aps" class="">
            <div class="block">
                <a href="lista.php?abrir=nova" class="text-center btn_simples2">criar comunidade</a>
            </div>
            <div class="block">
                <div class="inline">
                <a href="./lista.php" class="btn_simples 
                <?php
                    if (!isset($_GET['abrir'])) {
                        echo "selecionado";
                    }
                ?>
                ">minhas comunidades</a>
                </div>
                <div class="inline">
                    <a href="./lista.php?abrir=pdd" class="btn_simples 
                    <?php
                        if (isset($_GET['abrir'])) {
                            if ($_GET['abrir'] == 'pdd') {
                                echo "selecionado";
                            } 
                        }
                    ?>
                    ">procurar comunidades</a>
                </div>
            </div>
            
        </div>
        <a href="lista.php?abrir=nova">
            <div class="ops_nova_comunidade btn bg-sec">Criar nova comunidade</div>
        </a>
        <div class="corpo_metade1 rolagem_vertical">
        <h1 class="titulo1"><a href="./">minhas comunidades</a></h1>
            <?php
            if ($novos == "nova") {
                ?>
                <div id="cadastro">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div>
                            <p>Nome</p>
                            <input type="text" name="nome" class="form-control" placeholder="digite o nome da comunidade" required>
                        </div>
                        <div>
                            <p>descricao</p>
                            <textarea name="descricao" class="form-control"></textarea>
                        </div>
                        <div>
                            <p></p>
                            <input type="submit" class="form-control bg-sec" value="prosseguir">
                        </div>
                    </form>
                </div>
                <?php
                if (isset($_POST['nome'])) {
                    $nome = filtro($_POST['nome']);
                    $descricao = filtro($_POST['descricao']);
                    if (!empty($nome) && !empty($descricao)) {
                        if ($id = $cmdd->criar_comunidade($nome,$descricao)) {
                            #header("location: ./?cmndd=".criptografar($id));
                            ?>
                            <script> 
                                document.location.href = "./?cmndd=<?=criptografar($id)?>"
                            </script>
                            <?php
                        }else {
                            echo "ocorreu um erro na criacao da comunidade";
                        }
                    }
                }
            }else{
                ?>
                <div>
                <?php
                $num = $cmdd->minhas_comunidade();
                    if ($num < 5) {
                        ?>
                        <div class="alert1">
                            <div class="texto_interativo">Navega em <a href="./lista.php?abrir=pdd" class="destaque"><span>procurar comunidades</span></a> para aumentar sua experiencia na <span>Glou Game</span></div>
                        </div>
                        <?php
                    }else {
                        if ($num < 8) {
                            ?>
                                <div id="mais_pbl"><a href="./">Ver Mais</a></div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <?php
            }
            ?> 
        </div>
        <div class="corpo_metade2 rolagem_vertical">
        <h1 class="titulo1">comunidades sugeridas</h1>
        <?php
        if($novos == "pdd" || true){
                ?>
                <div>
                <?php
                /*encontrar novas comunidades*/
                    if (isset($_GET['cmndd'])) {
                        $id_comunidade = filtro(descriptografar($_GET['cmndd']));

                        $sql = mysqli_query(conn(), "SELECT * FROM comunidade WHERE id_comunidade=$id_comunidade");
                        $sql = mysqli_fetch_assoc($sql);
                        $nome = $sql['nome'];
                        if ($caso = $cmdd->entrar_na_comunidade($id_comunidade)) {
                            if ($caso == 1) {
                                ?>
                                    <div class="info_corrente">agora es um membro da(o) <a href="./?cmndd=<?=criptografar($id_comunidade)?>"><span><?=$nome?></span></a>, acessa para saber mais</div>
                                <?php
                            }else {
                                ?>
                                    <div class="info_corrente">pedido de participacaoo enviado para <span><?=descriptografar($nome)?></span> com sucesso</div>
                                <?php
                            }                  
                        }else {
                            ?>
                                <div class="info_corrente">ocorreu algum erro no pedido de participacao para <span><?=descriptografar($nome)?></span></div>
                            <?php
                        }
                    }
                    $cmdd->comunidades_sugerida();
                    ?>
                </div>
                <?php
            }?>
        </div>
    </div>
    <?php
    include "../include/footer.php";
    ?>
</body>
</html>