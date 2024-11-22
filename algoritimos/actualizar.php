<?php
require "../algoritimos/atalho.php";
require "../algoritimos/seguranca.php";
$c = new process;
$chat = $c->verificar_qtd("chat",$_SESSION['id_user']);
//$notific = verificar_qtd("notificacao",$_SESSION['id_user']);

$resposta = array(
    'chat' => $chat
    //'notific' => $notific
);

header('Content-Type: application/json');
echo json_encode($resposta);
?>