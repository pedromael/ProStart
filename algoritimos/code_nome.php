<?php
function gerar($nome,$tentativas) {
    $nome = strtolower($nome);
    $nome = explode(" ",$nome);
    if (isset($nome[1])) {
        $nome[0] = preg_replace('/[^a-z0-9]/i',"", $nome[0]);
        $nome[-1] = preg_replace('/[^a-z0-9]/i',"", $nome[1]);
        $nome = $nome[0].strtoupper($nome[-1][0]);
    }else {
        $nome = $nome[0];
    }
    


    if ($tentativas > 0 && $tentativas < 11) {
        $code_nome = $nome/*substr($nome, 0, 3)*/ . mt_rand(1, 10);
        return $code_nome;
    }elseif ($tentativas > 10 && $tentativas < 31) {
        $code_nome = $nome/*substr($nome, 0, 3)*/ . mt_rand(11, 100);
        return $code_nome;
    }elseif($tentativas > 30){
        $code_nome = $nome/*substr($nome, 0, 3)*/ . mt_rand(100, 9999);
        return $code_nome;
    }elseif($tentativas == 0) {
        $code_nome = $nome;
        return $code_nome;
    }
    
}
function gerar_code_nome($name) {
    $conn = new mysqli("localhost","root","","pro_start");
    if ($conn->connect_error) {
        die("Não foi possível conectar ao banco de dados: " . $conn->connect_error);
    }
    $tentaivas = 0;

    $code_nome = gerar($name,$tentaivas);
    $sql = "SELECT * FROM usuarios WHERE code_nome = '$code_nome'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        do {
            $tentaivas++;
            $code_nome = gerar($name,$tentaivas);
            $sql = "SELECT * FROM usuarios WHERE code_nome = '$code_nome'";
            $result = $conn->query($sql);
        } while ($result->num_rows > 0);
    }

    $conn->close();
    return $code_nome;
}
?>