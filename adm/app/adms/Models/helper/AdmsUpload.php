<?php 

    namespace App\adms\Models\helper;


    /**
     * Classe genérica para upload
     * 
     * @author Franklin <franklin@gmail.com>
     */
    class AdmsUpload
    {
        private string $directory;

        private string $tmpName;

        private string $name;


        private bool $result;

        function getResult(): bool
        {
            return $this->result;
        }
        
        public function upload(string $directory, string $tmpName, string $name): void
        {
            $this->directory = $directory;
            $this->tmpName = $tmpName;
            $this->name = $name;

            if($this->valDirectory()){
                $this->uploadFile();
            }else{
                $this->result = false;
            }
        }

        private function valDirectory(): bool
        {
            if((!file_exists($this->directory)) and (!is_dir($this->directory))){
                mkdir($this->directory);
                if((!file_exists($this->directory)) and (!is_dir($this->directory))){
                    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Falha ao tentar upload! Tente novamente!</p>";
                    return false;
                }else{
                    return true;
                }
            }else{
                return true;
            }
        }

        private function uploadFile():void
        {
            if(move_uploaded_file($this->tmpName, $this->directory . $this->name)){
                $this->result = true;
    
            }else{
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Falha ao tentar upload! Tente novamente!!</p>";
                $this->result = false;
            }
        }
    }

?>