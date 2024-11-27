<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
function autoloader($class) {
    $indereco = __DIR__.'/classes/'.str_replace('\\','/',$class).".php";
    if (file_exists($indereco)) {
        require $indereco;
    }else {
        $indereco = __DIR__.'/../classes/'.str_replace('\\','/',$class).".php";
        if (file_exists($indereco)) {
            require $indereco;
        }
    }
}
spl_autoload_register('autoloader');
if (isset($_SESSION['id_user'])) {
    $user = new informacoes_usuario;
    $user = $user->user;
}
if(/*$_SESSION['adm']==true &&*/ false){
    if (__DIR__ != "./projecto%20da%20defesa%20final/adm/") {
        if (is_dir("../adm/")) {
            ?>
            <script>
                window.location.href ="../adm/";
            </script>
            <?php
        }elseif(is_dir("./adm/")) {
            ?>
            <script>
                window.location.href ="./adm/";
            </script>
            <?php
        }
    }
}

$bdnome2 = (new conexao)->bdnome2;
function conn()
{
    $c = new conexao;
    return mysqli_connect($c->bdhost,$c->bduser,$c->bdpass,$c->bdnome); 
}

function inserir_historico($tipo, $id, $id_cmt = 0) {
    $conexao = new conexao;
    $sql = $conexao->pdo->prepare("INSERT INTO $conexao->bdnome2.historico(id_user,id,tipo,data) VALUES(:user,:id,:t,NOW())");
    $sql->bindValue(":user", $_SESSION['id_user']);
    $sql->bindValue("t", $tipo);
    $sql->bindValue(":id", $id);
    if ($sql->execute()) {
        if ($id_cmt) {
            $sql = $conexao->pdo->prepare("INSERT INTO $conexao->bdnome2.historico_id(id_historico,id) VALUES(:h,:id)");
            $sql->bindValue(":h", $conexao->pdo->lastInsertId());
            $sql->bindValue(":id", $id_cmt);
            $sql->execute();
            return true;
        }
    }else {
        return false;
    }
}
function resumir_texto($string,$tamanho) 
{
    $n = strlen($string);
    $tres_pontos = "";
    if ($n > $tamanho) {
        $n = $tamanho;
        $tres_pontos = "...";
    }
    $texto = "";
    $nn = 0;
    while ($nn != $n) {
        $texto = $texto.$string[$nn];
        $nn++;
    }
    return $texto = $texto." ".$tres_pontos;
}
function Verificar_pontuacao($row,$id_user) {
    global $bdnome2;
    $id = $row['id_user'];
    $id_pbl = $row['id_pbl'];
    $pontuacao = 0;

    $user1 = mysqli_query(conn(), "SELECT * FROM usuarios WHERE id_user= $id");
    $user1 = mysqli_fetch_assoc($user1);
    $user2 = mysqli_query(conn(), "SELECT * FROM usuarios WHERE id_user= $id_user");
    $user2 = mysqli_fetch_assoc($user2);

    $pontuacao = $pontuacao + 2 * verificar_contactos_em_comum($id_user,$id);
    
    if ($user1['id_pais'] == $user2['id_pais']) {
        $pontuacao =  $pontuacao + 5;
    }else {
        $pontuacao =  $pontuacao - 20;
    }

    $vistos = mysqli_query(conn(), "SELECT COUNT(*) AS qtd FROM $bdnome2.visto WHERE id = $id_pbl AND tipo='pbl'");
    $qtd_vistos = mysqli_fetch_assoc($vistos);
    $reacao = mysqli_query(conn(), "SELECT COUNT(*) AS qtd FROM $bdnome2.gosto WHERE id = $id_pbl AND tipo='pbl'");
    $qtd_reacao = mysqli_fetch_assoc($reacao);

    if ($qtd_reacao['qtd'] <= 0) {
        $qtd_reacao['qtd'] = 1;
    }
    if ($qtd_vistos['qtd'] <= 25) {
        $qtd_vistos['qtd'] = 25;
    }

    $media_de_aceitacao = ($qtd_reacao['qtd'] / $qtd_vistos['qtd']) * (100);
    $pontuacao = $pontuacao + $media_de_aceitacao;
    
    return $pontuacao;
}
function verificar_se_e_partilha($id_pbl,$bdnome2) {
    $partilha = mysqli_query(conn(), "SELECT count(*) AS valor,id2 FROM $bdnome2.partilha WHERE id1 = $id_pbl");
    $partilha = mysqli_fetch_assoc($partilha);
    if ($partilha['valor'] >= 1) {
        $id_pbl_partilha = $partilha['id2'];
        $partilha = mysqli_query(conn(), "SELECT * FROM pbl WHERE id_pbl = $id_pbl_partilha");
        return mysqli_fetch_assoc($partilha);
    }else{
        return false;
    }
}
function verificar_peso($a,$b){
    return $b['pontuacao'] - $a['pontuacao'];
}
function verificar_contacto($id,$id2) {
    if (rand(1,2) == 1) {
        return true;
    }else {
        return false;
    }
}
function qtd_de_reacao($id, $tipo = "pbl") {
    global $bdnome2;
    $query = mysqli_query(conn(),"SELECT count(*) AS qtd FROM $bdnome2.gosto WHERE id=$id AND tipo='$tipo'");
    $resultado =  mysqli_fetch_assoc($query);
    return $resultado['qtd'];
}
function qtd_de_cmt($id, $tipo = "pbl") {
    $query = mysqli_query(conn(),"SELECT count(*) AS qtd FROM cmt WHERE id=$id AND tipo = '$tipo'");
    $resultado =  mysqli_fetch_assoc($query);
    return $resultado['qtd'];
}
function qtd_pbl_user($id_user) {
    $query = mysqli_query(conn(),"SELECT count(*) AS qtd FROM pbl WHERE id_user=$id_user");
    $resultado =  mysqli_fetch_assoc($query);
    return $resultado['qtd'];
}
function qtd_cmt_respostas($id_cmt) {
    $query = mysqli_query(conn(),"SELECT count(*) AS qtd FROM cmt WHERE id_cmt_res=$id_cmt");
    $resultado =  mysqli_fetch_assoc($query);
    return $resultado['qtd'];
}
function media_de_interacao($id_user) {
    if (qtd_pbl_user($id_user) <= 0) {
        return 0;
    }
    $qtd_reacao = 0;
    $qtd_cmt = 0;
    $query = mysqli_query(conn(), "SELECT id_pbl FROM pbl WHERE id_user = $id_user");
    while ($resultado = mysqli_fetch_assoc($query)) {
        $qtd_reacao += qtd_de_reacao($resultado['id_pbl']);
        $qtd_cmt += qtd_de_cmt($resultado['id_pbl']);
    }
    $media = ($qtd_reacao * 0.25) / qtd_pbl_user($id_user);
    $media += ($qtd_cmt * 0.5) / qtd_pbl_user($id_user);
    return round($media,2);
}
function carregar_img($doc,$tipo,$id) {
    $_FILES['img'] = $doc;
    $c = new process;
    $maxFileSize = 5 * 1024 * 1024; // Tamanho máximo permitido em bytes (exemplo: 5MB)
    $fileSize = $_FILES['img']['size'];

    if ($_FILES['img']['name'] != null) {
        $ext = strtolower(substr($_FILES['img']['name'], -4));
        if ($ext[0] != ".") {
            $ext = "." . $ext;
        }
        
        $nome_img = "IMG-" . $_SESSION['id_user'] . "-perfil-" . date("Y.m.d-H.i.s") . $ext;
        $dir = '../src/userFile/'.(new informacoes_usuario())->user['code_nome'].'/img/';
        if (move_uploaded_file($_FILES['img']['tmp_name'], $dir . $nome_img)) {
            if ($c->carregar_documento($id, $tipo, $nome_img)) {
                return true;
            }
        }
        
    } else {
        echo "O arquivo não é uma imagem válida ou o tamanho excede o limite permitido.";
    }
}
function carregar_img_storie($imgs) {
    global $bdhost,$bdnome,$bdpass,$bduser;
    $c = new process;
    if (!is_array($imgs)) {
        $doc = $imgs;
        $imgs = array(); 
        array_push($imgs,$doc);
        unset($doc);
    }
    foreach ($imgs as $img) {
        $_FILES['img'] = $img;
        $maxFileSize = 5 * 1024 * 1024; // Tamanho máximo permitido em bytes (exemplo: 5MB)
        $fileSize = $_FILES['img']['size'];

        if ($_FILES['img']['name'] != null) {
            $ext = strtolower(substr($_FILES['img']['name'], -4));
            if ($ext[0] != ".") {
                $ext = "." . $ext;
            }
            
            $nome_img = "IMG-" . $_SESSION['id_user'] . "-".rand(0,9000)."-" . date("Y.m.d-H.i.s") . $ext;
            $dir = 'src/userFile/'.(new informacoes_usuario())->user['code_nome'].'/img/';
            if (move_uploaded_file($_FILES['img']['tmp_name'], $dir . $nome_img)) {
                if (!$c->postar_stories($nome_img)) {
                    return false;
                }
            }
            
        } else {
            echo "O arquivo não é uma imagem válida ou o tamanho excede o limite permitido.";
        }
    }
    return true;
}
function pegar_foto_perfil($tipo,$id)
{
    if ($tipo == "perfil") {
        $img = mysqli_query(conn(), "SELECT * FROM doc WHERE id_user=$id AND tipo='$tipo' ORDER BY id_doc DESC");
        $img = mysqli_fetch_assoc($img);
        if (isset($img['indereco'])) {
            return "/src/userFile/".(new informacoes_usuario())->user['code_nome']."/img/".$img['indereco'];
        }else if (empty($imagen)) {   
            return "/src/img/sem_img_no_perfil.jpeg";
        }
    }elseif($tipo == "cmdd") {
        $img = mysqli_query(conn(), "SELECT * FROM doc WHERE id=$id AND tipo='$tipo' ORDER BY id_doc DESC");
        $img = mysqli_fetch_assoc($img);
        if (isset($img['indereco'])) {
            return "/src/userFile/".(new informacoes_usuario)->usuario((new comunidade())->comunidade($id)['id_user'])['code_nome']."/img/".$img['indereco'];
        }else {   
            return "/src/img/sem_img_no_perfil.jpeg";
        }
    }
    
}
function verificar_img($tmpFileName) {
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
    $maxFileSize = 5 * 1024 * 1024; // Tamanho máximo permitido em bytes (exemplo: 5MB)
    
    $fileExtension = strtolower(pathinfo($tmpFileName, PATHINFO_EXTENSION));
    if (!in_array($fileExtension, $allowedExtensions)) {
        return false;
    }
    
    // Verificar o tipo MIME do arquivo
    $fileType = exif_imagetype($tmpFileName);
    if ($fileType === false) {
        return false; // Tipo MIME inválido
    }
    
    // Verificar o tamanho do arquivo
    $fileSize = filesize($tmpFileName);
    if ($fileSize > $maxFileSize) {
        return false; // Tamanho excede o limite permitido
    }
    
    return true; // Upload permitido
}
function pegar_tema() {
    global $bdnome2;
    if($_SESSION['id_user'] == NULL){
        return "preto";
    }
    return "branco";
}
function resumir_data($data_p): bool|string
{
    $data_atual = strtotime(date("Y-m-d H:i:s")); 
    $data = $data_atual - strtotime($data_p) + 3600; // Remove 1 hora, pode ser removido se não necessário.
    
    $segundo = $data;
    $minuto = $segundo / 60;
    $hora = $minuto / 60;
    $dias = $hora / 24;
    $meses = $dias / 30;
    
    // Se foi criado agora (menos que 5 segundos)
    if ($segundo < 5) {
        return "agora";
    }

    // Se foi criado entre 5 segundos e 1 minuto
    if ($segundo < 60) {
        return "há ".(int)$segundo." segundos";
    }

    // Se foi criado entre 1 e 60 minutos
    if ($minuto < 60) {
        return "há ".(int)$minuto." min";
    }

    // Se foi criado entre 1 e 24 horas
    if ($hora < 24) {
        return "há ".(int)$hora."h";
    }

    // Se foi criado entre 1 e 7 dias
    if ($dias >= 1 && $dias < 7) {
        return "há ".(int)$dias." dia".($dias > 1 ? "s" : "");
    }

    // Se foi criado entre 7 dias e 6 meses
    if ($dias >= 7 && $meses < 6) {
        return "em ".date("d/m", strtotime($data_p));
    }

    // Se foi criado há mais de 6 meses
    if ($meses >= 6) {
        return "em ".date("d/m/Y", strtotime($data_p));
    }

    return false; // Caso nenhum dos casos anteriores se encaixe
}

