<?php
require "../algoritimos/atalho.php";
require "../algoritimos/seguranca.php";
unset($_SESSION['id_user']);
$c = new sig_in;
?>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../src/img/glou_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../src/css/temas/branco.css">
    <link href="../bibliotecas/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../src/css/stilo.css">
    <title>Login</title>
</head>
<body id="inicio">
    <nav class="nw-100 nav_login">
        <h1><a href="sig-in.php">Cadastrar</a></h1>
    </nav>
    <div class="corpos">
        <div class="login_conteiner">
            <div class="size80 center login">
                <p></p>
                <div class="img">
                    <img src="../src/img/glou_icon.png" alt="">
                </div>
                <form name="Game" method="post">
                    <fieldset class="login">
                        <div class="bg">
                            <div>
                                <p class="text-center">Pagina de Login</p>
                                <input class="form-control" type="email" name="e" id="" placeholder="email de usuario" required>
                            </div>
                            <div>
                                <p class="text-center"></p>
                                <input class="form-control" type="password" name="s" placeholder="palavra passe" required>
                            </div>
                            <p></p>
                            <div class="size80">
                                <button class="form-control button">entrar</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <p id="" class="text-center info_login"><a href="recuperar.php">esquece a minha conta</a></p>
            </div>
        </div>
        <div class="login_conteiner_2"></div>
    </div>
    <footer class="footer">
        <div>
            <a href="#">mais info...</a>
        </div>
    </footer>
</body>
</html>
<?php
if (isset($_POST['e'])) {
    $senha = filtro($_POST['s']);
    $email = filtro($_POST['e']);
    if (!empty($senha) && !empty($email)) {
        if ($c->logar($email,$senha)) {
            #header("location: ../");
            if ($_SESSION['id_user'] == 4) {
                ?>
                <script>
                    document.location.href = "../adm/?usuarios"
                </script>
            <?php
            }
            ?>
                <script>
                    document.location.href = "../"
                </script>
            <?php
        } else {
            ?>
            <div class="erro_ao_entrar">
                dados de acesso incorretos
            </div>
            <?php
        }
    } else {
        ?>
        <div class="erro_ao_entrar">
            erro ao conectar banco de dados
        </div>
        <?php
    }
}
?>