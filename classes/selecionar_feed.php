<?php
class selecionar_feed 
{
    private $postes;
    public $codigos;
    public $id;
    public $postes_encotrados;
    public $quantidade_de_postes = 2;
    private $numero_maximo_de_codigos = 1;
    public function __construct(){
        $this->postes = new postes;
        //$this->codigos = new codigos; 
    }
    public function selecionar_poste($tipo_de_feed){
        if ($tipo_de_feed == "perfil") {
            $this->postes->para = "perfil";
            $this->postes->oque = $this->id;
            $this->quantidade_de_postes = 10;
            $a = 0;
            while ($a <= $this->quantidade_de_postes) {
                if ($this->postes->procurar() == 404) {
                    return true;
                }
                $a++;
            }
        }elseif($tipo_de_feed == "comunidade"){
            $this->postes->para = "comunidade";
            $this->postes->oque = $this->id;
            $a = 0;
            while ($a <= $this->quantidade_de_postes) {
                if ($this->postes->procurar() == 404) {
                    $this->postes_encotrados = $a;
                    return true;
                }
                //$a++;
            }
        }elseif($tipo_de_feed == "codigos"){
            // $a = 0;
            // while ($a <= $this->quantidade_de_postes) {
            //     if ($this->codigos->pegar_codigo_para_poste() == 404) {
            //         break;
            //     }
            //     // $a++;
            // }
        }else {
            $a = 0;
            //$divisao = round($this->quantidade_de_postes / 2)-1;
            $this->postes->para = "pagina_inicial";
            $this->postes->oque = "pbl";
            while ($a <= $this->quantidade_de_postes) {
                $this->postes_encotrados = $a;
                if ($this->quantidade_de_postes <= $a) {
                    return 404;
                }
                $this->postes->procurar();
                // if ($a == 1) {
                //     if ($this->codigos->pegar_codigo_para_poste() == 404) { 
                //         if ($this->postes->procurar() == 404) {
                //             break;
                //         }
                //     }
                // }else {
                //     if ($this->postes->procurar() == 404) {
                //         if ($this->codigos->pegar_codigo_para_poste() == 404) {
                //            break;
                //         }
                //     }
                // }
                $a++;
            }
            return true;
        }
    }
}

?>