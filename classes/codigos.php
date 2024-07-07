<?php
function ordenar_pontos($a,$b){
    //return $b['pontos'] - $a['pontos'];//ordem descrescente pelo caso do b estar primeiro
    $ponto_a = floatval($a['pontos']);
    $ponto_b = floatval($b['pontos']);
    if ($ponto_a == $ponto_b) {
        return 0;
    }
    return ($ponto_a > $ponto_b) ? -1:1;
}
class codigos extends process
{
    private $id_user;
    public $indereco;
    public $indereco_code;
    private $dados;
    public function __construct(){
        parent::__construct();
        $this->id_user = $_SESSION['id_user']; 
    }
    public function codigo($id_codigo){
        $code = $this->pdo->prepare("SELECT c.*,id_versao,descricao,data FROM codigos AS c
        INNER JOIN $this->bdnome2.versoes_codigos AS v ON (v.id_code = :code) 
        WHERE c.id_code = :code ORDER BY v.id_versao DESC LIMIT 1");
        $code->bindValue(":code", $id_codigo);
        $code->execute();
        return $code->fetch();
    }
    public function mostrar($dados, $numero_linhas = 4, $modo = "feed",$dados_sugestao=NULL,$partilhada = NULL){
        $modo_comparacao = false;
        if (!isset($dados['id_versao'])) {
            echo "O poste ja foi eliminado ou ocorreu algum problema ao abrir";
            return false;
        }
        $documentos = $this->pdo->prepare("SELECT * FROM doc WHERE id=:id AND tipo = :t");
        if ($dados_sugestao == NULL || isset($dados_sugestao['n_mostrar'])) {
            if (isset($dados_sugestao['n_mostrar'])) {
                $user_sugestao = $this->usuario($dados_sugestao['id_user']);
                if ($dados_sugestao['n_mostrar'] == "comparacao") {
                    $modo_comparacao = true;
                    $documentos = $this->pdo->prepare("SELECT * FROM doc WHERE (id=:id1 AND tipo = :t1) OR (id=:id2 AND tipo = :t2) ORDER BY id_doc");
                    $documentos->bindValue(":id1", $dados['id_versao']);
                    $documentos->bindValue(":t1", "code_versao");
                    $documentos->bindValue(":id2", $dados_sugestao['id_code_sugestao']);
                    $documentos->bindValue(":t2", "code_sugestao");
                }else {
                    $documentos->bindValue(":id", $dados['id_versao']);
                    $documentos->bindValue(":t", "code_versao");
                }
            }
        }else{
            $user_sugestao = $this->usuario($dados_sugestao['id_user']);
            $documentos->bindValue(":id", $dados_sugestao['id_code_sugestao']);
            $documentos->bindValue(":t", "code_sugestao");
        }
        if(isset($_GET['ver_sug']) || isset($_GET['inicio'])){
            $documentos->bindValue(":id", 0);
            $documentos->bindValue(":t", 'NULL');
            $documentos->execute();
        }else {
            try {
                $documentos->execute();
            } catch (\Throwable $th) {
                $documentos = $this->pdo->prepare("SELECT * FROM doc WHERE id=:id AND tipo = :t");
                $documentos->bindValue(":id", $dados['id_versao']);
                $documentos->bindValue(":t", "code_versao");
                $documentos->execute();
            }
            if ($documentos->rowCount() < 1) {
                
                return false;
            }
            ?>
                <script>
                    alert(<?='$texto'?>);
                </script>
                <?php
        }
        if (!$this->indereco) {
            $this->indereco = "./";
        }
        if (!isset($this->indereco_code)) {
            $this->indereco_code = $this->indereco;
        }
        if ($modo_comparacao) {
            $documentos = $documentos->fetchALL();
            $indereco_de_arquivo = [];
            $textos= [];
            $i = 0;
            foreach ($documentos as $value) {
                array_push($indereco_de_arquivo,$this->indereco_code."media/codes/".$value['indereco']);
                if (is_file($indereco_de_arquivo[$i])) {        
                    $texto = file_get_contents($indereco_de_arquivo[$i]);
                    array_push($textos,str_replace("textarea","textarea_",$texto));
                }else {
                    return false;
                }
                $i++;
            }
        }elseif(!$modo_comparacao && (!isset($_GET['ver_sug']) && !isset($_GET['inicio']))) {
            $documentos = $documentos->fetch();
            $indereco_de_arquivo = $this->indereco_code."media/codes/".$documentos['indereco'];
            if (is_file($indereco_de_arquivo)) {    
                if (!is_int($numero_linhas) && $numero_linhas) {
                    $texto = file_get_contents($indereco_de_arquivo);
                }else {
                    $arquivo_linhas = file($indereco_de_arquivo);
                    $previsualizar_arquivo = array_slice($arquivo_linhas,0,$numero_linhas);
                    $texto = "";
                    foreach ($previsualizar_arquivo as $linha) {
                        $texto .= $linha;
                    }
                }
                $texto = str_replace("textarea","textarea_",$texto);
            }else {
                return false;
            }
        }
        
        $user = $this->usuario($dados['id_user']);
       
        ?>
        <div id="<?php if ($modo=="codar" || $modo=="simples") {echo"coder_grande";}else{echo"poste_codigo";}?>" class="">
            <div class="container">
                <div class="dados_usuario row">
                    <div class="img d-inline-block" style="background-image :url(<?=$this->indereco."media/img/".pegar_foto_perfil("perfil",$dados['id_user'])?>);"></div>
                    <div class="nome d-inline-block">
                        <div class="container">
                            <div class="d-inline-block">
                                <a href="<?=$this->indereco?>perfil/?user=<?=criptografar($user['id_user'])?>"><div class=""><?=$user['nome']?></div></a>
                                <div class="data"><?=resumir_data($dados['data'])?><span class="linguagen <?=$dados['linguagem']?>"><span class="<?=$dados['linguagem']?>"><?=$dados['linguagem']?></span></span></div>
                            </div>
                            <?php
                            if ($dados_sugestao != NULL) {
                                ?>
                                <div class="d-inline-block centralizador">
                                    =>
                                </div>
                                <div class="d-inline-block">
                                    <div class="container">
                                        <div class="img d-inline-block" style="background-image :url(<?=$this->indereco."media/img/".pegar_foto_perfil("perfil",$dados_sugestao['id_user'])?>);"></div>
                                        <div class="d-inline-block">
                                            <a href="<?=$this->indereco?>perfil/?user=<?=criptografar($user_sugestao['id_user'])?>"><div class=""><?=$user_sugestao['nome']?></div></a>
                                            <div class="data"><?=resumir_data($dados_sugestao['data'])?><span class="linguagen <?=$dados['linguagem']?>"><span class="<?=$dados['linguagem']?>"><?=$dados['linguagem']?></span></span></div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="d-inline-block"></div>
                        </div>
                    </div>
                    <div class="mais d-inline-block">
                        <div class="container">
                            <div class="d-block info">...</div>
                            <?php
                            if (($modo == 'simpless' || $modo == 'codarr')) {
                                ?>
                                <div class="d-block bg-code">
                                    <div class="container">
                                        <div class="d-inline-block dark">D</div>
                                        <div class="d-inline-block white">W</div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="dados_codigo">
                    <a href="<?=$this->indereco?>coder/ver.php?coder=<?=criptografar($dados['id_code'])?>&inicio=1">
                        <h1 class="titulo"><?=$dados['titulo']?></h1>
                    </a>
                    <?php
                    if ($modo == "feed"){
                        ?><p class="descricao"><?=$dados['descricao']?></p><?php
                    }
                    ?>
                </div>
            </div>
            <div class="codigo">
            <?php if($modo == "feed"){?><a href="<?=$this->indereco?>coder/ver.php?coder=<?=criptografar($dados['id_code'])?>&modificar=0&comentar=0"><?php }?>
                <?php
                if (!isset($_GET['ver_sug']) && !isset($_GET['inicio'])) {
                    if ($modo_comparacao) {
                        $i = 0; 
                        foreach ($textos as $value) {
                            ?>
                            <div class="comparacao">
                                <textarea name="code" class="<?=($i > 0)?"destaque":"";?> comparacao <?php if($modo=="feed" || $modo == "simples"){echo"ver_code v_code_".$dados['id_code'];}?>" id="<?php if($modo == "codar"){echo"code";}?>"><?=$textos[$i]?></textarea>
                            </div>
                            <?php
                            $i++;
                        }
                    }else{
                        ?><textarea name="code" class="destaque <?php if($modo=="feed" || $modo == "simples"){echo"ver_code v_code_".$dados['id_code'];}?>" id="<?php if($modo == "codar"){echo"code";}?>"><?=$texto?></textarea><?php
                    }
                }elseif(isset($_GET['ver_sug'])){
                    ?><div class="sugestoes"><?php
                        foreach ($this->sugestoes($dados['id_code'],"registros") as $value) {
                            $this->mostrar_sugestao($value);
                        }
                        if (count($this->sugestoes($dados['id_code'],"registros"))<=0) {
                            ?>
                            <div class="alert">
                                <h2>Sem nenhuma sugestao</h2>
                            </div>
                            <?php
                        }
                    ?></div><?php
                }elseif(isset($_GET['inicio'])){
                    ?><p><?=$dados['descricao']?></p><?php
                }
                ?>
                
            <?php if($modo == "feed"){?></a><?php }?>
            </div>
            <?php if ($modo == "feed" && $partilhada == NULL) {?>
                <div class="container">
                    <div class="dados_reacao row">
                        <div class="centralizar col reac<?='code'.$dados['id_code']?>"  onclick="reagir(<?=$dados['id_code']?>,'code')">
                            <?php
                            $reac = $this->pdo->prepare("SELECT count(*) AS valor FROM $this->bdnome2.gosto WHERE id_user = :user AND id=:id AND tipo = 'code'");
                            $reac->bindValue(":user", $_SESSION['id_user']);
                            $reac->bindValue(":id", $dados['id_code']);
                            $reac->execute();
                            $reac = $reac->fetch();
                            if ($reac['valor'] > 0) {
                                ?>
                                <img class="teste add" src="<?=$this->indereco?>bibliotecas/bootstrap/icones/star-fill.svg" alt=""><span><?=qtd_de_reacao($dados['id_code'],"code")?></span>
                                <?php
                            }else {
                                ?>
                                <img class="" src="<?=$this->indereco?>bibliotecas/bootstrap/icones/star.svg" alt=""> <span><?=qtd_de_reacao($dados['id_code'],"code")?></span>
                                <?php
                            }
                            ?>
                        </div>
                        <a class="col" href="<?=$this->indereco?>coder/ver.php?coder=<?=criptografar($dados['id_code'])?>&modificar=0&comentar=1">
                            <div class=""><img class="" src="<?=$this->indereco?>bibliotecas/bootstrap/icones/chat-dots.svg" alt=""><span><?=qtd_de_cmt($dados['id_code'],"code")?></span></div>
                        </a>
                        <a class="col contribuir" href="<?=$this->indereco?>coder/ver.php?coder=<?=criptografar($dados['id_code'])?>&modificar=1&comentar=0">
                            <div class="">
                                <img class="" src="<?=$this->indereco?>bibliotecas/bootstrap/icones/diagram-2.svg" alt=""><span><?=$this->sugestoes($dados['id_code'])?></span>
                            </div>
                        </a>
                        
                        <div class="col" onclick="abrir_partilhar('code',<?=$dados['id_code']?>)"><img class="" src="<?=$this->indereco?>bibliotecas/bootstrap/icones/reply.svg" alt=""></div>
                    </div>
                </div>
            <?php }
            if (($modo == "codar" || $modo == "simples") && !isset($_GET['ver_sug']) && $dados_sugestao == NULL) {
                ?><div class="dados_reacao"><?php
                ?><div class="container"><?php
                    if(isset($_GET['inicio'])){
                        ?>
                            <div class="d-inline-block">
                                <a href="<?=$this->indereco?>coder/ver.php?coder=<?=criptografar($dados['id_code'])?>">
                                <input type="submit" value="ver codigo" class="form-control">
                                </a>
                            </div>
                        <?php
                    }
                    if ($modo == "codar") {
                        ?>
                            <div class="d-inline-block">
                                <input type="submit" value="dar Sugestao" class="form-control" onclick="aba_alert('#dar_sugestao_code')">
                            </div>
                        <?php
                    } if ($modo == "simples") {
                        ?>
                        <div class="d-inline-block">
                            <a href="<?=$this->indereco?>coder/ver.php?coder=<?=criptografar($dados['id_code'])?>&modificar=1">
                                <input type="submit" value="editar codigo" class="form-control">
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="d-inline-block">
                        <a href="ver.php?ver_sug=1&coder=<?=criptografar($dados['id_code'])?>">
                            <input type="submit" value="Ver Sugestoes" class="form-control">
                        </a>
                    </div>
                    <?php
                        if ($modo == "codar" && $dados['id_user'] == $_SESSION['id_user']) {
                            ?>
                            <div class="d-inline-block">
                                <input onclick="aba_alert('#actualizar_sugestao_code')" type="submit" value="Nova versao">
                            </div>
                            <?php
                        }
                        ?>
                </div>
                </div>
                <?php
            }elseif(isset($_GET['ver_sug'])) {
                ?>
                <div class="dados_reacao">
                    <div class="container">
                        <div class="d-inline-block">
                            <a href="<?=$this->indereco?>coder/ver.php?coder=<?=criptografar($dados['id_code'])?>">
                                <input type="submit" value="ver codigo">
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }elseif($dados_sugestao != NULL){
                ?>
                <div class="dados_reacao">
                    <div class="container">
                        <div class="d-inline-block">
                            <a href="<?=$this->indereco?>coder/ver.php?ver_sug=<?=criptografar($dados['id_code'])?>&coder=<?=criptografar($dados['id_code'])?>">
                                <input type="submit" value="Voltar">
                            </a>
                        </div>
                        <?php
                        if ($dados['id_user'] == $_SESSION['id_user']) {
                            ?>
                            <div class="d-inline-block">
                                <input onclick="aba_alert('#actualizar_sugestao_code')" type="submit" value="Nova versao">
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="selecionar_code">
                        <div class="d-inline-block">
                            <a href="<?=$this->indereco?>coder/ver.php?sug=<?=criptografar($dados_sugestao['id_code_sugestao'])?>&sug_n_ver">
                                <input type="submit" class="<?php if(!$modo_comparacao && ($dados_sugestao == NULL || isset($dados_sugestao['n_mostrar']))){echo "selecionado";}?>" value="principal">
                            </a>
                        </div>
                        <div class="d-inline-block">
                            <a href="<?=$this->indereco?>coder/ver.php?sug=<?=criptografar($dados_sugestao['id_code_sugestao'])?>&comparacao">
                                <input type="submit" class="<?php if($modo_comparacao){echo "selecionado";}?>" value="VS">
                            </a>
                        </div>
                        <div class="d-inline-block">
                            <a href="<?=$this->indereco?>coder/ver.php?sug=<?=criptografar($dados_sugestao['id_code_sugestao'])?>">
                                <input type="submit" class="<?php if($dados_sugestao != NULL && !isset($dados_sugestao['n_mostrar'])){echo "selecionado";}?>" value="sugestao">
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php     
        $this->marcar_visto($dados['id_code'],"codigo");
        if ($modo != "feed") {
            $this->marcar_lido($dados['id_code'],"codigo"); 
        }
        if (isset($dados_sugestao['id_code_sugestao'])) {
            $this->marcar_lido($dados_sugestao['id_code_sugestao'],"code_sugestao");
        }
        array_push($_SESSION['code_visualizado'],$dados['id_code']); 
    }
    public function mostrar_lista($dados){
        if (!$this->indereco) {
            $this->indereco = "./";
        }
        ?>
        <a href="<?=$this->indereco?>coder/ver.php?coder=<?=criptografar($dados['id_code'])?>&inicio=1">
            <table class="lista_codigos">
                <tr>
                    <td class="img">
                        <div class="img" style="background-image :url(<?=$this->indereco."media/img/".pegar_foto_perfil("perfil",$dados['id_user'])?>);"></div>
                    </td>
                    <td class="dados_codigo">
                        <div class="titulo"><?=$dados['titulo']?></div>
                        <div class="info">
                            <span class="linguagen <?=$dados['linguagem']?>"><span><?=$dados['linguagem']?></span></span>
                            <span class="vistos"><img src="<?=$this->indereco?>bibliotecas/bootstrap/icones/diagram-2.svg" alt=""><?=$this->sugestoes($dados['id_code'])?></span>
                            <span class="vistos"><img src="<?=$this->indereco?>bibliotecas/bootstrap/icones/eye.svg" alt=""><?=$this->qtd_leitores($dados['id_code'],"codigo")?></span>
                        </div>
                    </td>
                    <td class="fire">
                        <div class="pts"><?=($dados['id_code'] < 10)?round($dados['pontos'],3):round($dados['pontos'],2);?></div>
                        <div class="icon">
                            <img src="<?=$this->indereco?>/bibliotecas/bootstrap/icones/fire.svg" alt="">
                        </div>
                    </td>
                </tr>
            </table>
        </a>
        <?php
    }
    public function verificar_pontos($row){
        $pontos = analizar_ligacao_entre_usuario($row['id_user']);
        $pontos = $pontos + $this->verificar_pontos_fire($row);
        return round($pontos,4);
    }
    public function verificar_pontos_fire($row) {
        $estresse_de_pontos = 10;
        $pontos = 0;
        if ($this->sugestoes($row['id_code']) > 0) {
            $this->sugestoes($row['id_code'])/$estresse_de_pontos;
        }
        if ($this->qtd_vistos($row['id_code'],"codigo")) {
            $pontos += ($this->qtd_leitores($row['id_code'],"codigo") + $this->qtd_vistos($row['id_code'],"codigo"))/$this->qtd_vistos($row['id_code'],"codigo");
        }
        $pontos += (0.01/$estresse_de_pontos)*$this->qtd_reacao($row['id_code'],'code');
        if ($pontos > 0) {
            $pontos = $pontos / ($estresse_de_pontos*4);
        }
        return round($pontos,4);
    }
    public function lista_em_orden_pontos(){
        $sql = $this->pdo->prepare("SELECT c.*,id_versao,descricao,data FROM codigos AS c
        INNER JOIN $this->bdnome2.versoes_codigos AS v ON (v.id_code = c.id_code) 
        WHERE c.id_code = c.id_code AND c.id_user >0*:id ORDER BY v.id_versao DESC");
        $sql->bindValue(":id", $this->id_user);
        $sql->execute();
        $dados = $sql->fetchAll();
        $lista = array();
        foreach ($dados as $valor) {
            $pontos = $this->verificar_pontos($valor);
            $valor['pontos'] = $pontos;
            array_push($lista, $valor);
        }
        usort($lista,'ordenar_pontos');
        return $lista;
    }
    public function lista_em_orden_pontos_fire(){
        $sql = $this->pdo->prepare("SELECT * FROM codigos WHERE id_user > 0*:id ORDER BY id_code DESC");
        $sql->bindValue(":id", $this->id_user);
        $sql->execute();
        $dados = $sql->fetchAll();
        $lista = array();
        foreach ($dados as $valor) {
            $pontos = $this->verificar_pontos_fire($valor);
            $valor['pontos'] = $pontos;
            array_push($lista, $valor);
        }
        usort($lista,'ordenar_pontos');
        return $lista;
    }
    function pegar_codigo_para_poste() {
        $this->dados = $this->lista_em_orden_pontos();
        foreach ($this->dados as $value) {
            $ligacao = true;
            foreach ($_SESSION['code_visualizado'] as $val) {
                if ($value['id_code'] == $val) {
                    $ligacao = false;
                    break;
                }
            }
            if ($ligacao) {
                return $this->mostrar($value);
            }
        }
        return 404;
    }
    public function pegar_codigo_para_lista($qtd) {
        $this->dados = $this->lista_em_orden_pontos_fire();
        for ($i=0; $i <= $qtd; $i++) { 
            foreach ($this->dados as $value) {
                $ligacao = true;
                foreach ($_SESSION['code_lista_visualizado'] as $val) {
                    if ($value['id_code'] == $val) {
                        $ligacao = false;
                        break;
                    }
                }
                if ($ligacao) {
                    array_push($_SESSION['code_lista_visualizado'],$value['id_code']);
                    $this->mostrar_lista($value);
                }
            }
        }
        return true; 
    }
    public function  mostrar_sugestao($dados){
        $usuario = $this->usuario($dados['id_user']);
        ?>
        <div class="container">
            <div class="row sugestao">
                <div class="d-inline-block img_user">
                    <img src="<?=$this->indereco."media/img/".pegar_foto_perfil("perfil",$dados['id_user'])?>" alt="">
                </div>
                <div class="d-inline-block dados">
                    <a href="./ver.php?sug=<?=criptografar($dados['id_code_sugestao'])?>">
                        <div class="container">
                            <div class="d-inline-block nome"><?=$usuario['nome']?></div>
                            <div class="d-inline-block votacao"></div>
                        </div>
                        <div class="row descricao">
                            <p><?=$dados['descricao']?></p>
                        </div> 
                    </a>
                </div>
                <div class="d-inline-block a-favor">
                    <div class="container">
                        <div class="row"> 
                            <?php
                            if ($this->qtd_reacao($dados['id_code_sugestao'],'code_sugestao',$_SESSION['id_user'],0)>0) {
                                ?>
                                <div class="col selecionado" onclick="reagir(<?=$dados['id_code_sugestao']?>,'code_sugestao')">s <span><?=$this->qtd_reacao($dados['id_code_sugestao'],'code_sugestao')?></span></div>
                                <div class="col" onclick="reagir(<?=$dados['id_code_sugestao']?>,'code_sugestao')">n <span><?=$this->qtd_reacao($dados['id_code_sugestao'],'code_sugestao',NULL,0)?></span></div>
                                <?php
                            }elseif($this->qtd_reacao($dados['id_code_sugestao'],'code_sugestao',$_SESSION['id_user'],1)>0){
                                ?>
                                <div class="col" onclick="reagir(<?=$dados['id_code_sugestao']?>,'code_sugestao')">s <span><?=$this->qtd_reacao($dados['id_code_sugestao'],'code_sugestao')?></span></div>
                                <div class="col selecionado" onclick="reagir(<?=$dados['id_code_sugestao']?>,'code_sugestao')">n <span><?=$this->qtd_reacao($dados['id_code_sugestao'],'code_sugestao',NULL,0)?></span></div>
                                <?php
                            }else{
                                ?>
                                <div class="col" onclick="reagir(<?=$dados['id_code_sugestao']?>,'code_sugestao')">s <span><?=$this->qtd_reacao($dados['id_code_sugestao'],'code_sugestao')?></span></div>
                                <div class="col" onclick="reagir(<?=$dados['id_code_sugestao']?>,'code_sugestao')">n <span><?=$this->qtd_reacao($dados['id_code_sugestao'],'code_sugestao',NULL,0)?></span></div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="row">
                            <div class="col">v <span><?=$this->qtd_leitores($dados['id_code_sugestao'],'code_sugestao')?></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    public function sugestoes($id_code,$modo="qtd"){
        $sql = $this->pdo->prepare("SELECT * FROM $this->bdnome2.codigo_sugestao WHERE id_code=:id");
        $sql->bindValue(":id", $id_code);
        $sql->execute();
        if ($modo == "qtd") {
            return $sql->rowCount();
        }elseif($modo == "registros"){
            return $sql->fetchALL();
        }
    }
    public function sugestao($id_sugestao){
        $sql = $this->pdo->prepare("SELECT * FROM $this->bdnome2.codigo_sugestao WHERE id_code_sugestao=:id");
        $sql->bindValue(":id", $id_sugestao);
        $sql->execute();
        if ($sql->rowCount() < 1) {
            return false;
        }
        return $sql->fetch();
    }
}
?>