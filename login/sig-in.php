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
    <link rel="icon" href="../img/glou_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/temas/branco.css">
    <link href="../bibliotecas/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/stilo.css">
    <title>Sig-in</title>
</head>
<body id="inicio">
    <nav class="nw-100 nav_login">
        <strong><h1><a href="./">Entrar</a></h1></strong>
    </nav>
    <div class="corpos">
        <div class="login_conteiner">
            <div class="size80 center login">
                <div class="img_icone">
                    <img src="../img/glou_icon.png" alt="">
                </div>
                <form name="Game" method="post">
                    <fieldset class="login">
                        <div class="bg">
                            <div>
                                <p class="text-center">Nome</p>
                                <input class="form-control" type="text" name="n" id="nome" required>
                            </div>
                            <div>
                                <p class="text-center">E-mail</p>
                                <input class="form-control" type="email" name="e" id="email" required>
                            </div>
                            <div>
                                <p class="text-center">Pais De Residencia</p>
                                <select class="form-control" name="p" id="pais">
                                    <?php
                                    //Preparando os dados para o select país
                                    $select_pais = "SELECT * FROM pro_start_outros.pais ORDER BY nome;";                    
                                    $paises = mysqli_query(conn(), $select_pais);
                                    while ($pais = mysqli_fetch_assoc($paises)) {
                                        if ($pais['nome'] == "Angola") {
                                            ?>
                                                <option class="form-control" selected value="<?=$pais['id_pais']?>"><?=$pais['nome']?></option>
                                            <?php
                                        }else {
                                            ?>
                                            <option class="form-control" value="<?=$pais['id_pais']?>"><?=$pais['nome']?></option>
                                            <?php
                                        }                                    
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <p class="text-center">Senha</p>
                                <input class="form-control" type="password" name="s" id="senha_sig" required>
                            </div>
                            <div>
                                <p class="text-center">confirmar Senha</p>
                                <input class="form-control" type="password" name="cs" id="senha_conf" required>
                            </div>
                            <p style=" margin: 0px;">P-start: 1.0.0</p>
                        </div>
                        <div class="size80">
                            <button class="form-control button">cadastrar</button>
                        </div>
                    </fieldset>
                </form>
                <p id="" class="text-center info_login"><a href="./">ja tem uma conta</a></p>
            </div>
        </div>
        <div class="login_conteiner_2"></div>
    </div>    
    <footer class="footer">
        <div>
            <a href="#">mais info...</a>
        </div>
    </footer>
    <script src="../js/login.js"></script>
</body>
</html>
<?php
if (isset($_POST['e'])) {
    $senha = filtro($_POST['s']);
    $c_senha = filtro($_POST['cs']);
    $email = filtro($_POST['e']);
    $pais = filtro($_POST['p']);
    $nome = filtro($_POST['n']);
    if (!empty($senha) && !empty($email) && !empty($pais) && !empty($nome) && !empty($c_senha)) {
        if ($senha == $c_senha) {
            if (verificar_requisito_de_seguranca_de_senha($senha)) {
                require "../algoritimos/code_nome.php";
                if ($c->cadastrar($nome,$email,$pais,$senha)) {
                    $c = new process;
                    #if ($c->publicar($texto,$id_comunidade,$null,$tipo)) {
                        # code...
                    #}
                    ?>
                        <script>
                            document.location.href = "../instrucoes/"
                        </script>
                    <?php
                } else {
                    ?>
                    <div class="erro_ao_entrar">
                        ja existe um usuario com esse email
                    </div>
                    <?php
                }
            }else {
                ?>
                <div class="erro_ao_entrar">
                    senhas nao tem requisito minimo de seguranca
                </div>
                <?php
            }
        } else {
            ?>
            <div class="erro_ao_entrar">
                senhas nao correspondem
            </div>
            <?php
        }
    } else {
        ?>
        <div class="erro_ao_entrar">
            preencha todas as abas
        </div>
        <?php
    }
}
?>