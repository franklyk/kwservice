<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
     * Controller da página editar tipos de páginas 
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class EditTypesPages
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


            if ((!empty($id)) and (empty($this->dataForm['SendEditType']))) {
                $this->id = (int) $id;
                $viewTypesPages = new \App\adms\Models\AdmsEditTypesPages();
                $viewTypesPages->viewTypesPages($this->id);

                if ($viewTypesPages->getResult()) {
                    $this->data['form'] = $viewTypesPages->getResultBd();
                    $this->viewEditTypesPages();

                } else {
                    $urlRedirect = URLADM . "list-types-pages/index";
                    header("Location: $urlRedirect");
                }
            } else {
                $this->editTypesPages();
            }
        
        }
        private function viewEditTypesPages() :void
        {
        
            $button = [
                'list_types_pages' => ['menu_controller' => 'list-types-pages', 'menu_metodo' => 'index'],
                'view_types_pages' => ['menu_controller' => 'view-types-pages', 'menu_metodo' => 'index']];
    
                $listButton = new \App\adms\Models\helper\AdmsButton();
                $this->data['button'] = $listButton->buttonPermission($button);

                $countUsers = new \App\adms\Models\helper\AdmsMenu();
                $this->data['menu'] = $countUsers->itemMenu();
    
                $this->data['sidebarActive'] = "list-types-pages";
    
    
            $this->data['sidebarActive'] = "list-types-pages";

            $loadView = new \Core\ConfigView("adms/Views/typesPages/editTypesPages", $this->data);
            $loadView->loadView();
        }


        private function editTypesPages(): void
        {

            if (!empty($this->dataForm['SendEditGroup'])) {
                unset($this->dataForm['SendEditGroup']);
                $editGroupPages = new \App\adms\Models\AdmsEditGroupsPages();
                $editGroupPages->update($this->dataForm);

                if($editGroupPages->getResult()){
                    $urlRedirect = URLADM . "view-groups-pages/index/" . $this->dataForm['id'];
                    header("Location: $urlRedirect");
                }else{
                    $this->data['form'] = $this->dataForm;
                    $this->viewEditTypesPages();
                }
            } else {
                $_SESSION['msg'] = "<p class'alert-danger'>Erro: Grupo de páginas não encontrada!</p>";
                $urlRedirect = URLADM . "list-groups-pages/index";
                header("Location: $urlRedirect");
            }
            
                
            
        }
    }


?>