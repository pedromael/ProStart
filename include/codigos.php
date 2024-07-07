<?php
require "../algoritimos/atalho.php";
require "../algoritimos/seguranca.php";
$data = json_decode(file_get_contents('php://input'), true);
$_SESSION['code_lista_visualizado'] = array();
$codigos = new codigos;
$codigos->indereco = $data['indereco'];
$codigos->pegar_codigo_para_lista(10);
?>