<?php 

    

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    

    /**
     * Página para Listar Tipos de Páginas
     */
    class ListTypesPages
    
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
            
            $listTypesPages = new \App\adms\Models\AdmsListTypesPages();
            $listTypesPages->listTypesPages($this->page);

            if($listTypesPages->getResult()){
    
                $this->data['listTypesPages'] = $listTypesPages->getResultBd();
                $this->data['pagination'] = $listTypesPages->getResultPg();
                
            }else{
                
            }

            $button = [
                'order_types_pages' => ['menu_controller' => 'order-types-pages', 'menu_metodo' => 'index'],
                'view_types_pages' => ['menu_controller' => 'view-types-pages', 'menu_metodo' => 'index'],
                'edit_types_pages' => ['menu_controller' => 'edit-types-pages', 'menu_metodo' => 'index'],
                'delete_types_pages' => ['menu_controller' => 'delete-types-pages', 'menu_metodo' => 'index']];
    
            $listButton = new \App\adms\Models\helper\AdmsButton();
            $this->data['button'] = $listButton->buttonPermission($button);

                
                
            $this->data['pag'] = $this->page;
            $this->data['sidebarActive'] = "list-types-pages"; 


            $loadView = new \Core\ConfigView("adms/Views/typesPages/listTypesPages", $this->data);
            $loadView->loadView();
        }
    }


?>