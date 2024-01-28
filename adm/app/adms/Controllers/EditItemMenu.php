<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
     * Controller da página editar cores 
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class EditItemMenu
    {
        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data = [];
  
        /** @var array $dataform Recebe os dados do Formulário */
        private array|null $dataForm;

        /** @var array|string|null $id Recebe o id do registro */
        private int|string|null $id;

        /**
        * Instanciar a classe responsável em carregar a View e enviar os dados para a View
        *
        * @return void
        */
        public function index(int|string|null $id = null): void
        {
            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);


            if ((!empty($id)) and (empty($this->dataForm['SendEditItemMenu']))) {
                $this->id = (int) $id;
                $viewItemMenu = new \App\adms\Models\AdmsEditItemMenu();
                $viewItemMenu->viewItemMenu($this->id);

                if ($viewItemMenu->getResult()) {
                    $this->data['form'] = $viewItemMenu->getResultBd();
                    $this->viewEditItemMenu();

                } else {
                    $urlRedirect = URLADM . "list-item-menu/index";
                    header("Location: $urlRedirect");
                }
            } else {
                $this->editItemMenu();
            }
        
        }
        private function viewEditItemMenu() :void
        {
        
            $button = [
                'list_item_menu' => ['menu_controller' => 'list-item-menu', 'menu_metodo' => 'index'],
                'view_item_menu' => ['menu_controller' => 'view-item-menu', 'menu_metodo' => 'index']];
    
                $listButton = new \App\adms\Models\helper\AdmsButton();
                $this->data['button'] = $listButton->buttonPermission($button);

                $countItems = new \App\adms\Models\helper\AdmsMenu();
                $this->data['menu'] = $countItems->itemMenu();
    
            $this->data['sidebarActive'] = "list-item-menu";
    
    
            $loadView = new \Core\ConfigView("adms/Views/itemMenu/editItemMenu", $this->data);
            $loadView->loadView();
        }


        private function editItemMenu(): void
        {

            if (!empty($this->dataForm['SendEditItemMenu'])) {
                unset($this->dataForm['SendEditItemMenu']);
                $editColor = new \App\adms\Models\AdmsEditItemMenu();
                $editColor->update($this->dataForm);

                if($editColor->getResult()){
                    $urlRedirect = URLADM . "view-item-menu/index/" . $this->dataForm['id'];
                    header("Location: $urlRedirect");
                }else{
                    $this->data['form'] = $this->dataForm;
                    $this->viewEditItemMenu();
                }
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Configuração não encontrada!</p>";
                $urlRedirect = URLADM . "list-sits-users/index";
                header("Location: $urlRedirect");
            }
            
                
            
        }
    }


?>