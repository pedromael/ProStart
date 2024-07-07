<?php
class comentarios extends informacoes_usuario
{
    public $id;
    public $id_cmt = false;
    public $indereco;

    public function mostrar($dados){
        $user = $this->usuario($dados['id_user']);
        $this->indereco = "../";
        ?>
        <div id="cmt" class="">
            <div id="img_cmt">
                <a href=""><img src="<?=$this->indereco?>media/img/<?=pegar_foto_perfil("perfil",$dados['id_user'])?>" alt=""></a>
            </div>
            <div class="conteudo">
                <table>
                    <tr>
                        <td id="nome" colspan="3"><a href="<?=$this->indereco?>perfil/?user=<?=criptografar($dados['id_user'])?>"><?=$user['nome']?></a></td>
                    </tr>
                    <tr id="txt_cmt">
                        <td colspan="5"><p class="text"><?=$dados['texto']?></p></td>
                    </tr>
                    <tr id="reac">
                        <td><a href="cmt.php?cmt=<?=criptografar($dados['id_cmt'])?>">responder <span><?=qtd_cmt_respostas($dados['id_cmt'])?></span></a></td>
                        <?php
                        if ($dados['id_user'] == $_SESSION['id_user']) {
                            ?>
                            <td><a href="editar.php?id_cmt=<?=criptografar($dados['id_cmt'])?>"></a></td>
                            <td><a href="eliminar">eliminar</a></td>
                            <?php
                        }else {
                            ?>
                            <td><div>guardar</div></td>
                            <?php
                        }
                        ?>
                        <td id="data"><?=resumir_data($dados['data'])?></td>
                    </tr>
                </table>
            </div>
        </div>
        <?php
    }
    public function comentar($id,$texto,$cmt_res,$tipo){
        $sql = $this->pdo->prepare("INSERT INTO cmt(id_user,id,tipo,texto,id_cmt_res,data)
        VALUES(:user,:id,:tipo,:t,:cmt,NOW())");
        $sql->bindValue(":user", $_SESSION['id_user']);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":tipo", $tipo);
        $sql->bindValue(":cmt", $cmt_res);
        $sql->bindValue(":t", nl2br($texto));
        if ($sql->execute()) {
            if ($tipo == "code") {$tipo = "cmt_code";}elseif($tipo = "pbl"){$tipo = "cmt";}
            $id_cmt = $this->pdo->lastInsertId();
            if (inserir_historico($tipo, $id, $id_cmt)) { 
                $sql = $this->pdo->prepare("SELECT * FROM cmt WHERE id=:id AND id_user=:user ORDER BY id_cmt DESC LIMIT 1");
                $sql->bindValue(":id", $id);
                $sql->bindValue(":user", $_SESSION['id_user']);
                $sql->execute();
                $dados = $sql->fetch();
                return $dados;
            }else {
               return  false;
            }
        } else {
            return false;
        }
    }
    public function pegar($tipo = "pbl",$numero_max = 1) {
        $dados =  array();

        if ($this->id_cmt) {
            $sql = $this->pdo->prepare("SELECT * FROM cmt WHERE tipo = :t AND id = :id AND id_cmt_res=:cmt ORDER BY id_cmt DESC");
            $sql->bindValue(":t", $tipo);
            $sql->bindValue(":id", $this->id);
            $sql->bindValue(":cmt", $this->id_cmt);
        }else {
            $sql = $this->pdo->prepare("SELECT * FROM cmt WHERE tipo = :t AND id = :id AND id_cmt_res = 0 ORDER BY id_cmt DESC");
            $sql->bindValue(":t", $tipo);
            $sql->bindValue(":id", $this->id);
        }
        $sql->execute();
        $dados = $sql->fetchALL();
        $a = 0;
        foreach ($dados as $dado) {
            if (!in_array($dado['id_cmt'],$_SESSION['cmt_visualizado'])) {
                if ($a == $numero_max) {return true;}
                array_push($_SESSION['cmt_visualizado'],$dado['id_cmt']);
                $this->mostrar($dado);
                $a++;
            }
        }
        return true;
    }
    public function comentario($id_cmt,$tipo = "pbl"){
        $sql = $this->pdo->prepare("SELECT * FROM cmt WHERE id_cmt=:id AND tipo=:t");
        $sql->bindValue(":id",$id_cmt);
        $sql->bindValue(":t", $tipo);
        $sql->execute();
        if ($sql->rowCount() <= 0) {
            return false;
        }
        return $sql->fetch();
    }
}

?>