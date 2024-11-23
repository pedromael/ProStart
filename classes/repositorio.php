<?php

class repositorio extends conexao
{
    public function repositorio($id = NULL){
        if($id != NULL){
            $sql = $this->pdo->prepare("SELECT * FROM repositorio WHERE id_repositorio = :i");
            $sql->bindValue(":i", $id);
        }else{
            $sql = $this->pdo->prepare("SELECT * FROM repositorio ORder BY desc");
        }
        if (!$sql->execute()) {
            return false;
        }
        $dados = $sql->fetch();
        return $dados;
    }
    public function criar($dados) {
        $sql = $this->pdo->prepare("INSERT INTO repositorio(id_user,nome,data_criacao)
        VALUES(:i,:n, NOW()) ");
        $sql->bindValue(":i", $_SESSION['id_user']);
        $sql->bindValue(":n", $dados['nome']);
        if (!$sql->execute()) {
            return true;
        }
        return true;
    }    
    public function pegar_repositorio_info($id,$tipo){

        function pegar($diretorio, $ficheiros, $dados){
            foreach ($ficheiros as $ficheiro) {
                if ($ficheiro !== "." && $ficheiro !== ".") {
                    if (is_dir($diretorio."/".$ficheiro)) {
                        $diretorio = $diretorio."/".$ficheiro;
                        $ficheiros_1 = scandir($diretorio);
                        $dados = pegar($diretorio, $ficheiros_1,$dados);
                    }else{
                        if (!in_array(pathinfo($ficheiro, PATHINFO_EXTENSION), $dados[1])) {
                            array_push($dados[1], pathinfo($ficheiro, PATHINFO_EXTENSION));
                        }
                        $dados[0]++;
                    }
                }
            }
            return $dados;
        }

        if($tipo == "f"){//ficheiros
            $diretorio = "../arquivos/repositorio/".$this->repositorio($id)['id_repositorio']."/";
            $ficheiros = scandir($diretorio);
            $dados = [0,array()];
            $dados = pegar($diretorio, $ficheiros, $dados);
            return $dados;
        }else if($tipo == "r"){//repositorio

        }
        return true;
    }
    public function apagar() {
        return true;
    }
}

?>