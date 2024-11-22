<?php
require "../algoritimos/atalho.php";
require "../algoritimos/seguranca.php";
$s = new selecionar_feed();
$s->quantidade_de_postes = 2;
// // $s->codigos->indereco = "./";
// $s->codigos->indereco_code = "../";
if ($s->selecionar_poste("") == 404) {
    
}else {

}
?>
