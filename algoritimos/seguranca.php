<?php
function filtro($text)
{
    if (file_exists("../bibliotecas/Faker-master/src/autoload.php")) {
        require "../bibliotecas/Faker-master/src/autoload.php";
    }else {
        require "bibliotecas/Faker-master/src/autoload.php";
    }
    $f = Faker\Factory::create("pt_BR");

    $text = filter_var($text, 513);

    if (str_contains($text,"=texto:")) {
        $text = str_replace("=texto:",$f->text(),$text);
    }
    if (str_contains($text,"=email:")) {
        $text = str_replace("=email:",$f->email,$text);
    }
    if ($text == "=terminar_s:" && false) {
        unset($_SESSION['id_user']);
        session_destroy();
        header("location: ./");
    }
    return $text;
}

function criptografar($text)
{
    filtro($text);
    //$text = decbin($text);
    $text = base64_encode($text);
    return $text;
}
function descriptografar($text)
{
    filtro($text);
    $text = base64_decode($text);
    //$text = bindec($text);
    return filtro($text);
}
function verificar_requisito_de_seguranca_de_senha($senha) {
    return true;
}
?>
