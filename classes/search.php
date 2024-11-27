<?php
class search extends informacoes_usuario
{
    private $filtro;
    private $valor;
    private $link;
    function __construct($valor,$filtro){
        parent::__construct();
        $this->filtro = $filtro;
        $this->valor = $valor;
        $this->link = conn();
    }
    private function mostrar($row) {
        if ($this->filtro == "tudo") {
            if (isset($row['tipo'])) {
                if ($row['tipo'] == "usuario") {
                    $id = $row['id'];
                    $id_user = $_SESSION['id_user'];
                    $verificar_pedido_aceite = mysqli_query($this->link, "SELECT count(*) AS total FROM contacto WHERE ((id_user = $id
                    AND id_user_dest = $id_user) OR (id_user_dest = $id AND id_user = $id_user)) AND id_contacto IN (SELECT id_contacto FROM $this->bdnome2.contacto_aceite) ");
                    $verificar_pedido_aceite = mysqli_fetch_assoc($verificar_pedido_aceite);

                    $verificar_pedido_nao_aceite = mysqli_query($this->link, "SELECT count(*) AS total FROM contacto WHERE (id_user = $id
                    AND id_user_dest = $id_user) AND id_contacto NOT IN (SELECT id_contacto FROM $this->bdnome2.contacto_aceite) ");
                    $verificar_pedido_nao_aceite = mysqli_fetch_assoc($verificar_pedido_nao_aceite);

                    $verificar_pedido_feito = mysqli_query($this->link, "SELECT count(*) AS total FROM contacto WHERE (id_user = $id_user
                    AND id_user_dest = $id) AND id_contacto NOT IN (SELECT id_contacto FROM $this->bdnome2.contacto_aceite) ");
                    $verificar_pedido_feito = mysqli_fetch_assoc($verificar_pedido_feito);
                    
                    if ($verificar_pedido_aceite['total'] > 0) {
                        $imagen = pegar_foto_perfil("perfil",$id);
                        $nome = $row['texto'];
                        ?>
                            <div class="sms">
                                <div id="img_user" class="c1 cp1" style=" background-image: url(media/img/<?=$imagen?>);"></div>
                                <div class="c1 cp2">
                                    <div class="c2 nome"><a href="perfil/?user=<?=criptografar($id)?>"><?=$row['texto']?></a></div>
                                    <div class="c2 cont">
                                        <div>...</div>
                                    </div>
                                    <a href="./perfil/index.php?user=<?=criptografar($id)?>">
                                        <div class="c2 cont btn-pri">
                                            <div>ver perfil</div>
                                        </div>
                                    </a>
                                </div>  
                            </div>
                        <?php
                    }elseif($verificar_pedido_nao_aceite['total'] > 0) {
                        $imagen = pegar_foto_perfil("perfil",$id);
                        $nome = $row['texto'];
                        ?>
                            <div class="sms">
                                <div id="img_user" class="c1 cp1" style=" background-image: url(media/img/<?=$imagen?>);"></div>
                                <div class="c1 cp2">
                                    <div class="c2 nome"><a href="perfil/?user=<?=criptografar($id)?>"><?=$row['texto']?></a></div>
                                    <div class="c2 cont">
                                        <div>...</div>
                                    </div>
                                    <a href="./index.php?user=<?=criptografar($id)?>&nome=<?=criptografar($nome)?>">
                                        <div class="c2 cont btn-pri">
                                            <div>aceitar pedido</div>
                                        </div>
                                    </a>
                                </div>  
                            </div>
                        <?php
                    }elseif($verificar_pedido_feito['total'] > 0) {
                        $imagen = pegar_foto_perfil("perfil",$id);
                        $nome = $row['texto'];
                        ?>
                            <div class="sms">
                                <div id="img_user" class="c1 cp1" style=" background-image: url(media/img/<?=$imagen?>);"></div>
                                <div class="c1 cp2">
                                    <div class="c2 nome"><a href="perfil/?user=<?=criptografar($id)?>"><?=$row['texto']?></a></div>
                                    <div class="c2 cont">
                                        <div>...</div>
                                    </div>
                                    <a href="./index.php?user=<?=criptografar($id)?>&nome=<?=criptografar($nome)?>">
                                        <div class="c2 cont btn-pri">
                                            <div>cancelar pedido</div>
                                        </div>
                                    </a>
                                </div>  
                            </div>
                        <?php
                    }else{
                        $imagen = pegar_foto_perfil("perfil",$id);
                        $nome = $row['texto'];
                        ?>
                            <div class="sms">
                                <div id="img_user" class="c1 cp1" style=" background-image: url(media/img/<?=$imagen?>);"></div>
                                <div class="c1 cp2">
                                    <div class="c2 nome"><a href="perfil/?user=<?=criptografar($id)?>"><?=$row['texto']?></a></div>
                                    <div class="c2 cont">
                                        <div>...</div>
                                    </div>
                                    <a href="./index.php?user=<?=criptografar($id)?>&nome=<?=criptografar($nome)?>">
                                        <div class="c2 cont btn-pri">
                                            <div>fazer pedido</div>
                                        </div>
                                    </a>
                                </div>  
                            </div>
                        <?php
                    }
                    
                } elseif($row['tipo'] == "cmndd"){
                    $cmd = new comunidade;
                    $cmd->indereco = "./";
                    $id_user = $_SESSION['id_user'];
                    $id_comunidade = $row['id'];
                    $row = $cmd->comunidade($id_comunidade);
                    $sqll = mysqli_query(conn(), "SELECT count(*) as valor FROM $this->bdnome2.comunidade_integrante WHERE id_comunidade = $id_comunidade AND id_user=$id_user");
                    $sqll = mysqli_fetch_assoc($sqll);
                    if ($sqll['valor'] <= 0 && $id_user != $row['id_user']) {
                        $cmd->mostrar_comunidades($row,'sugeridas');
                    }else{
                        $cmd->mostrar_comunidades($row,'minhas');
                    }
                    ?>

                    <?php
                } elseif($row["tipo"] == "pbl"){
                    $m = new postes();
                    $m->mostrar($m->poste($row['id']));
                }
            }
        }
    }
    public function procurar() {
        $id_user = 2;
        if ($this->filtro == "tudo") {
            $sql = $this->pdo->prepare("SELECT u.nome AS texto, u.id_user AS id, 'usuario' AS tipo FROM usuarios AS u WHERE id_user='$this->valor' OR LOWER(nome) LIKE '%$this->valor%' AND id_user != $id_user 
            UNION ALL
            SELECT c.nome AS texto, c.id_comunidade AS id, 'cmndd' AS tipo FROM comunidade AS c WHERE LOWER(nome) LIKE '%$this->valor%'
            UNION ALL 
            SELECT p.texto, p.id_pbl AS id, 'pbl' AS tipo FROM pbl AS p WHERE LOWER(texto) LIKE '%$this->valor%'
            
            LIMIT 12");
            //$sql->bindValue(":s", strtolower($this->valor));
            //$sql->bindValue(":i", $_SESSION['id_user']);
        }
        $sql->execute();
        $c_e = false;
        foreach ($sql->fetchAll() AS $dado) {
            if ($dado['tipo'] == 'cmndd') {
                if (!$c_e) {
                    $c_e = true;
                    ?>
                    <div class="comunidades">
                        <h2>comunidades</h2>
                    <?php
                }
            }
            if ($c_e && $dado['tipo'] != 'cmndd') {
                ?>
                </div>
                <?php
                $c_e = false;
            }
            $this->mostrar($dado);
        }
        
    }

}
?>