function pegar_imagem_em_cache($URL_imagem,$codigo_de_cache) {
    $pasta_de_cache = 'image_cache/';
    $cacheFilePath = $pasta_de_cache.$codigo_de_cache;
    if (file_exists($cacheFilePath) && (time() - filemtime($cacheFilePath)) < 86400) {
        # se a imagem tiver em cache e for valida (cache valido por um dia), use a imagem em cache
        return $cacheFilePath;
    }
    //baixe  a imagen da url
    $dados_da_imagem = file_get_contents($URL_imagem);
    //salva a imagen no cache
    if (!is_dir($pasta_de_cache)) {
        mkdir($pasta_de_cache);
    }
    file_put_contents($cacheFilePath,$dados_da_imagem);
    return $cacheFilePath;
}
function verificar_grupos_de_usuario($id_user) {
    $pdo = new conexao;
    $erro = $pdo->erro;
    $pdo->pdo;
    $dados = [];
    if (!$erro) {
        $sql = $pdo->pdo->prepare("SELECT * FROM $pdo->bdnome2.comunidade_integrante WHERE id_user = :id");
        $sql->bindValue(":id", $id_user);
        $sql->execute();
        foreach ($sql->fetchAll() as $value) {
            array_push($dados,$value['id_comunidade']);
        }
        $sql = $pdo->pdo->prepare("SELECT * FROM comunidade WHERE id_user = :id");
        $sql->bindValue(":id", $id_user);
        $sql->execute();
        foreach ($sql->fetchAll() as $value) {
            array_push($dados,$value['id_comunidade']);
        }
    }else{
        return false;
    }
    return $dados;
}
function verificar_grupos_em_comum($id_user,$id) {
    $user1 = verificar_grupos_de_usuario($id_user);
    $user2 = verificar_grupos_de_usuario($id);
    
    return count(array_intersect($user1,$user2));
}
function verificar_contactos_em_comum($id1,$id2) {
    global $bdnome2;
    $lista1 = $lista2 = array();

    $users = new informacoes_usuario;

    if ($users->lista_amigos($id1) <= 0 || $users->lista_amigos($id2) <= 0) {
        return 0;
    }else{
        return count(array_intersect($users->lista_amigos($id1,true),$users->lista_amigos($id2,true)));
    }
}
function pegar_qtd_de_membros_de_grupo($id_comunidade) {
    global $bdnome2;
    $sql = mysqli_query(conn(), "SELECT COUNT(*) AS qtd FROM $bdnome2.comunidade_integrante
    WHERE id_comunidade = $id_comunidade");
    $sql = mysqli_fetch_assoc($sql);
    return $sql['qtd'] + 1;
}
function analizar_ligacao_entre_usuario($id_user) {
    $user = new informacoes_usuario;
    $user1 = $user->user;
    $user2 = $user->usuario($id_user);

    $pontuacao = 0;
    $pontuacao = $pontuacao + 5 * verificar_contactos_em_comum($user1['id_user'],$user2['id_user']);
    $pontuacao = $pontuacao + 10 * verificar_grupos_em_comum($user1['id_user'],$user2['id_user']);
    if ($user1['id_pais'] == $user2['id_pais']) {
        $pontuacao = $pontuacao + 15;
    }

    return $pontuacao;

}
?>