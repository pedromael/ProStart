<?php
if ($abrir_nav == "primeiro") {
    ?>
    <div id="segunda_nav" class="remover">
        <div class="container">
            <legend>
                <table>
                    <tr>
                        <td id="img_sec_nav"><a href="perfil/?user=<?=criptografar($user['id_user'])?>"><img src="media/img/<?=$imagen?>" alt=""></a></td>
                        <td id="texto"><a href="perfil/?user=<?=criptografar($user['id_user'])?>"><?=$user['code_nome']?></a></td>
                    </tr>
                </table>
            </legend>
            
            <ul>
                <li class="contactos">
                    <a href="contactos/">
                        <img src="bibliotecas/bootstrap/icones/people.svg" alt="">
                        encontrar Amigos
                        <?php
                        if($c->verificar_qtd("pdd",$user['id_user']) > 0){
                            ?>
                            <div class="info_qtd_p info_qtd_pdd actualizar"><?=$c->verificar_qtd("pdd",$user['id_user'])?></div>
                            <?php
                        }else {
                            ?>
                            <div style="" class="info_qtd_pdd actualizar"></div>
                            <?php
                        }
                        ?>  
                    </a>
                </li>
                <li>
                    <a href="salvos.php">
                        <img src="bibliotecas/bootstrap/icones/bookmark.svg" alt="">
                        Salvos
                    </a>
                </li>
            </ul>
            <legend>config</legend>
            <ul>
                <a href="config/preferencias.php"><li>Preferencias</li></a>
                <a href="config/"><li>Configuracoes</li></a>
                <a href=""><li>Idioma</li></a>
                <a href=""><li>Ajuda</li></a>
            </ul>
            <a href="instrucoes/"><legend>apresetacao</legend></a>
        </div>   
    </div>
    <?php
}elseif($abrir_nav == "segundo") {
    ?>
    <div id="segunda_nav" class="remover">
        <div class="container">
            <legend>
                <table>
                    <tr>
                        <td id="img_sec_nav"><a href="../perfil/?user=<?=criptografar($user['id_user'])?>"><img src="../media/img/<?=$imagen?>" alt=""></a></td>
                        <td id="texto"><a href="../perfil/?user=<?=criptografar($user['id_user'])?>"><?=$user['code_nome']?></a></td>
                    </tr>
                </table>
            </legend>
            
            <ul>
                <li class="contactos">
                    <a href="../contactos/">
                        <img src="../bibliotecas/bootstrap/icones/people.svg" alt="">
                        encontrar Amigos
                        <?php
                        if($c->verificar_qtd("pdd",$user['id_user']) > 0){
                            ?>
                            <div class="info_qtd_p info_qtd_pdd actualizar"><?=$c->verificar_qtd("pdd",$user['id_user'])?></div>
                            <?php
                        }else {
                            ?>
                            <div style="" class="info_qtd_pdd actualizar"></div>
                            <?php
                        }
                        ?>  
                    </a>
                </li>
                <li>
                    <a href="../salvos.php">
                        <img src="../bibliotecas/bootstrap/icones/bookmark.svg" alt="">
                        Salvos
                    </a>
                </li>
            </ul>
            <legend>config</legend>
            <ul>
                <a href="../config/preferencias.php"><li>Preferencias</li></a>
                <a href="../config/"><li>Configuracoes</li></a>
                <a href=""><li>Idioma</li></a>
                <a href=""><li>Ajuda</li></a>
            </ul>
            <a href="../instrucoes/"><legend>apresetacao</legend></a>
        </div>   
    </div>
    <?php
}
?>