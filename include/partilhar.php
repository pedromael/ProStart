<?php
require "../algoritimos/atalho.php";
require "../algoritimos/seguranca.php";
$c = new process;
$data = json_decode(file_get_contents('php://input'), true);

$id = filtro($data['id']);
$tipo = filtro($data['tipo']);
$texto= filtro($data['descricao']);

session_start();
$id_user = $_SESSION['id_user'];

if (isset($id)) {
    if (!isset($id_comunidade)) {
        $id_comunidade = 0;
    }
    if (true) {
        if  ($id_pbl = $c->publicar($texto,$id_comunidade,NULL)) {
            $sql = mysqli_query(conn(), "INSERT INTO $bdnome2.partilha (id1,id2,tipo)
            VALUES($id_pbl,$id,'$tipo')");
            if (mysqli_fetch_assoc($sql)) {
                echo "publicou";
            }
        } else {
            echo "ocorreu algum erro ao realizar publicacao";
        }
    }
}
?>