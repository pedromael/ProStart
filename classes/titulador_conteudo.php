<?php
class titulador_conteudo 
{
    public $texto;
    public function __construct($texto){
        $this->texto = $texto;
    }
    public function analizar(){
        $numero_de_char = strlen($this->texto);
        if ($numero_de_char <= 15) {
            return $numero_de_char; 
        }
        return $this->texto;
    }
}

?>