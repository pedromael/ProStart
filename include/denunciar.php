<?php
require "../conect.php";
$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];
$tipo = $data['tipo'];
$id_razao = $data['id_razao'];

session_start();
$id_user = $_SESSION['id_user'];

$sql = mysqli_query(conn(), "SELECT id_denuncia,count(*) AS valor FROM $bdnome2.denuncias WHERE id_user=$id_user AND id=$id AND tipo='$tipo'");
$sql = mysqli_fetch_assoc($sql);
if ($sql['valor'] > 0) {
    return false;
}else {
    $sql = mysqli_query(conn(), "INSERT INTO $bdnome2.denuncias (id_user,id,tipo,id_razao,data)
    VALUES($id_user,$id,'$tipo','$id_razao',now())");
    return true;
}
?>