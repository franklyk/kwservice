<?php 

    namespace Core;


    /**
     * Verificar se existe a classe
     * Carrega a CONTROLLER
     * @author FRANKLIN(" KLYK ") <frsbatist@gmail.com>
     * 
     */
    class CarregarPgAdm
    {
        /** @var string $urlController Recebe a URL e o nome da controller */
        private string $urlController;
        /** @var string $urlMetodo Recebe a URL e o nome do método */
        private string $urlMetodo;
        /** @var string $urlParameter Recebe da URL o parâmetro */
        private string $urlParameter;

        public function loadPage(string|null $urlController, string|null $urlMetodo, string|null $urlParameter){
            $this->urlController = $urlController;
            $this->urlMetodo = $urlMetodo;
            $this->urlParameter = $urlParameter;


            var_dump($this->urlController);
            var_dump($this->urlMetodo);
            var_dump($this->urlParameter);

            $this->classLoad = "\\App\\adms\\Colntollers\\" . $this->urlController;
            if(class_exists($this->classLoad))

        }

    }

?>