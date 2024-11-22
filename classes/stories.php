<?php
class stories extends informacoes_usuario
{
    public $all_stories;
    public $stories;
    private $id_user;
    private $process;
    public function __construct()
    {
        parent::__construct();
        $this->all_stories = array();
        $this->verificar_all_stories($_SESSION['id_user']);
        $this->selecionar();
        $this->process = new process;
    }
    private function verificar_all_stories($id_user)
    {
        $sql = $this->pdo->prepare("SELECT DISTINCT stories.id_user, stories.data FROM stories
                        
        INNER JOIN contacto AS c ON ((c.id_user = :user AND c.id_user_dest = stories.id_user)
        OR (c.id_user = stories.id_user AND c.id_user_dest = :user) OR stories.id_user = :user)
        
        INNER JOIN $this->bdnome2.contacto_aceite AS ca ON (ca.id_contacto = c.id_contacto 
        OR (c.id_user = :user AND c.id_user_dest = stories.id_user) OR stories.id_user = :user)
        
        WHERE (ca.id > 0 OR (c.id_user = :user AND c.id_user_dest = stories.id_user))
        OR stories.id_user = :user
        ORDER BY stories.data desc");
        $sql->bindValue(":user", $id_user);
        if(!$sql->execute()) return false;

        $this->stories = $sql->fetchAll();
    }
    public function storie_info($id_user,$visualizar = false){
        $id_user_storie = $id_user;
        $dados['bg_storie'] = false;
        $nome = false;
        $contagem = array();
        $sql11 = mysqli_query(conn(), "SELECT * FROM stories WHERE id_user = $id_user_storie");
        if ($visualizar) {
            $nome = $this->usuario($id_user_storie)['nome'];
            $dados['nome'] = $nome;
            $tamanho_nome = strlen($dados['nome']);
            if ($tamanho_nome > 15) {
                $dados['nome'] = explode(" ",$dados['nome']);
                $dados['nome'] = $dados['nome'][0]." ".$dados['nome'][1];
            }
            $dados['stories'] = [];
            while ($sql1 = mysqli_fetch_assoc($sql11)) {
                array_push($dados['stories'],$sql1);
            }
            return $dados;
        }else{
            while ($sql1 = mysqli_fetch_assoc($sql11)) {
                $id_storie = $sql1['id_storie'];
                if ($this->process->qtd_vistos($id_storie,'storie') > 0) {
                    array_push($contagem,true);
                }else {
                    array_push($contagem,false);
                    if (!$dados['bg_storie']) {
                        $dados['bg_storie'] = $sql1['indereco_img'];
                    }
                }
                if (!$nome) {
                    $nome = $this->usuario($id_user_storie)['nome'];
                    $dados['nome'] = $nome;
                    if (strlen($dados['nome']) > 15) {
                        $dados['nome'] = explode(" ",$dados['nome']);
                        $dados['nome'] = $dados['nome'][0]." ".$dados['nome'][1];
                    }
                }
            }
        }
        $dados['contagem'] = $contagem;
        return $dados;
    }
    private function selecionar()
    {   
        foreach ($this->stories as $dados) {
            $id_user = $dados['id_user'];
            $sql = $this->pdo->prepare("SELECT * FROM stories WHERE id_user = :user");
            $sql->bindValue(":user", $id_user);
            $sql->execute();

            $dados = $sql->fetchAll();
            foreach ($dados as $key) {
                array_push($this->all_stories,$key);    
            }
        }
        return $this->all_stories;
    }
}

?>