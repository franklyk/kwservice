<?php 

    

    namespace App\cpms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    

    /**
     * Página exemplo pacote complementar 
     */
    class ListExemple
    {
        

        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data;
        
        public function index()
        {
            $viewExemple = new \App\cpms\Models\CpmsListExemplo();
            $viewExemple->listExemplo();

            
            $listMenu = new \App\adms\Models\helper\AdmsMenu();
            $this->data['menu'] = $listMenu->itemMenu();

            // var_dump($this->data['menu']);
            
            $this->data['sidebarActive'] = "list-exemple"; 

            $loadView = new \Core\ConfigView("cpms/Views/exemple/listExemple", $this->data);
            $loadView->loadView();
        }
    }


?>