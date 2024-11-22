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
if ($_SESSION['id_user'] == 4) {
    ?>
    <script type="text/javascript">
        window.location.href="adm/?usuarios";
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
    <meta http-equiv="Cache-Control" content="max-age=3600">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/glou_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/temas/<?=pegar_tema()?>.css">
    <link href="bibliotecas/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bibliotecas/codemirror-5.7/lib/codemirror.css" rel="stylesheet">
    <link rel="stylesheet" href="bibliotecas/codemirror-5.7/theme/base16-dark.css">
    <link rel="stylesheet" href="bibliotecas/codemirror-5.7/theme/dracula.css">
    <link rel="stylesheet" href="bibliotecas/codemirror-5.7/theme/eclipse.css">
    <script src="bibliotecas/codemirror-5.7/lib/codemirror.js"></script>
    <script src="bibliotecas/codemirror-5.7/lib/codemirror.js"></script>
    <script src="bibliotecas/codemirror-5.7/addon/hint/show-hint.js"></script>
    <script src="bibliotecas/codemirror-5.7/addon/hint/javascript-hint.js"></script>
    <script src="bibliotecas/codemirror-5.7/mode/javascript/javascript.js"></script>
    
    <link rel="stylesheet" href="css/stilo.css">
    <link rel="stylesheet" href="css/coder.css">
    <title>Pro-Start</title>
</head>
<body> 
    <script>var indereco="./";</script>
    <script src="bibliotecas/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/coder.js"></script>
    <nav id="metade_da_nav" onclick="abri_fecha('#segunda_nav')">
        <img src="bibliotecas/bootstrap/icones/border-width.svg">
    </nav>
    <nav class="px-3 py-2">
      <div class="container_nav">
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
              <a href="coder/" class="nav-link text-white">
                <a href="coder/" id="coder"><button>CODER</button></a>
              </a>
            </li>
            <li>
                <a href="mensagens/" class="nav-link text-white">
                    <img src="bibliotecas/bootstrap/icones/chat-left-dots.svg"/> 
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
              <a href="notific.php" class="nav-link text-white">
                <img src="bibliotecas/bootstrap/icones/bell.svg"/>
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
          <div class="pesquisar">
            <form action="search.php" method="GET">
                <input type="search" name="valor" placeholder="em que esta pensando">
                <button name="btn" style="background-image: url(bibliotecas/bootstrap/icones/search.svg);"></button>
            </form>
          </div>
        </div>
      </div>
    </nav>
    <?php
    $abrir_nav = "primeiro";
    require "include/nav.php";
    ?>
    <div class="visualizar_storie remover">
        <div onclick="abrir_storie('remover')" class="removedor">X</div>
        <div class="container overflow-y-auto"></div>
    </div>
    <div class="corpos">
        <div class="corpo3 crp"></div>
        <div id="corpo" class="crp">
            <div id="alerta" class="novo_storie remover">
                <div class="modal modal-sheet d-block p-4 py-md-5" tabindex="-1" role="dialog" id="modalSheet">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content rounded-4 shadow">
                            <div class="modal-header border-bottom-0">
                                <h1 class="modal-title fs-5">Novo storie</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="aba_alert('.novo_storie')"></button>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="modal-body py-0"> 
                                    <div>
                                        <input type="file" name="img_storie[]" alt="" class="form-control" accept="image/*" multiple>
                                    </div>
                                </div>
                                <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
                                    <input name="btn_storie" type="submit" class="btn bg-sec" value="postar storie"> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if (isset($_POST['btn_storie'])) {
                if (isset($_FILES['img_storie'])) {
                    $nome = $_FILES['img_storie']['name'];
                    $tmp = $_FILES['img_storie']['tmp_name'];
                    $type = $_FILES['img_storie']['type'];
                    $size = $_FILES['img_storie']['size'];
                    $a =0;
                    $imagens = array();
                    while ($a < count($nome)) {
                        array_push($imagens,array("name"=>$nome[$a],"tmp_name"=>$tmp[$a],"type"=>$type[$a],"size"=>$size[$a]));
                        $a++;
                    }
                    carregar_img_storie($imagens);
                }
            }
            ?>
            <div id="prev" onload="alert('carregou')">
                <div class="trans trans_dir"></div>
                <div class="trans trans_esq"></div>
                <div class="scroll overflow-y-auto">
                    <div class="scroll_content">
                        <div class="item carregar_storie" style="background: rgba(255,255,255,0.5) url(media/img/<?=pegar_foto_perfil('perfil',$id_user)?>) center center/cover;" onclick="aba_alert('.novo_storie')"><p>+</p></div>
                        <?php
                        $storie = new stories;
                        foreach ($storie->stories as $row) {
                            $dados = $storie->storie_info($row['id_user']);
                            ?> 
                            <div class="item" onclick="abrir_storie(<?=$row['id_user']?>)" style="background-image : url(media/img/<?=$dados['bg_storie']?>);">
                                <div class="usuario">
                                    <div class="nome">
                                        <?=$dados['nome']?>
                                    </div>
                                </div>
                                <div class="numero_de_storie">
                                    <div class="content">
                                    <?php
                                    foreach ($dados['contagem'] as $i) {
                                        if ($i) {$i = "visto";}else {$i = "n_visto";}
                                        ?>
                                        <div class="<?=$i?>"></div>
                                        <?php
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div>
                <!--<div id="pbl_abrir" onmouseover="personalizar('#pbl_abrir')" onclick="publicar('fazer publicacao')">
                    <button>fazer publicacao</button>
                </div>-->
                <div id="pbl_insert" class="conteiner_pbl">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input class="file remover" id="input_file_pbl" type="file" name="doc[]" class="form-control" accept="image/*" multiple>
                        <div class="formulario_normal_de_envio max">
                            <textarea name="texto" id="" placeholder="deixe aqui a tua dica de hoje"></textarea>
                            <label for="input_file_pbl"><div class="carregar"  style="background-image: url(bibliotecas/bootstrap/icones/file-earmark-image.svg);"></div></label>
                            <button name="btn_pbl" style="background-image: url(bibliotecas/bootstrap/icones/send.svg);" class="form-control"></button>
                        </div>
                    </form>
                    <?php require "sent.php"; ?>
                </div>
            </div>
            <?php
            if (isset($_GET['pbl'])) {
                if ($_GET['pbl']) {
                    $id_pbl = descriptografar($_GET['pbl']);
                    ?>
                        <div class="info_corrente">publicacao carregada com sucesso</div>
                    <?php
                }else {
                    ?>
                        <div class="info_corrente">erro ao carregar imagen</div>
                    <?php
                }
            }
            if (isset($_GET['pbl_eliminada'])) {
                if ($_GET['pbl_eliminada'] = "true") {
                    ?>
                        <div class="info_corrente_red">publicacao eliminada com sucesso</div>
                    <?php
                }
            }
            ?>
            <div class="outros_pbl">
                <div id="alerta" class="pbl_denuncia remover">
                    <div class="modal modal-sheet d-block p-4 py-md-5" tabindex="-1" role="dialog" id="modalSheet">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content rounded-4 shadow">
                                <div class="modal-header border-bottom-0">
                                    <h1 class="modal-title fs-5">algum motivo especifico</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="aba_carregar_foto()"></button>
                                </div>
                                    <div class="modal-body py-0"> 
                                        <?php
                                        /*$motivos = mysqli_query($this->link, "SELECT * FROM $this->bdnome2.razoes_para_denuncias");
                                        
                                        while ($motivo = mysqli_fetch_assoc($motivos)) {
                                            ?>
                                                <p><label for="m<?=$motivo['razao']?>"><?=$motivo['razao']?></label><input type="radio" name="razao" id="m<?=$motivo['razao']?>"  class="razao" value="<?=$motivo['id_razao']?>"></p>
                                            <?php
                                        }*/
                                        ?>
                                        <input type="text" name="id_pbl" id="id_pbl_da_denuncia" class="remover">
                                    </div>
                                    <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
                                        <input name="btn_img"  onclick="denunciar('pbl')" type="submit" class="btn bg-sec" value="denunciar"> 
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="alerta" class="pbl_partilhar remover">
                    <div class="modal modal-sheet d-block p-4 py-md-5" tabindex="-1" role="dialog" id="modalSheet">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content rounded-4 shadow">
                                <div class="modal-header border-bottom-0">
                                    <h1 class="modal-title fs-5">opcoes de partilha</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="aba_alert('.pbl_partilhar')"></button>
                                </div>
                                <div class="modal-body py-0"> 
                                    <div>
                                        <textarea name="descricao" id="" class="form-control descricao_partilha" placeholder="de uma descricao a sua partilha"></textarea>
                                    </div>
                                    <input type="text" name="id_pbl" id="id_pbl_da_partilha" class="remover">
                                    <input type="text" name="tipo" id="tipo_da_partilha" class="remover">
                                </div>
                                <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
                                    <input name="btn_img"  onclick="partilhar('pbl')" type="submit" class="btn bg-sec" value="partilhar"> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pbls">
                <?php
                $_SESSION['visualizado'] = array();
                $_SESSION['code_visualizado'] = array();
                $s = new selecionar_feed();
                if (isset($id_pbl)) {
                    if ($id_pbl > 0) {
                        $pbl = new postes();
                        $pbl->para = "pagina_inicial";
                        $pbl->oque = "pbl";
                        $pbl->mostrar($pbl->poste($id_pbl)); 
                    } 
                }
                $s->quantidade_de_postes = 0;
                $s->selecionar_poste("");
                ?>
            </div>
            <?php
            if ($s->postes_encotrados < $s->quantidade_de_postes) {
                ?>
                    <div class="texto_interativo">
                        entre em <a href="comunidade/?abrir=pdd" class="destaque"><span>comunidades</span></a> com interesses de sua escolha,
                        adiciona mais <a href="contactos/?abrir=pdd" class="destaque"><span>contactos</span></a> a sua lista de contactos,
                        para recheares a sua <a href="" class="destaque"><span>pagina inicial</span></a>
                    </div>
                <?php
            }else {
                ?>
                    <div class="mais_pbl_process"></div>
                <?php
            }
            ?>
        </div>    
        <div class="corpo2 crp"></div> 
    </div>   
    <?php 
        require "include/footer.php";
        require "include/search.php";
        mysqli_close(conn());
    ?>
    <script src="bibliotecas/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/fim_script.js"></script>
    <script src="js/coder.js"></script>
</body>
</html>