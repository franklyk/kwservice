<?php 

    namespace App\adms\Controllers;
    /**
    * Controller da página de Erro
    * 
    * @author Franklin (" KLYK ") <frsbatist@gmail.com>
    *
    * @return void
    */

    class Erro
    {
        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data;

        /**
         * Instanciar a classe responsável em carregar a View e enviar os dados para a View
         *
         * @return void
         */
        public function index():void
        {
            echo "Pagina de Erro <br>";

            $this->data = "<p style='color:#f00;'>Página não encontrada!</p>";
            $loadView = new \Core\ConfigView("adms/Views/erro/erro", $this->data);
            $loadView->loadView();
        }
    }


?>