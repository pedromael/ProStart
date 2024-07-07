<style>
    .menu .mode{
    position: fixed;
    min-width: 44px;
    min-height: 44px;
    text-align: center;
    right: 15px;
    bottom: 50px;
    color: rgb(255, 255, 255);
    background-color: var(--cor_pri);
    border-radius: 100%;
    }
    .menu .mode img{
        margin: 4px;
        width: 30px;
        height: 30px;
    }
    .menu #abrir_menu{
        z-index: 10;
    }
    .menu #abrir_menu .search{
        background-color: var(--cor_pri);
        width: 100%;
        margin: auto;
        margin-bottom: none;
        border-bottom: 4px solid var(--cor_sec);
        height: 60px;
        padding: 5px;
    }
    .menu #abrir_menu .search form{
        border: 1px solid transparent;
    }
    .menu #abrir_menu .search .input{
        width: 74%;
    }
    .menu #abrir_menu .search .button{
        width: 24%;
    }
    .menu #abrir_menu .icon_retirar img{
        width: 35px;
    }
    .menu #abrir_menu .search img{
        width: 30px;
        height: 30px;
    }
    .menu #abrir_menu .search input{
        width: 100%;
        height: 40px;
        border-radius: 20px;
        border: 2px solid var(--cor_sec);
        color: black;
        background: white;
    }
    .menu #abrir_menu .search button{
        border: 2px solid transparent;
        width: 100%;
        height: 40px;
        border-radius: 20px;
        border-left-color: var(--cor_terc);
        background: var(--cor_sec);
    }
    .menu #abrir_menu{
        animation: aparecer 0.5s linear;
        position: fixed;
        min-width: 100%;
        min-height: max-content;
        text-align: center;
        top: 54px;
        left: 0px;
        color: rgb(255, 255, 255);
        border-radius: 20px;
    }
    @keyframes aparecer{
        from{
            opacity: 0%;
            top: -100px;
        }
        to{
            opacity: 100%;
            top: 55px;
        }
    }
    @media (min-width: 750px) {
        .menu{
            display: none;
        }
    }
</style>
<div class="menu">
    <div id="abrir_menu" class="remover">
        <div class="search container">
            <form action="search.php" method="get" class="container">
                <div class="d-inline-block input">
                    <input type="search" name="valor" required>
                </div>
                <div class="d-inline-block button">
                    <button><img src="bibliotecas/bootstrap/icones/search.svg" alt=""></button>
                </div>
            </form>
        </div>   
        <div  onclick="abri_fecha('#abrir_menu')" class="icon_retirar">
            <img src="bibliotecas/bootstrap/icones/chevron-down.svg" alt="">
        </div>
    </div>
    <div class="mode" onclick="abri_fecha('#abrir_menu')"><img src="bibliotecas/bootstrap/icones/search.svg" alt=""></div>
</div>
