<div class="cp adm_corpo1">
    <form action="" method="get">
        <div class="container a_pesquisar">
            <input type="search" class="d-inline-block" name="usuarios">
            <button class="d-inline-block">pesquisar</button>
        </div>
    </form>
<?php
    $usuarios = new informacoes_usuario;
    foreach ($usuarios->usuario(false,true) as $key => $value) {
        ?>
        <div class="container usuarios">
            <div class="row">
                <div class="d-inline-block" id="img">
                    <img src="../media/img/<?=pegar_foto_perfil("perfil",$value['id_user'])?>" alt="">
                </div>
                <div class="d-inline-block nome">
                    <div class="container">
                        <div class="row"><?=$value['nome']?></div>
                        <div class="row">
                            <div class="col">amigos:</div>
                            <div class="col">postes:<?=qtd_pbl_user($value['id_user'])?></div>
                        </div>
                    </div>
                </div>
                <div class="d-inline-block btn_msg">
                    <img src="../bibliotecas/bootstrap/icones/chat-dots.svg" alt="">
                </div>
            </div>
        </div>
        <?php
    }
?>
</div>
<div class="cp adm_corpo2">

</div>