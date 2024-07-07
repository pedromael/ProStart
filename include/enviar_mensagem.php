<?php
include "../algoritimos/atalho.php";
include "../algoritimos/seguranca.php";
$data = json_decode(file_get_contents('php://input'), true);

$id_dest = intval(filtro(descriptografar($data['id_dest'])));
$texto= filtro($data['texto']);

$msg = new mensagens;
$msg->receptor = $id_dest;
$dados = $msg->enviar($texto,0);
$msg->mostrar($dados); 
