<?php

namespace App\adms\Models\helper;

use PDO;
use PDOException;

/**
 * Classe gernérica para redimensionar a imagem
 *
 * @author FRANKLIN <frsbatist@gmail.com>
 */
class AdmsUploadImgRes
{
    private array $imageData;
    private string $directory;
    private string $name;
    private int $width;
    private int $height;
    private $newImage;
    private bool $result;
    private $imgResize;
    
    function getResult(): bool
    {
        return $this->result;
    }

    public function upload(array $imageData, string $directory, string $name, int $width, int $height): void
    {
        $this->imageData = $imageData;
        $this->directory = $directory;
        $this->name = $name;
        $this->width = $width;
        $this->height = $height;
        

        var_dump($this->imageData);

        $this->valDirectory();
    }

    private function valDirectory(): void
    {
        if((file_exists($this->directory)) and (!is_dir($this->directory))){
            $this->createDir();
        }elseif(!file_exists($this->directory)){
            $this->createDir();
        }else{
            $this->uplodaFile();
        }
        
    }

    private function createDir(): void
    {
        mkdir($this->directory, 0755);
        if(!file_exists($this->directory)){
            $_SESSION['msg'] = "<p style='color: #ff0;'>Falha de uoload! Tente novamente!</p>";
            $this->result = false;
        }else{
            $this->uplodaFile();
        }
    }

    private function uplodaFile(): void
    {
        switch($this->imageData['type']){
            case 'image/jpeg':
                case 'image/pjpeg':
                    $this->uploadFileJpeg();
                    break;
            case 'image/png':
                case 'image/x-png':
                    $this->uploadFilePng();
                    break;
            default:
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Necessário selecionar uma imagem JPG ou PNG!</p>";
                $this->result = false;
        }
        /*$_SESSION['msg'] = "<p style='color: #ff0;'>Acessou o Helper!</p>";
        $this->result = false;*/
    }

    private function uploadFileJpeg(): void
    {
        $this->newImage = imagecreatefromjpeg($this->imageData['tmp_name']);

        $this->resImg();

        //Enviar a imagem para o servidor
        if(imagejpeg($this->imgResize, $this->directory . $this->name, 100)){
            $_SESSION['msg'] = "<p style='color: #d88;'>Upload da imagem realizado com sucesso!</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Falha no upload! Tente novamente!</p>";
            $this->result = false;
        }
    }
    
    private function uploadFilePng(): void
    {
        $this->newImage = imagecreatefrompng($this->imageData['tmp_name']);

        $this->resImg();

        //Enviar a imagem para o servidor
        if(imagepng($this->imgResize, $this->directory . $this->name, 1)){
            $_SESSION['msg'] = "<p style='color: #d88;'>Upload da imagem realizado com sucesso!</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Falha no upload! Tente novamente!</p>";
            $this->result = false;
        }
    }

    private function resImg(): void
    {
        //obter a largura da imagem
        $width_original = imagesx($this->newImage);

        //obter a altura da imagem
        $height_original = imagesy($this->newImage);

        //Criar uma imagem modelo com as dimensões definidas para a nova imagem
        $this->imgResize = imagecreatetruecolor($this->width, $this->height);

        //Copiar e redimensionar parte da imagem enviada pelo usuário e interpola com a imagem tamanho modelo
        imagecopyresampled($this->imgResize, $this->newImage, 0, 0, 0, 0, $this->width, $this->height, $width_original, $height_original);
    }
    
}
