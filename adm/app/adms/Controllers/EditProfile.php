<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
     * Controller da página editar perfil
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class EditProfile
    {
        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data = [];
  
        /** @var array $dataform Recebe os dados do Formulário */
        private array|null $dataForm;

        /**
        * Instanciar a classe responsável em carregar a View e enviar os dados para a View
        *
        * @return void
        */
        public function index(): void
        {
            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            
            if (!empty($this->dataForm['SendEditProfile'])) {
                $this->editProfile();
            } else {
                
                $viewProfile = new \App\adms\Models\AdmsEditProfile();
                $viewProfile->viewProfile();
                if($viewProfile->getResult()){
                    $this->data['form'] = $viewProfile->getResultBd();
                    $this->viewEditProfile();
                }else{
                    $urlRedirect = URLADM . "login/index";
                    header("Location: $urlRedirect");
                }
            }
        }
        private function viewEditProfile() :void
        {
        
            $button = [
                'view_profile' => ['menu_controller' => 'view-profile', 'menu_metodo' => 'index']];
    
                $listButton = new \App\adms\Models\helper\AdmsButton();
                $this->data['button'] = $listButton->buttonPermission($button);
    
                $this->data['sidebarActive'] = "list-users";
    
    

            $loadView = new \Core\ConfigView("adms/Views/users/editProfile", $this->data);
            $loadView->loadView();
            
        }


        private function editProfile(): void
        {

            if(!empty($this->dataForm['SendEditProfile'])){
                unset($this->dataForm['SendEditProfile']);
                $editProfile = new \App\adms\Models\AdmsEditProfile();
                $editProfile->update($this->dataForm);
                if($editProfile->getResult()){
                    $urlRedirect = URLADM . "view-profile/index";
                    header("Location: $urlRedirect");
                }else{
                    $this->data['form'] = $this->dataForm;
                    $this->viewEditProfile();
                }
            } else{
                $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuário não encontrado!</p><br>";
                $urlRedirect = URLADM . "login/index";
                header("Location: $urlRedirect");
            }
        }
    }


?>