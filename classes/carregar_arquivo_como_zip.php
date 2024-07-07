<?php
class carregar_arquivo_como_zip
{
    public $dir;
    public $zip_nome;
    private $zip;
    public function __construct(){
        $this->zip = new ZipArchive;
    }
    public function carregar($arquivos){
        if ($this->zip->open($this->zip_nome,ZipArchive::CREATE) === true) {
            move_uploaded_file($this->zip_nome, $this->dir.$this->zip_nome);
            $ficheiros = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($arquivos),
            RecursiveIteratorIterator::LEAVES_ONLY);
            foreach ($ficheiros as $name => $ficheiro) {
                if (!$ficheiro->isDir()) {
                    $ficheiro_path = $ficheiro->getRealPath();
                    $relative_path = substr($ficheiro_path, strlen($arquivos) + 1);
                    $this->zip->addFile($ficheiro_path,$relative_path);
                }
            }
            $this->zip->close();
            move_uploaded_file($this->zip_nome, $this->dir.$this->zip_nome);
            return true;
        }
        return false;
    }
}

?>