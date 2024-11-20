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
    $pdo = (new conexao)->pdo;
    $tentaivas = 0;

    $code_nome = gerar($name,$tentaivas);

    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE code_nome = '$code_nome'");
    $sql->execute();
    if ($sql->rowCount() > 0) {
        do {
            $tentaivas++;
            $code_nome = gerar($name,$tentaivas);

            $sql = $pdo->prepare("SELECT * FROM usuarios WHERE code_nome = '$code_nome'");
            $sql->execute();
        } while ($sql->rowCount() > 0);
    }

    return $code_nome;
}
?>