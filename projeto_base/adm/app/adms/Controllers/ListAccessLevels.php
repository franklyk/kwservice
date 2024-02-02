<?php 

    

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    

    /**
     * Página para Listar Níveis de Acesso
     */
    class ListAccessLevels
    
    {
        
        /** @var bool $result*/
        private bool $result;

        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data;

        /** @var string|int|null $page Recebe o número da página que o usuário está */
        private string|int|null $page;
  
        /** @var array $dataform Recebe os dados do Formulário */
        private array|null $dataForm;
        
        function getResult(): bool
        {
            return $this->result;
        }
        public function index(string|int|null $page = null)
        {
            $this->page = (int) $page ? $page : 1;
           
            $listAccess = new \App\adms\Models\AdmsListAccessLevels();
            $listAccess->listAccess($this->page);

            if($listAccess->getResult()){
                $this->data['listAccessLevels'] = $listAccess->getResultBd();
                $this->data['pagination'] = $listAccess->getResultPg();
            }else{
                $this->data['listAccessLevels'] = [];
            }
            
            $this->data['pag'] = $this->page;
            $this->data['sidebarActive'] = "list-access-levels";
        
            $button = [
                'add_access_levels' => ['menu_controller' => 'add-access-levels', 'menu_metodo' => 'index'],
                'sync_pages_levels' => ['menu_controller' => 'sync-pages-levels', 'menu_metodo' => 'index'],
                'order_access_levels' => ['menu_controller' => 'order-access-levels', 'menu_metodo' => 'index'],
                'list_permission' => ['menu_controller' => 'list-permission', 'menu_metodo' => 'index'],
                'view_access_levels' => ['menu_controller' => 'view-access-levels', 'menu_metodo' => 'index'],
                'edit_access_levels' => ['menu_controller' => 'edit-access-levels', 'menu_metodo' => 'index'],
                'delete_access_levels' => ['menu_controller' => 'delete-access-levels', 'menu_metodo' => 'index']];
    
                $listButton = new \App\adms\Models\helper\AdmsButton();
                $this->data['button'] = $listButton->buttonPermission($button);

                $countUsers = new \App\adms\Models\helper\AdmsMenu();
                $this->data['menu'] = $countUsers->itemMenu();
    
                $this->data['sidebarActive'] = "list-access-levels";
    
    

            $loadView = new \Core\ConfigView("adms/Views/accessLevels/listAcessLevels", $this->data);
            $loadView->loadView();
        }
    }


?>