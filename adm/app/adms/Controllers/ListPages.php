<?php 

    

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    

    /**
     * Página para listar páginas
     */
    class ListPages
    
    {
        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data;

        /** @var string|int|null $page Recebe o número da página em que o usuário está */
        private string|int|null $page;
        
        public function index(string|int|null $page = null)
        {
            $this->page = (int) $page ? $page : 1;
            $listPages = new \App\adms\Models\AdmsListPages();
            $listPages->listPages($this->page);
            if($listPages->getResult()){
                $this->data['listPages'] = $listPages->getResultBd();
                $this->data['pagination'] = $listPages->getResultPg();
            }else{
                $this->data['listPages'] = [];
            }
            $this->data['sidebarActive'] = 'list-pages';
            $loadView = new \Core\ConfigView("adms/Views/pages/listPages", $this->data);
            $loadView->loadView();
        }
    }


?>