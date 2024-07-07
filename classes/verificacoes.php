<?php
interface interface_verificar{
    public function verificar_contacto();
}
class verificacoes extends conexao
{
    public function __construct(){

    }
    public function verificar_contacto($id,$id2){
        return true;
    }
}

?>