<?php
session_start();
require "algoritimos/atalho.php";
require "algoritimos/seguranca.php";

$c = new process;
if (!isset($_SESSION['id_user'])) {
    ?>
    <script>
        document.location.href = "./";
    </script>
    <?php
}
$linguagens_programacao = mysqli_query(conn(), "SELECT * FROM $bdnome2.linguagens_programacao");
$areas_programacao = mysqli_query(conn(), "SELECT * FROM $bdnome2.areas_programacao");

?>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/glou_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/temas/padrao.css">
    <link href="bibliotecas/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/stilo.css">
    <title>Mais</title>
</head>
<body id="inicio">
    <nav class="nw-100 nav_login">
        <strong><h1>Melhor experiencia na PRO-Start</h1></strong>
    </nav>
    <div id="corpo_inicio">
        <div class="mais_dados">
            <form action="">
                <div>
                    <div>
                        seleciona as linguagem de progamacao que usas, ou que tens interece em aprender...
                       <br> e deixe que a PRO-start seleciona o melhor feed e as melhores comunidades para voce. 
                    </div>
                    <?php
                    while ($key = mysqli_fetch_assoc($linguagens_programacao)) {
                        ?>
                        <div class="caixa">
                            <input type="checkbox" name="linguagem[]" value="<?=$key['id_linguagem']?>" id="<?="lp".$key['id_linguagem']?>"><label for="<?="lp".$key['id_linguagem']?>"><?=$key['nome']?></label>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div>
                    <div>
                        seleciona as areas como progamador que acupas, ou que tens interece em axercer algun dia...
                    </div>
                    <?php
                    while ($key = mysqli_fetch_assoc($areas_programacao)) {
                        ?>
                        <div class="caixa">
                            <input type="checkbox" name="area[]" value="<?=$key['id_area']?>" id="<?="ar".$key['id_area']?>"><label for="<?="ar".$key['id_area']?>"><?=$key['nome']?></label>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>   
    <script src="js/login.js"></script>
</body>
<?php

?>
</html>