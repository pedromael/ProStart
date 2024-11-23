<?php
require "../algoritimos/atalho.php";
require "../algoritimos/seguranca.php";
$data = json_decode(file_get_contents('php://input'), true);
$storie = new stories;
$dados = $storie->storie_info($data['id_user'], true);
?>

<div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
    <!-- Stories Carousel -->
    <div id="userStoriesCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php 
            $isFirst = true;
            foreach ($dados['stories'] as $value) { 
            ?>
            <div class="carousel-item <?=$isFirst ? 'active' : ''?>">
                <div class="position-relative">
                    <!-- Image -->
                    <img src="media/img/<?=$value['indereco_img']?>" class="d-block w-100" alt="Story Image" style="max-height: 500px; object-fit: cover;">

                    <!-- Título e Nome do Proprietário sobrepondo a Imagem (à esquerda) -->
                    <div class="position-absolute top-0 start-0 text-white p-3">
                        <h5 class="mb-1"><?=$dados['nome']?></h5>
                        <!-- <small><?=$value['titulo']?></small> -->
                    </div>

                    <!-- Aba de texto sobrepondo a imagem (parte inferior) -->
                    <div class="position-absolute bottom-0 start-50 translate-middle-x text-white text-center w-100 py-2">
                        <strong>Viva ao Wik</strong>
                    </div>
                </div>
            </div>
            <?php 
            $isFirst = false; 
            } 
            ?>
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#userStoriesCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#userStoriesCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
        </button>
    </div>
</div>
