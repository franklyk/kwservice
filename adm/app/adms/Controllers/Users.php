<?php 

    

    namespace App\adms\Controllers;

    /**
     * Página para listar usuários
     */
    class Users
    
    {
        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data;
        
        public function index()
        {
            $this->data = [];

            $loadView = new \Core\ConfigView("adms/Views/users/users", $this->data);
            $loadView->loadView();
        }
    }


?>