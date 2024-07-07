<?php
class postar_codigo extends conexao
{
    private $id_user;
    public $process;
    public function __construct(){
        parent::__construct();
        $this->process = new process;
        $this->id_user = $_SESSION['id_user'];
    }
    public function postar_codigo($dados,$code_origem = 0,$nova_versao = false) {
        if (!$nova_versao) {
            $sql = $this->pdo->prepare("INSERT INTO codigos(id_user,titulo,linguagem) VALUES(:id,:t,:l)");
            $sql->bindValue(":id", $this->id_user);
            $sql->bindValue(":t", $dados['titulo']);
            $sql->bindValue(":l", $dados['linguagem']);
            $sql->execute();
            $id_code = $this->pdo->LastInsertId();
        }else {
            $id_code = $dados['id_code'];
        }

        $sql = $this->pdo->prepare("INSERT INTO $this->bdnome2.versoes_codigos(id_code,descricao,data)
        VALUES(:id,:d,NOW())");
        $sql->bindValue(":d", $dados['descricao']);
        $sql->bindValue(":id", $id_code);
        if (!$sql->execute()) {
            return false;
        }
        $id_versao = $this->pdo->LastInsertId();
        if ($code_origem > 0) {
            $this->process->inserir_historico("code_versao",$code_origem);
            $documentos = $this->pdo->prepare("SELECT * FROM doc WHERE id=:id AND tipo = :t");
            $documentos->bindValue(":id", $code_origem);
            $documentos->bindValue(":t", "code_sugestao");
            $documentos->execute();
            $indereco = $documentos->fetch()['indereco'];
            $this->process->carregar_documento($id_versao,"code_versao",$indereco);
        }else {
            $ext =".txt";
            $indereco = "../media/codes/";
            $nome = $id_versao."-code-".$_SESSION['id_user']."-".rand(0,999);
            file_put_contents($indereco.$nome.$ext,$dados['code']);
            $this->process->carregar_documento($id_versao,'code_versao',$nome.$ext);
        }
        if (!isset($dados['docs'])) {
            $dados['docs'] = [];
        }
        foreach ($dados['docs'] as $file) {
            if (!$this->carregar_arquivo($dados,$file)) {
                return false;
            }
            $sql = $this->pdo->prepare("INSERT INTO doc(id_user,id,tipo,indereco) VALUES(:user,:id,:t,:i)");
            $sql->bindValue(":user", $this->id_user);
            $sql->bindValue(":id", $id_code);
            $sql->bindValue(":t", "codigo");
            $sql->bindValue(":i", $file['indereco']);
            $sql->execute();    
        }    
        return $id_versao;
    }
    public function sugerir_code($dados,$id_code){
        $sql = $this->pdo->prepare("INSERT INTO $this->bdnome2.codigo_sugestao(id_code,id_user,descricao,data)
        VALUES(:c,:u,:d,NOW())");
        $sql->bindValue(":c", $id_code);
        $sql->bindValue(":u", $_SESSION['id_user']);
        $sql->bindValue(":d", $dados['descricao']);
        if ($sql->execute()) {
            return $this->pdo->LastInsertId();
        }else{
            return false;
        }
    }
    
    public function carregar_arquivo($dados,$FILES) {
        $dir = "media/code/";    

        $_FILES['doc'] = $FILES;
        if (!move_uploaded_file($_FILES['doc']['tmp_name'], $dir . $_FILES['doc']['indereco'])) {
            return false;
        }
        //if ($this->process->carregar_documento($dados['id_user'],'code',)) {
            # code...
        //}
        return true;
    }
}

?>