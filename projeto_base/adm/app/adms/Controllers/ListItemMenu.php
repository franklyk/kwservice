<?php 

    

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    

    /**
     * Página para Listar Cores
     */
    class ListItemMenu
    
    {
        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data;

        /** @var string|int|null $page Recebe o número da página que o usuário está */
        private string|int|null $page;
        
        public function index(string|int|null $page = null)
        {
            $this->page = (int) $page ? $page : 1;
            // var_dump($this->page);
            
            $listItemMenu = new \App\adms\Models\AdmsListItemMenu();
            $listItemMenu->listItemMenu($this->page);

            if($listItemMenu->getResult()){

                $this->data['pag'] = $this->page;
                $this->data['listItemMenu'] = $listItemMenu->getResultBd();
                $this->data['pagination'] = $listItemMenu->getResultPg();
                // var_dump($this->data['pagination']);

            }else{
                $this->data['listItemMenu'] = [];
            }

            $this->data['sidebarActive'] = 'list-colors';
        
            $button = [
                'order_item_menu' => ['menu_controller' => 'order-item-menu', 'menu_metodo' => 'index'],
                'add_item_menu' => ['menu_controller' => 'add-item-menu', 'menu_metodo' => 'index'],
                'view_item_menu' => ['menu_controller' => 'view-item-menu', 'menu_metodo' => 'index'],
                'edit_item_menu' => ['menu_controller' => 'edit-item-menu', 'menu_metodo' => 'index'],
                'delete_item_menu' => ['menu_controller' => 'delete-item-menu', 'menu_metodo' => 'index']];
    
                $listButton = new \App\adms\Models\helper\AdmsButton();
                $this->data['button'] = $listButton->buttonPermission($button);
                // var_dump($this->data['button']);

                $countUsers = new \App\adms\Models\helper\AdmsMenu();
                $this->data['menu'] = $countUsers->itemMenu();
    
                $this->data['sidebarActive'] = "list-item-menu";
    
    

            // var_dump($this->data);

            $loadView = new \Core\ConfigView("adms/Views/itemMenu/listItemMenu", $this->data);
            $loadView->loadView();
        }
    }


?>