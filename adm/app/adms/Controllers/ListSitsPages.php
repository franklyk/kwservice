<?php 

    

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    

    /**
     * Página para Listar Situações de Páginas
     */
    class ListSitsPages
    
    {
        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data;

        /** @var string|int|null $page Recebe o número da página que o usuário está */
        private string|int|null $page;
        
        public function index(string|int|null $page = null)
        {
            $this->page = (int) $page ? $page : 1;
            // var_dump($this->page);
            
            $listSitsPages = new \App\adms\Models\AdmsListSitsPages();
            $listSitsPages->listSitsPages($this->page);

            if($listSitsPages->getResult()){

                $this->data['listSitsPages'] = $listSitsPages->getResultBd();
                $this->data['pagination'] = $listSitsPages->getResultPg();
                // var_dump($this->data['pagination']);

            }else{
                $this->data['listSitsPages'] = [];
            }


            // var_dump($this->data);
        
            $button = [
                'add_sits_pages' => ['menu_controller' => 'add-sits-pages', 'menu_metodo' => 'index'],
                'view_sits_pages' => ['menu_controller' => 'view-sits-pages', 'menu_metodo' => 'index'],
                'edit_sits_pages' => ['menu_controller' => 'edit-sits-pages', 'menu_metodo' => 'index'],
                'delete_sits_pages' => ['menu_controller' => 'delete-sits-pages', 'menu_metodo' => 'index']];

                $listButton = new \App\adms\Models\helper\AdmsButton();
                $this->data['button'] = $listButton->buttonPermission($button);

                $countUsers = new \App\adms\Models\helper\AdmsMenu();
                $this->data['menu'] = $countUsers->itemMenu();

                $this->data['sidebarActive'] =  'list-sits-pages';


            $loadView = new \Core\ConfigView("adms/Views/sitsPages/listSitsPages", $this->data);
            $loadView->loadView();
        }
    }


?>