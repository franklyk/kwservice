<?php 

    

    namespace App\adms\Controllers;


    class ViewUsers
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

            $this->data = [];

            echo "Pagina visualizar usuarios <br>";

            $loadView = new \Core\ConfigView("adms/Views/users/viewUser", $this->data);
            $loadView->loadView();
        }
    }


?>