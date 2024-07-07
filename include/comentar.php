<?php
include "../algoritimos/atalho.php";
include "../algoritimos/seguranca.php";
$data = json_decode(file_get_contents('php://input'), true);

$id = intval(filtro(descriptografar($data['id'])));
$tipo = filtro($data['tipo']);
$texto= filtro($data['texto']);
$cmt_res = intval(filtro(descriptografar($data['cmt_res'])));

$process = new comentarios;
$dados = $process->comentar($id,$texto,$cmt_res,$tipo);
$process->mostrar($dados);
?>