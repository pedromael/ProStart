<?php
class lista_de_integrantes_comunidade extends conexao
{
    static $erro;
    public $lista_integrantes;
    public function pegar($id_comunidade){
        $sql = $this->pdo->prepare("SELECT id_user,data FROM $this->bdnome2.integrantes_comunidade WHERE id_comunidade = :user");
        $sql->bindValue(":user", $id_comunidade);
        $sql->execute();
        $dados = $sql->fetch();
        return $dados;
    }
}

?>