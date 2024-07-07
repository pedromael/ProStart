<?php
include "../algoritimos/atalho.php";
include "../algoritimos/seguranca.php";
$data = json_decode(file_get_contents('php://input'), true);
$id_user = filtro(descriptografar($data['id_user'])); 
$user = new informacoes_usuario;
$lista = $user->lista_amigos($id_user);
?>
<div class="container_amigos_prox overflow-y-auto">
    <h1 class="titulo1">listas de usuarios (<span><?=count($lista)?>)</span></h1>
    <?php
    $user->indereco = filtro($data['indereco']);
    foreach ($lista as $key) {
        $user->mostrar_amigos($key);
    }
    ?>
</div>