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
    class ListColors
    
    {
        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data;

        /** @var string|int|null $page Recebe o número da página que o usuário está */
        private string|int|null $page;
        
        public function index(string|int|null $page = null)
        {
            $this->page = (int) $page ? $page : 1;
            // var_dump($this->page);
            
            $listColors = new \App\adms\Models\AdmsListColors();
            $listColors->listColors($this->page);

            if($listColors->getResult()){

                $this->data['listColors'] = $listColors->getResultBd();
                $this->data['pagination'] = $listColors->getResultPg();
                // var_dump($this->data['pagination']);

            }else{
                $this->data['listColors'] = [];
            }

            $this->data['sidebarActive'] = 'list-colors';
        
            $button = [
                'add_colors' => ['menu_controller' => 'add-colors', 'menu_metodo' => 'index'],
                'view_colors' => ['menu_controller' => 'view-colors', 'menu_metodo' => 'index'],
                'edit_colors' => ['menu_controller' => 'edit-colors', 'menu_metodo' => 'index'],
                'delete_colors' => ['menu_controller' => 'delete-colors', 'menu_metodo' => 'index']];
    
                $listButton = new \App\adms\Models\helper\AdmsButton();
                $this->data['button'] = $listButton->buttonPermission($button);
    
                $this->data['sidebarActive'] = "list-colors";
    
    

            // var_dump($this->data);

            $loadView = new \Core\ConfigView("adms/Views/colors/listColors", $this->data);
            $loadView->loadView();
        }
    }


?>