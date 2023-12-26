<?php 

    

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    

    /**
     * Página para listar usuários
     */
    class ListSitsUsers
    
    {
        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data;
        
        public function index()
        {
            
            $listSitsUsers = new \App\adms\Models\AdmsListSitsUsers();
            $listSitsUsers->listSitsUsers();

            if($listSitsUsers->getResult()){

                $this->data['listSitsUsers'] = $listSitsUsers->getResultBd();


            }else{
                $this->data['listSitsUsers'] = [];
                
            }

            $loadView = new \Core\ConfigView("adms/Views/sitsUser/listSitsUsers", $this->data);
            $loadView->loadView();
        }
    }


?>