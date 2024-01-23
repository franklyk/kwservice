<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
     * Controller da página editar nível de acesso
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class EditAccessLevels
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


            if ((!empty($id)) and (empty($this->dataForm['SendEditAccess']))) {
                $this->id = (int) $id;
                $viewAccess = new \App\adms\Models\AdmsEditAccessLevels();
                $viewAccess->viewAccess($this->id);

                if ($viewAccess->getResult()) {
                    $this->data['form'] = $viewAccess->getResultBd();
                    $this->viewEditAcsess();

                } else {
                    $urlRedirect = URLADM . "list-access-levels/index";
                    header("Location: $urlRedirect");
                }
            } else {
                $this->editAccess();
            }
        
        }
        private function viewEditAcsess() :void
        {
        
            $button = [
                'list_access_levels' => ['menu_controller' => 'list-access-levels', 'menu_metodo' => 'index'],
                'view_access_levels' => ['menu_controller' => 'view-access-levels', 'menu_metodo' => 'index']];
    
                $listButton = new \App\adms\Models\helper\AdmsButton();
                $this->data['button'] = $listButton->buttonPermission($button);

                $countUsers = new \App\adms\Models\helper\AdmsMenu();
                $this->data['menu'] = $countUsers->itemMenu();
    
                $this->data['sidebarActive'] = "list-access-levels";
    
    
            $loadView = new \Core\ConfigView("adms/Views/accessLevels/editAccessLevels", $this->data);
            $loadView->loadView();
        }


        private function editAccess(): void
        {

            if (!empty($this->dataForm['SendEditAccess'])) {
                unset($this->dataForm['SendEditAccess']);
                $editAccess = new \App\adms\Models\AdmsEditAccessLevels();
                $editAccess->update($this->dataForm);

                if($editAccess->getResult()){
                    $urlRedirect = URLADM . "view-access-levels/index/" . $this->dataForm['id'];
                    header("Location: $urlRedirect");
                }else{
                    $this->data['form'] = $this->dataForm;
                    $this->viewEditAcsess();
                }
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Nível de acesso não encontrado!</p>";
                $urlRedirect = URLADM . "list-access-levels/index";
                header("Location: $urlRedirect");
            }
            
                
            
        }
    }


?>