<?php 

    

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    

    /**
     * Página para Listar Permissões
     * 
     * @author Franklin <frsbatist@gmail.com>
     */
    class ListPermission
    
    {
        
        /** @var bool $result*/
        private bool $result;

        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data;

        /** @var string|int|null $page Recebe o número da página que o usuário está */
        private string|int|null $page;

        /** @var string|int|null $level Recebe o id do nível de acesso*/
        private string|int|null $level;
  
        /** @var array $dataform Recebe os dados do Formulário */
        private array|null $dataForm;
        
        function getResult(): bool
        {
            return $this->result;
            
        }
        public function index(string|int|null $page = null)
        {
            $this->level = filter_input(INPUT_GET, 'level', FILTER_SANITIZE_NUMBER_INT);
            
            $this->page = (int) $page ? $page : 1;

            $listPermission = new \App\adms\Models\AdmsListPermission();
            $listPermission->listPermission($this->page, $this->level);

            if($listPermission->getResult()){

                $this->data['listPermission'] = $listPermission->getResultBd();
                $this->data['viewAccessLevels'] = $listPermission->getResultBdLevel();
                $this->data['pagination'] = $listPermission->getResultPg();
                $this->data['pag'] = $this->page;
                $this->viewPermission();

            }else{
                $urlRedirect = URLADM . "list-access-levels/index";
                header("Location: $urlRedirect");

            }
        }

        private function viewPermission(): void
        {
            $this->data['sidebarActive'] = "list-access-levels";
        
            $button = [
                'list_access_levels' => ['menu_controller' => 'list-access-levels', 'menu_metodo' => 'index'],
                'order_page_menu' => ['menu_controller' => 'order-page-menu', 'menu_metodo' => 'index'],
                'edit_page_menu' => ['menu_controller' => 'edit-page-menu', 'menu_metodo' => 'index']];
    
                $listButton = new \App\adms\Models\helper\AdmsButton();
                $this->data['button'] = $listButton->buttonPermission($button);
                // var_dump($this->data['button']);

                $countUsers = new \App\adms\Models\helper\AdmsMenu();
                $this->data['menu'] = $countUsers->itemMenu();
    
                $this->data['sidebarActive'] = "list-access-levels";
    
    

            $loadView = new \Core\ConfigView("adms/Views/permission/listPermission", $this->data);
            $loadView->loadView();
        }
    }


?>