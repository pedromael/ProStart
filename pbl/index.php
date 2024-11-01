<?php
 require "../algoritimos/atalho.php";
 require "../algoritimos/seguranca.php";

 $c = new process;

 if (!isset($_SESSION["id_user"])) {
    header("location: ../login/");
 }
 $id_user = $_SESSION['id_user'];
 if (!isset($_GET['pbl'])) {
    #header("location: ../");
    ?>
        <script>
            document.location.href = "../"
        </script>
    <?php
 }else {
    $id_pbl = descriptografar($_GET['pbl']);
 }
?>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/glou_icon.png" type="image/x-icon">
    <link href="../bibliotecas/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/temas/<?=pegar_tema()?>.css">
    <link rel="stylesheet" href="../css/stilo.css">
    <link rel="stylesheet" href="../css/coder.css">
    <link href="../bibliotecas/codemirror-5.7/lib/codemirror.css" rel="stylesheet">
    <link rel="stylesheet" href="../bibliotecas/codemirror-5.7/theme/base16-dark.css">
    <link rel="stylesheet" href="../bibliotecas/codemirror-5.7/theme/dracula.css">
    <link rel="stylesheet" href="../bibliotecas/codemirror-5.7/theme/eclipse.css">
    <script src="../bibliotecas/codemirror-5.7/lib/codemirror.js"></script>
    <script src="../bibliotecas/codemirror-5.7/lib/codemirror.js"></script>
    <script src="../bibliotecas/codemirror-5.7/addon/hint/show-hint.js"></script>
    <script src="../bibliotecas/codemirror-5.7/addon/hint/javascript-hint.js"></script>
    <script src="../bibliotecas/codemirror-5.7/mode/javascript/javascript.js"></script>
    <title>Document</title>
</head>
<body>
    <script>var indereco="../";</script>
    <script src="../bibliotecas/jquery.js"></script>
    <script src="../js/script.js"></script>
    <nav id="nav_simples">
        <a href="../" class="link">pagina inicial</a>
    </nav>
    <div class="corpos">
        <div class="corpo3 crp"></div>
        <div id="corpo" class="crp">
            <div class="corpo_diminuido overflow-y-auto">
                <?php
                $poste = new postes;
                $post = $poste->poste($id_pbl);
                $poste->mostrar($post,true);
                if ($post['id_user'] == $_SESSION['id_user']) {
                    ?>
                    <div class="ops_perfil">
                        <a href="editar.php?id_pbl=<?=criptografar($id_pbl)?>"><div>editar</div></a>
                        <div>---</div>
                        <a href="editar.php?id_pbl=<?=criptografar($id_pbl)?>&eliminar"><div>eliminar</div></a>
                        <a href=""><div>---</div></a>
                    </div>
                    <?php
                }
                ?>
                <div class="comentarios">
                    <?php
                    $_SESSION['cmt_visualizado'] = array();
                    $comentarios =  new comentarios; 
                    $comentarios->id = $id_pbl;
                    $comentarios->pegar("pbl", 8);
                    ?>
                </div>
            </div>    
            <footer class="footer_chat">
                <div class="formulario_normal_de_envio">
                    <textarea name="texto_cmt" id="" placeholder="a tua opiniao e importante"></textarea>
                    <div class="carregar"  style="background-image: url(../bibliotecas/bootstrap/icones/file-earmark-image.svg);"></div>
                    <button name="btn_cmt" style="background-image: url(../bibliotecas/bootstrap/icones/send.svg);" class="form-control" onclick="comentar('<?=criptografar($id_pbl)?>','pbl',0)"></button>
                </div>
            </footer>
        </div>
        <div class="corpo2 crp"></div>
    </div> 
    <?php $abrir_nav= "segundo"; require "../include/footer.php"; ?>
    <script src="../js/fim_script.js"></script>
    <script src="../js/coder.js"></script>
    <?php
     if (isset($_GET['cmt'])) {
        if (!empty($_GET['cmt'])) {
            ?><script>rolagem_automatica("#cmt")</script><?php
        }
     }
    ?>
</body>
</html>