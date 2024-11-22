<?php
require "../algoritimos/atalho.php";
$c = new process;

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$tipo = $data['tipo'];

$c->reagir($id,$tipo);

$reacao = $c->pdo->prepare("SELECT * FROM $bdnome2.gosto WHERE id=:id AND tipo = :t");
$reacao->bindValue(":id", $id);
$reacao->bindValue(":t", $tipo);
$reacao->execute();

$reacao_numero = $reacao->rowCount();
if ($reacao->rowCount() <= 0) {
    $reacao_numero = "";
}
echo $reacao_numero;
?>