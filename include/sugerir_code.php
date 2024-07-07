<?php
include "../algoritimos/atalho.php";
include "../algoritimos/seguranca.php";
$data = json_decode(file_get_contents('php://input'), true);

$id_code = intval(filtro(descriptografar($data['id_code'])));
$dados['descricao'] = filtro($data['descricao']);

$process = new postar_codigo;
 
if ($id_code = $process->sugerir_code($dados,$id_code)) {
    $indereco = "../media/codes/";
    $nome = $id_code."s-code-".$_SESSION['id_user']."-".rand(0,999);
    if (!is_dir($indereco)) {mkdir($indereco);}
    $ext =".txt";
    file_put_contents($indereco.$nome.$ext,$data['code']);   
    $process->process->carregar_documento($id_code,'code_sugestao',$nome.$ext); 
}
?>