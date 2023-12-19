<?php 

    namespace App\adms\Controllers;
    /**
     * Controller da página editar perfil
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class EditProfilePassword
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
            
            if (!empty($this->dataForm['SendEditProfPass'])) {
                $this->editProfPass();
            } else {
                
                $viewProfilePass = new \App\adms\Models\AdmsEditProfilePassword();
                $viewProfilePass->viewProfile();
                if($viewProfilePass->getResult()){
                    $this->data['form'] = $viewProfilePass->getResultBd();
                    $this->viewEditProfPass();
                }else{
                    $urlRedirect = URLADM . "login/index";
                    header("Location: $urlRedirect");
                }
            }
        }
        private function viewEditProfPass() :void
        {

            $loadView = new \Core\ConfigView("adms/Views/users/editProfilePassword", $this->data);
            $loadView->loadView();
            
        }


        private function editProfPass(): void
        {

            if(!empty($this->dataForm['SendEditProfPass'])){
                unset($this->dataForm['SendEditProfPass']);
                $editProfPass = new \App\adms\Models\AdmsEditProfilePassword();
                $editProfPass->update($this->dataForm);
                if($editProfPass->getResult()){
                    $urlRedirect = URLADM . "view-profile/index";
                    header("Location: $urlRedirect");
                }else{
                    $this->data['form'] = $this->dataForm;
                    $this->viewEditProfPass();
                }
            } else{
                $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuário não encontrado!</p><br>";
                $urlRedirect = URLADM . "login/index";
                header("Location: $urlRedirect");
            }
        }
    }


?>