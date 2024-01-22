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
    class EditColors
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


            if ((!empty($id)) and (empty($this->dataForm['SendEditColor']))) {
                $this->id = (int) $id;
                $viewColor = new \App\adms\Models\AdmsEditColors();
                $viewColor->viewColor($this->id);

                if ($viewColor->getResult()) {
                    $this->data['form'] = $viewColor->getResultBd();
                    $this->viewEditColor();

                } else {
                    $urlRedirect = URLADM . "list-colors/index";
                    header("Location: $urlRedirect");
                }
            } else {
                $this->editColor();
            }
        
        }
        private function viewEditColor() :void
        {
        
            /*$button = [
                'list_sits_users' => ['menu_controller' => 'list-sits-users', 'menu_metodo' => 'index'],
                'edit_sits_users' => ['menu_controller' => 'edit-sits-users', 'menu_metodo' => 'index'],
                'delete_sits_users' => ['menu_controller' => 'delete-sits-users', 'menu_metodo' => 'index']];
    
                $listButton = new \App\adms\Models\helper\AdmsButton();
                $this->data['button'] = $listButton->buttonPermission($button);
                var_dump($this->data['button']);
    
                $this->data['sidebarActive'] = "list-sits-users";*/
    
    
            $loadView = new \Core\ConfigView("adms/Views/colors/editColors", $this->data);
            $loadView->loadView();
        }


        private function editColor(): void
        {

            if (!empty($this->dataForm['SendEditColor'])) {
                unset($this->dataForm['SendEditColor']);
                $editColor = new \App\adms\Models\AdmsEditColors();
                $editColor->update($this->dataForm);

                if($editColor->getResult()){
                    $urlRedirect = URLADM . "view-colors/index/" . $this->dataForm['id'];
                    header("Location: $urlRedirect");
                }else{
                    $this->data['form'] = $this->dataForm;
                    $this->viewEditColor();
                }
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Cor não encontrada!</p>";
                $urlRedirect = URLADM . "list-sits-users/index";
                header("Location: $urlRedirect");
            }
            
                
            
        }
    }


?>