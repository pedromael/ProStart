<?php
class mensagens extends process
{
    public $receptor;
    public function __construct(){
        parent::__construct();
    }    
    public function enviar($texto,$id_doc){
        $sql = $this->pdo->prepare("INSERT INTO chat(id_user,id_user_dest,id_doc,texto,data)
            VALUES (:1,:2,:3,:4,now())");
        $sql->bindValue(":1", $_SESSION['id_user']);
        $sql->bindValue(":2", $this->receptor);
        $sql->bindValue(":3", $id_doc);
        $sql->bindValue(":4", nl2br($texto));
        if ($sql->execute()) {
            $sql = $this->pdo->prepare("SELECT * FROM chat WHERE id_chat=:id");
            $sql->bindValue(":id", $this->pdo->lastInsertId());
            $sql->execute();
            return $sql->fetch();
        }else {
            return false;
        }
    }
    public function mostrar($dados,$anterior = false){
        if ($this->receptor == $dados['id_user']) {
            $classe = "esquerda";
        }else {$classe = "direita";}
        ?>
        <div class="<?=$classe?>">
            <div class="container">
                <div class="row">
                    <?php
                    if ($this->receptor == $dados['id_user']) {
                        ?>
                        <div class="d-inline-block img_msg">
                            <?php
                            if ($anterior) {
                                ?><img id="img_msg" src="<?=pegar_foto_perfil("perfil",$dados['id_user'])?>" alt=""><?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="d-inline-block text">
                        <p class="stilo "><span><?=$dados['texto']?></span></p>
                        <p id="data_chat" class="<?=$classe?>"><?=resumir_data($dados['data'])?></p>
                    </div>
                </div>
            </div>
        </div>
        <p class="divisao"></p>
        <?php
        $this->marcar_visto($dados['id_chat'],"chat");

    }
    public function selecionar(){
        $sql = $this->pdo->prepare("SELECT * FROM (SELECT * FROM chat WHERE (id_user = :r
        AND id_user_dest = :t) OR (id_user = :t AND id_user_dest = :r) ORDER BY id_chat DESC LIMIT 10)
        AS subquery ORDER BY id_chat ASC");
        $sql->bindValue(":t", $_SESSION['id_user']);
        $sql->bindValue(":r", $this->receptor);
        $sql->execute();
        $dados = $sql->fetchALL();
        $a = 1;
        foreach ($dados as $key) {
            $this->mostrar($key,$a);
            if ($this->receptor == $key['id_user']) {
                $a = false;
            }else {$a = true;}
        }
    }
}
?>