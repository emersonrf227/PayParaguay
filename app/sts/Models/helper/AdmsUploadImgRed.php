<?php
namespace App\sts\Models\helper;

if(!defined("URL")){
    header("Location: /");
    exit();
}

class AdmsUploadImgRed
{
    private $DadosImagem;
    private $Diretorio;
    private $NomeImg;
    private $Resultado;
    private $Imagem;
    private $Largura;
    private $Altura;
    private $ImgRedimens;
            
    function getResultado()
    {
        return $this->Resultado;
    }

        public function uploadImagem(array $Imagem, $Diretorio, $NomeImg, $Largura, $Altura )
    {
       // echo $NomeImg; exit;

       
        $this->DadosImagem = $Imagem;
        $this->Diretorio = $Diretorio;
        $this->NomeImg = $NomeImg;
        $this->Largura = $Largura;
        $this->Altura = $Altura;
       
        $this->validarImagem();
        if($this->Imagem){
            $this->Resultado = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: A extensão da imagem é inválida. Selecione um imagem JPEG ou PNG!</div>";
            $this->Resultado = false;
        }
    }
    
    private function validarImagem()
    {
        switch ($this->DadosImagem['type']):
            case 'image/jpeg';
            case 'image/pjpeg';
                $this->Imagem = imagecreatefromjpeg($this->DadosImagem['tmp_name']);
                $this->resize(imagesx($this->Imagem), imagesy($this->Imagem));
                $this->valDiretorio();
                imagejpeg($this->ImgRedimens, $this->Diretorio . $this->NomeImg, 75);
                break;
            case 'image/png':
            case 'image/x-png';
                $this->Imagem = imagecreatefrompng($this->DadosImagem['tmp_name']);
               // $this->Imagem = imagecreatefromjpeg($this->DadosImagem['tmp_name']);
                $this->resizePng(imagesx($this->Imagem), imagesy($this->Imagem));
              
                $this->valDiretorio();
                //imagepng($this->ImgRedimens, $this->Diretorio . $this->NomeImg, 6);$fileParts[count($fileParts)-1]
                $fileParts = explode('.', $this->NomeImg);
                imagejpeg($this->ImgRedimens, $this->Diretorio. $this->NomeImg, 75);
                rename ($this->Diretorio. $this->NomeImg, $this->Diretorio. $fileParts[0].'.png');
                imagedestroy($this->ImgRedimens);
                break;            
        endswitch;        
    }
    
    private function valDiretorio()
    {
        if(!file_exists($this->Diretorio) && !is_dir($this->Diretorio)){
            mkdir($this->Diretorio, 0755,true);
        }
    }
    
    private function resize($largura_original,  $altura_original)
    {
       
        $this->ImgRedimens = imagecreatetruecolor($this->Largura, $this->Altura);
        
        imagecopyresampled($this->ImgRedimens, $this->Imagem, 0, 0, 0, 0, $this->Largura, $this->Altura, $largura_original, $altura_original);
    }

    private function resizePng($largura_original,  $altura_original)
    {
       
        $this->ImgRedimens = imagecreatetruecolor($this->Largura, $this->Altura);

        imagefill($this->ImgRedimens, 0, 0, imagecolorallocate($this->ImgRedimens, 255, 255, 255));
        imagealphablending($this->ImgRedimens, TRUE);
        imagecopy($this->ImgRedimens, $this->Imagem, 0, 0, 0, 0, imagesx($this->Imagem), imagesy($this->Imagem));
        imagecopyresampled($this->ImgRedimens, $this->Imagem, 0, 0, 0, 0, $this->Largura, $this->Altura, $largura_original, $altura_original);
        imagedestroy($this->Imagem);
        
        
    }

    public function scale($scale) {
        $width  = imagesx($this->Imagem) * $scale / 100;
        $height = imagesy($this->Imagem) * $scale / 100;
        $this->resize($width, $height);
    }
}
