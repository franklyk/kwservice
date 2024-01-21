<?php 

    

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    

    /**
     * Página para Listar Situações do Usuário
     */
    class ListSitsUsers
    
    {
        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data;

        /** @var string|int|null $page Recebe o número da página que o usuário está */
        private string|int|null $page;
        
        public function index(string|int|null $page = null)
        {
            $this->page = (int) $page ? $page : 1;
            // var_dump($this->page);
            
            $listSitsUsers = new \App\adms\Models\AdmsListSitsUsers();
            $listSitsUsers->listSitsUsers($this->page);

            if($listSitsUsers->getResult()){

                $this->data['listSitsUsers'] = $listSitsUsers->getResultBd();
                $this->data['pagination'] = $listSitsUsers->getResultPg();
                // var_dump($this->data['pagination']);

            }else{
                $this->data['listSitsUsers'] = [];
            }

            $this->data['sidebarActive'] =  'list-sits-users';

            $this->data['sidebarButton'] =  'list-sits-users';
            // var_dump($this->data);

            $loadView = new \Core\ConfigView("adms/Views/sitsUser/listSitsUsers", $this->data);
            $loadView->loadView();
        }
    }


?>