<?php
if ($abrir_nav == "primeiro") {
    ?>
    <footer class="footer">
        <div class="container">
            <a href="./"><h4>SyliaGO</h4></a>
        </div>
        <div class="nome">
            <a href="perfil"><?=$user['nome']?></a>
        </div>
    </footer>
    <?php
}elseif($abrir_nav == "segundo"){
    ?>
    <footer class="footer">
        <div class="container">
            <a href="../"><h4>SyliaGO</h4></a>
        </div>
        <div class="nome">
            <a href="../perfil"><?=$user['nome']?></a>
        </div>
    </footer>
    <?php
}
?>
