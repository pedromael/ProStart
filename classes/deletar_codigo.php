<?php
class deletar_codigo extends conexao
{
    public function __construct(){
        parent::__construct();
    }    
    public function deletar_codigo($id_code){
        $sql = $this->pdo->prepare("DELETE FROM codigos WHERE id_code=:code");
        $sql->bindValue(":code", $id_code);
        $sql->execute();
        return true;
    }
}

?>