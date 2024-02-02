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
    class EditLevelsForms
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
        public function index(): void
        {
            
            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (empty($this->dataForm['SendEditLevels'])) {
                $viewLevelsForms = new \App\adms\Models\AdmsEditLevelsForms();
                $viewLevelsForms->viewLevelsForms();
                if ($viewLevelsForms->getResult()) {
                    $this->data['form'] = $viewLevelsForms->getResultBd();
                    $this->viewEditLevelsForm();
                } else {
                    $urlRedirect = URLADM . "dashboard/index";
                    header("Location: $urlRedirect");
                }
            } else {
                $this->editLevelsForms();
            }
        
        }
        private function viewEditLevelsForm() :void
        {
        
            $button = [
                'view_levels_forms' => ['menu_controller' => 'view-levels-forms', 'menu_metodo' => 'index']];
    
            $listButton = new \App\adms\Models\helper\AdmsButton();
            $this->data['button'] = $listButton->buttonPermission($button);
            // var_dump($this->data['button']);

            $listMenu = new \App\adms\Models\helper\AdmsMenu();
            $this->data['menu'] = $listMenu->itemMenu();
    
            
            $listSelect = new \App\adms\Models\AdmsEditLevelsForms();
            $this->data['select'] = $listSelect->listSelect();
            // var_dump($this->data['select']);
                
            $this->data['sidebarActive'] = "view-levels-forms";

            $loadView = new \Core\ConfigView("adms/Views/levelsForms/editLevelsForms", $this->data);
            $loadView->loadView();
        }


        private function editLevelsForms(): void
        {

            if (!empty($this->dataForm['SendEditLevels'])) {
                unset($this->dataForm['SendEditLevels']);
                $editLevelsForms = new \App\adms\Models\AdmsEditLevelsForms();
                $editLevelsForms->update($this->dataForm);
                var_dump($editLevelsForms);

                if($editLevelsForms->getResult()){
                    $urlRedirect = URLADM . "view-levels-forms/index/" . $this->dataForm['id'];
                    header("Location: $urlRedirect");
                }else{
                    $this->data['form'] = $this->dataForm;
                    var_dump($this->data['form']);
                    $this->viewEditLevelsForm();
                }
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Página de configuração não encontrada!</p>";
                $urlRedirect = URLADM . "dashboard/index";
                header("Location: $urlRedirect");
            }
            
                
            
        }
    }


?>