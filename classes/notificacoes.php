<?php
class notificacoes extends process
{
    private $id_user; 

    public function __construct(){
        parent::__construct();
        $this->id_user = $_SESSION['id_user'];
    }
    private function mostrar($sql,$stilo_de_bordas)
    {
        if ($stilo_de_bordas == 1) {
            $stilo_de_bordas = 'notific_1';
        }else {
            $stilo_de_bordas = 'notific_2';
        }

        $id_dest = $sql['id_dest'];
        $id = $sql['id'];
        $user = $this->usuario($id_dest);
        $imagen = pegar_foto_perfil('perfil',$id_dest);
        
        if ($sql['tipo'] == "cmt" || $sql['tipo'] == "cmt_code") {
            $id = $sql['id_historico'];
            $id = mysqli_query(conn(), "SELECT * FROM pro_start_outros.historico_id WHERE id_historico = $id");
            $id = mysqli_fetch_assoc($id);
            $id = $id['id'];
            
            if ($sql['tipo'] == "cmt") {
                $cmt = mysqli_query(conn(), "SELECT cmt.texto AS texto_cmt,pbl.id_pbl,tipo,pbl.texto AS texto_pbl FROM pbl 
                INNER JOIN cmt ON (cmt.id = pbl.id_pbl)
                WHERE cmt.id_cmt=$id");
                $cmt = mysqli_fetch_assoc($cmt);
                ?>
                <div class="notific <?=$stilo_de_bordas?>">
                    <div style=" background-image: url(media/img/<?=$imagen?>);" class="c1 c1_1"></div>
                    <div class="c1 c1_2">
                        <a href="pbl/?pbl=<?=criptografar($cmt['id_pbl'])?>">
                            <div class="user">
                                <span><strong><?=$user['nome']?></strong></span> comentou na tua publicacao
                            </div>
                            <div class=" texto"><span><?=resumir_texto($cmt['texto_cmt'],28)?></span></div>
                        </a>
                    </div>
                    <div class="c1 c1_3">
                        <img src="bibliotecas/bootstrap/icones/chat-left-dots.svg" alt="">
                    </div>
                    <div class="data"><?=resumir_data($sql['data'])?></div>
                </div>
                <?php
            }elseif ($sql['tipo'] == "cmt_code") {
                $cmt = $this->pdo->prepare("SELECT cmt.texto AS texto_cmt,cod.id_code,tipo,cod.titulo AS texto_pbl FROM codigos AS cod
                INNER JOIN cmt ON (cmt.id = cod.id_code)
                WHERE cmt.id_cmt=:id AND cmt.tipo = 'code'");
                $cmt->bindValue(":id", $id);
                $cmt->execute();
                $cmt = $cmt->fetch();
                ?>
                <div class="notific <?=$stilo_de_bordas?>">
                    <div style=" background-image: url(media/img/<?=$imagen?>);" class="c1 c1_1"></div>
                    <div class="c1 c1_2">
                        <a href="coder/ver.php?coder=<?=criptografar($cmt['id_code'])?>&modificar=0&comentar=1">
                            <div class="user">
                                <span><strong><?=$user['nome']?></strong></span> comentou o teu codigo
                            </div>
                            <div class=" texto"><span><?=resumir_texto($cmt['texto_cmt'],28)?></span></div>
                        </a>
                    </div>
                    <div class="c1 c1_3">
                        <img src="bibliotecas/bootstrap/icones/chat-left-dots.svg" alt="">
                    </div>
                    <div class="data"><?=resumir_data($sql['data'])?></div>
                </div>
                <?php
            }
        }elseif($sql['tipo'] == "reagir_pbl"){
            $pbl = mysqli_query(conn(), "SELECT pbl.texto,pbl.id_pbl FROM pbl 
            WHERE id_pbl=$id");
            $pbl = mysqli_fetch_assoc($pbl);
            ?>
            <div class="notific <?=$stilo_de_bordas?>">
                <div style=" background-image: url(media/img/<?=$imagen?>);" class="c1 c1_1"></div>
                <div class="c1 c1_2">
                    <a href="pbl/?pbl=<?=criptografar($pbl['id_pbl'])?>">
                        <div class="user">
                            <span onclick="ir_para_perfil(<?=criptografar($id_dest)?>)"><strong><?=$user['nome']?></strong></span> reagiu a tua publicacao
                        </div>
                        <div class=" texto"><span><?=resumir_texto($pbl['texto'],25)?></span></div>
                    </a>
                </div>
                <div class="c1 c1_3">
                    <img src="bibliotecas/bootstrap/icones/heart-fill.svg" alt="">
                </div>
                <div class="data"><?=resumir_data($sql['data'])?></div>
            </div>
            <?php
        }elseif($sql['tipo'] == "contacto_aceite"){
            ?>
            <div class="notific <?=$stilo_de_bordas?>">
                <div style=" background-image: url(media/img/<?=$imagen?>);" class="c1 c1_1"></div>
                <a href="perfil/?user=<?=criptografar($id_dest)?>">
                    <div class="c1 c1_2">
                        <div class="user">
                            <span><strong><?=$user['nome']?></strong></span> <br>                  
                            aceitou teu pedido de amizade
                        </div>
                    </div>
                </a>
                <div class="c1 c1_3">
                    <img src="bibliotecas/bootstrap/icones/people.svg" alt="">
                </div>
                <div class="data"><?=resumir_data($sql['data'])?></div>
            </div>
            <?php            
        }
        ?><script>function ir_para_perfil(id){window.location.href="perfil/?user="+id+""}</script>  <?php
    }
    public function procurar($tipo = false)
    {
        $query =  $this->pdo->prepare("SELECT id_historico,h.id_user AS id_dest, h.id, tipo , h.data FROM $this->bdnome2.historico AS h
        LEFT JOIN pbl AS p ON (h.id = p.id_pbl AND p.id_user = :user AND (h.tipo = 'cmt' OR h.tipo = 'reagir_pbl'))
        LEFT JOIN contacto AS c ON (h.id = c.id_contacto AND c.id_user = :user AND c.id_user_dest = h.id_user)
        LEFT JOIN codigos AS cod ON (h.id = cod.id_code AND cod.id_user = :user AND h.tipo = 'cmt_code')
        WHERE (((p.id_pbl > 0 OR cod.id_code > 0) AND tipo != 'contacto_aceite') OR (c.id_contacto > 0)) AND h.id_user != :user ORDER BY id_historico DESC");
        $query->bindValue(":user", $this->id_user);
        $query->execute();
        
        if ($tipo) {
            return $query->fetchAll();
        }
        $query = $query->fetchAll();
        foreach ($query as $sql) {
            if (!isset($stilo_de_bordas)) {
                $stilo_de_bordas = 1;
            }
            if ($sql['id'] != NULL) {
                if ($stilo_de_bordas == 1) {
                    $stilo_de_bordas = 2 ;
                }else {
                    $stilo_de_bordas = 1;
                }
                $this->mostrar($sql,$stilo_de_bordas);
                $this->marcar_visto($sql['id_historico'],"notific");
            }
        }  
    }
}
?>