<?php
class conexao
{
    public $pdo;
    public $erro;
    private $bdnome = "pro_start";
    private $bdhost = "localhost";
    private $bdpass = "";
    private $bduser = "root";
    public $bdnome2 = "pro_start_outros";

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:dbname=".$this->bdnome.";host=".$this->bdhost,$this->bduser,$this->bdpass);
        } catch (PDOexception $e) {
            $this->erro = $e->getMessage();
        }
    }
}
?>