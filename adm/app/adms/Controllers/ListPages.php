<?php 

    

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    

    /**
     * Página para Listar Páginas
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
        
            $button = [
                'add_pages' => ['menu_controller' => 'add-pages', 'menu_metodo' => 'index'],
                'sync_pages_levels' => ['menu_controller' => 'sync-pages-levels', 'menu_metodo' => 'index'],
                'list_pages' => ['menu_controller' => 'list-pages', 'menu_metodo' => 'index'],
                'edit_pages' => ['menu_controller' => 'edit-pages', 'menu_metodo' => 'index'],
                'delete_pages' => ['menu_controller' => 'delete-pages', 'menu_metodo' => 'index']];
    
                $listButton = new \App\adms\Models\helper\AdmsButton();
                $this->data['button'] = $listButton->buttonPermission($button);
    
                $this->data['sidebarActive'] = "list-pages";
    
    
            $loadView = new \Core\ConfigView("adms/Views/pages/listPages", $this->data);
            $loadView->loadView();
        }
    }


?>