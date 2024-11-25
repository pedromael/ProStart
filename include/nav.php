<?php
if ($abrir_nav == "primeiro" || $abrir_nav == "segundo") {
    $base_path = $abrir_nav == "primeiro" ? "" : "../";
?>
    <div id="segunda_nav" class="remover bg-light position-fixed h-100 shadow-lg" style="width: 280px; z-index: 1050;">
        <div class="container py-3 d-flex flex-column h-100">
            <!-- Perfil -->
            <div class="d-flex align-items-center mb-4">
                <div class="me-3">
                    <a href="<?=$base_path?>perfil/?user=<?=criptografar($user['id_user'])?>">
                        <img src="<?=$base_path?>media/img/<?=$imagen?>" alt="" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                    </a>
                </div>
                <div>
                    <a href="<?=$base_path?>perfil/?user=<?=criptografar($user['id_user'])?>" class="text-decoration-none fw-bold text-dark">
                        <?=$user['code_nome']?>
                    </a>
                </div>
            </div>

            <!-- Links principais -->
            <ul class="list-unstyled mb-4">
                <li class="mb-2">
                    <a href="<?=$base_path?>contactos/" class="d-flex align-items-center text-decoration-none text-dark">
                        <img src="<?=$base_path?>bibliotecas/bootstrap/icones/people.svg" alt="" class="me-2" style="width: 24px; height: 24px;">
                        <span>Encontrar Amigos</span>
                        <?php if ($c->verificar_qtd("pdd", $user['id_user']) > 0) { ?>
                            <span class="badge bg-primary ms-auto"><?=$c->verificar_qtd("pdd", $user['id_user'])?></span>
                        <?php } ?>
                    </a>
                </li>
                <li>
                    <a href="<?=$base_path?>salvos.php" class="d-flex align-items-center text-decoration-none text-dark">
                        <img src="<?=$base_path?>bibliotecas/bootstrap/icones/bookmark.svg" alt="" class="me-2" style="width: 24px; height: 24px;">
                        <span>Salvos</span>
                    </a>
                </li>
            </ul>

            <!-- Configurações -->
            <legend class="fs-6 text-muted mb-3">Configurações</legend>
            <ul class="list-unstyled mb-4">
                <li class="mb-2">
                    <a href="<?=$base_path?>config/preferencias.php" class="text-decoration-none text-dark">
                        Preferências
                    </a>
                </li>
                <li class="mb-2">
                    <a href="<?=$base_path?>config/" class="text-decoration-none text-dark">
                        Configurações
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" class="text-decoration-none text-dark">
                        Idioma
                    </a>
                </li>
                <li>
                    <a href="#" class="text-decoration-none text-dark">
                        Ajuda
                    </a>
                </li>
            </ul>

            <!-- Apresentação -->
            <a href="<?=$base_path?>instrucoes/" class="text-decoration-none">
                <legend class="fs-6 text-muted">Apresentação</legend>
            </a>

            <!-- Terminar Sessão -->
            <div class="mt-auto">
                <a href="<?=$base_path?>login/" class="btn btn-danger w-100">
                    <img src="<?=$base_path?>bibliotecas/bootstrap/icones/power.svg" alt="" class="me-2" style="width: 20px; height: 20px;">
                    Terminar Sessão
                </a>
            </div>
        </div>
    </div>
<?php
}
?>
