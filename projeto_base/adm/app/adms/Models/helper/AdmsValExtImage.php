<?php 

    namespace App\adms\Models\helper;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    

    class AdmsValExtImage
    {
        /** @var string $mimetype Recebe o mimetype da imagem */
        private string $mimetype;

        /** @var string $result Recebe TRUE quando executar o processo com sucesso e FALSE quando houver algum erro*/
        private bool $result;

        function getResult(): bool
        {
            return $this->result;
        }

        /**
         * Validar a extensão da imagem
         * 
         * Recebe a imagem que deve ser validada e valida a imagem
         * 
         * Retorna TRUE quando a extensão da imagem for válida 
         * 
         * Retorna FALSE quando a extensão da imagem for inválida
         *
         * @param string $mimetype Recebe o tipo da imagem que deve ser validada
         * 
         * @return void
         */
        public function validateExtImg(string $mimetype): void
        {
            $this->mimetype = $mimetype;

            switch($this->mimetype){
                case 'image/jpeg':
                    case 'image/pjpeg':
                        $this->result = true;
                        break;
                case 'image/png':
                    case 'image/x-png':
                        $this->result = true;
                        break;
                default:
                    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Necessário selecionar uma imagem JPG ou PNG!</p>";
                    $this->result = false;
            }


            
        }
    }

?>