<?php

class repositorio extends informacoes_usuario
{
    public function __construct() {
        parent::__construct();
    }

    public function repositorio($id = false) {
        if ($id != false) {
            $sql = $this->pdo->prepare("SELECT * FROM $this->bdrepositorio.repositorio WHERE id_repositorio = :i");
            $sql->bindValue(":i", $id);
        } else {
            $sql = $this->pdo->prepare("SELECT * FROM $this->bdrepositorio.repositorio ORDER BY id_repositorio DESC");
        }
        $sql->execute();
         
        return $id ? $sql->fetch() : $sql->fetchAll();
    }

    public function criar($dados) {
        // Antes de criar, verifica se o nome já está em uso
        if (!$this->verificarNomeDisponivel($dados['nome'], $_SESSION['id_user'])) {
            return false; // Nome indisponível
        }

        $sql = $this->pdo->prepare("INSERT INTO $this->bdrepositorio.repositorio(id_user, nome, data_criacao)
                                    VALUES(:i, :n, NOW())");
        $sql->bindValue(":i", $_SESSION['id_user']);
        $sql->bindValue(":n", $dados['nome']);
        return $sql->execute() ? true : false;
    }

    public function verificarNomeDisponivel($nome, $id_user) {
        $sql = $this->pdo->prepare("SELECT COUNT(*) as total FROM $this->bdrepositorio.repositorio 
                                    WHERE nome = :n AND id_user = :u");
        $sql->bindValue(":n", $nome);
        $sql->bindValue(":u", $id_user);
        $sql->execute();
        $result = $sql->fetch();
        return $result['total'] == 0; // Retorna true se não há repositórios com o mesmo nome
    }

    public function pegar_repositorio_info($id, $tipo) {
        $username = $this->usuario($this->repositorio($id)['id_user'])['code_nome'];
        function pegar($diretorio, $ficheiros, $dados) {
            foreach ($ficheiros as $ficheiro) {
                if ($ficheiro !== "." && $ficheiro !== "..") {
                    if (is_dir($diretorio."/".$ficheiro)) {
                        $diretorio = $diretorio."/".$ficheiro;
                        $ficheiros_1 = scandir($diretorio);
                        $dados = pegar($diretorio, $ficheiros_1, $dados);
                    } else {
                        if (!in_array(pathinfo($ficheiro, PATHINFO_EXTENSION), $dados[1])) {
                            array_push($dados[1], pathinfo($ficheiro, PATHINFO_EXTENSION));
                        }
                        $dados[0]++;
                    }
                }
            }
            return $dados;
        }

        if ($tipo == "f") { // ficheiros
            $diretorio = "../perfil/".$username."/repositorio/".$this->repositorio($id)['nome']."/";
            $ficheiros = scandir($diretorio);
            $dados = [0, array()];
            $dados = pegar($diretorio, $ficheiros, $dados);
            return $dados;
        } else if ($tipo == "r") { // repositorio
            // Implementar lógica para tipo "r", se necessário
        }
        return true;
    }

    public function apagar() {
        return true;
    }
}
