<?php 

    namespace App\adms\Controllers;
    /**
     * Controller da página de Login
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class Login
    {
        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data;

        /**
        * Instanciar a classe responsável em carregar a View e enviar os dados para a View
        *
        * @return void
        */
        public function index(): void
        {
            echo "Pagina de Login <br>";
            $this->data = null;

         $loadView = new \Core\ConfigView("adms/Views/login/login", $this->data);
         $loadView->loadView();
        }
    }


?>