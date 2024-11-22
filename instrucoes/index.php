<?php
require "../algoritimos/atalho.php";
require "../algoritimos/seguranca.php";
$c = new process;
if (!isset($_SESSION['id_user'])) {
   ?>
   <script>
    document.location.href = "../";
   </script>
   <?php 
}else {
    $id_user = $_SESSION['id_user'];
}

$user = mysqli_query(conn(),"SELECT * FROM usuarios WHERE id_user = $id_user");
$user = mysqli_fetch_assoc($user);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/glou_icon.png" type="image/x-icon">
    <link href="../bibliotecas/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="../css/temas/padrao.css">
    <link rel="stylesheet" href="../css/welcome.css">
    <script src="../js/welcome.js"></script>
    <title>Bem vindo</title>
</head>
<body>
    <nav>
        <div class="linha esq"></div>
        <div><h1><span class="escrever_automatico" onclick="escrever()"><?=$user['nome']?></span> SEJA BEM VINDO A PRO-START</h1></div>
        <div class="linha dir"></div>
    </nav>
    <div></div>
    <footer>
        <div class="anterior"><</div>
        <a href="coder.php"><div class="proximo">></div></a>
    </footer>
</body>
</html>