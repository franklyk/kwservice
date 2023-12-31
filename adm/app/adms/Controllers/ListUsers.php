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
    class ListUsers
    
    {
        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data;

        /** @var string|int|null $page Recebe o número da página que o usuário está */
        private string|int|null $page;
        
        public function index(string|int|null $page = null)
        {

            $this->page = (int) $page ? $page : 1;

            $listUsers = new \App\adms\Models\AdmsListUsers();
            $listUsers->listUsers($this->page);

            if($listUsers->getResult()){

                $this->data['listUsers'] = $listUsers->getResultBd();
                $this->data['pagination'] = $listUsers->getResultPg();
                // var_dump($this->data['listUsers']);

            }else{
                $this->data['listUsers'] = [];
            }
            
            $this->data['sidebarActive'] = "list-users"; 

            $loadView = new \Core\ConfigView("adms/Views/users/listUsers", $this->data);
            $loadView->loadView();
        }
    }


?>