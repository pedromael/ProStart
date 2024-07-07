<?php
class carregar_codigo
{
    public $dir;
    public $dir_nome;
    public function carregar($projecto) {
        if (!is_dir($projecto)) {return false;}
        if (!is_dir($this->dir)) {
            mkdir($this->dir, 0777, true);
        }
        $files = scandir($projecto);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                if (is_dir($projecto . '/' . $file)) {
                    $this->dir =  $projecto . '/' . $file;
                    $this->carregar($projecto . '/' . $file);
                } else {
                    $source = $projecto . '/' . $file;
                    $dest = $this->dir . '/' . $file;
                    copy($source, $dest);
                }
            }
        }
        return true;
    }
}
?>