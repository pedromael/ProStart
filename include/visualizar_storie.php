<?php
require "../algoritimos/atalho.php";
require "../algoritimos/seguranca.php";
$data = json_decode(file_get_contents('php://input'), true);
$storie = new stories;
$dados = $storie->storie_info($data['id_user'],true);
foreach ($dados['stories'] AS $value) {
    ?>
    <div>
        <div><?=$dados['nome']?></div>
        <img src="media/img/<?=$value['indereco_img']?>" alt="">
    </div>
    <?php
}
?>