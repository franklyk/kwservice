<?php 

    

    namespace App\adms\Controllers;

    /**
     * Página para listar usuários
     */
    class ListUsers
    
    {
        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data;
        
        public function index()
        {
            $listUsers = new \App\adms\Models\AdmsListUsers();
            $listUsers->listUsers();

            if($listUsers->getResult()){

                $this->data['listUsers'] = $listUsers->getResultBd();

            }else{
                $this->data['listUsers'] = [];
            }


            $loadView = new \Core\ConfigView("adms/Views/users/listUsers", $this->data);
            $loadView->loadView();
        }
    }


?>