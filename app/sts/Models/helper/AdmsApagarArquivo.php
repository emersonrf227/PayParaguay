<?php
namespace App\sts\Models\helper;

if(!defined("URL")){
    header("Location: /");
    exit();
}

class AdmsApagarArquivo
{

    private $FileName;
    private $Diretorio;

    public function apagarArquivo($FileName, $Diretorio = null)
    {
        $this->FileName = (string) $FileName;
        $this->Diretorio = (string) $Diretorio;
        $this->excluirArquivo();
        if(!empty($this->Diretorio)){
            $this->excluirDiretorio();
        }
    }

    private function excluirArquivo()
    {
        if(file_exists($this->FileName)){
            unlink($this->FileName);
        }
    }
    
    private function excluirDiretorio()
    {
        if(file_exists($this->Diretorio)){
            rmdir($this->Diretorio);
        }
    }
    
    public function apagarDiretorio($diretorio)
    {
         $this->Diretorio = (string) $diretorio;
         array_map('unlink', glob("$diretorio/*"));
        
         if(!empty($this->Diretorio)){
            $this->excluirDiretorio();
        }
        
    }

}
