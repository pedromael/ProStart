<?php
if ($abrir_nav == "primeiro") {
    ?>
    <footer class="footer">
        <div>
            <a href="login/"><img class="icone_medio" src="bibliotecas/bootstrap/icones/power.svg" alt=""></a>
        </div>
        <div class="nome">
            <a href="perfil"><?=$user['nome']?></a>
        </div>
    </footer>
    <?php
}elseif($abrir_nav == "segundo"){
    ?>
    <footer class="footer">
        <div>
            <a href="../login/"><img class="icone_medio" src="../bibliotecas/bootstrap/icones/power.svg" alt=""></a>
        </div>
        <div class="nome">
            <a href="../perfil"><?=$user['nome']?></a>
        </div>
    </footer>
    <?php
}
?>
