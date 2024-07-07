<?php
include "../algoritimos/atalho.php";
include "../algoritimos/seguranca.php";
$data = json_decode(file_get_contents('php://input'), true);

$dados=[
    'descricao'=>filtro($data['descricao']),
    'id_code'=>intval(filtro(descriptografar($data['id_code']))),
    'code'=>$data['code']
];
$process = new postar_codigo;
 
if ($data['e_sugestao'] == "sim") {
    $process->postar_codigo($dados,$dados['code'],true);
}else {
    $process->postar_codigo($dados,0,true);
}
echo "nova versao postada com sucesso";
?>