<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
     * Controller da página editar configurações de e-mail
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class EditConfEmails
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


            if ((!empty($id)) and (empty($this->dataForm['SendEditConfEmail']))) {
                $this->id = (int) $id;
                $viewConfEmails = new \App\adms\Models\AdmsEditConfEmails();
                $viewConfEmails->viewConfEmails($this->id);

                if ($viewConfEmails->getResult()) {
                    $this->data['form'] = $viewConfEmails->getResultBd();
                    $this->viewEditConfEmail();

                } else {

                    $urlRedirect = URLADM . "list-conf-emails/index";
                    header("Location: $urlRedirect");
                }
            } else {
                $this->editConfEmail();
            }
        
        }
        private function viewEditConfEmail() :void
        {
        
            /*$button = [
                'list_sits_users' => ['menu_controller' => 'list-sits-users', 'menu_metodo' => 'index'],
                'edit_sits_users' => ['menu_controller' => 'edit-sits-users', 'menu_metodo' => 'index'],
                'delete_sits_users' => ['menu_controller' => 'delete-sits-users', 'menu_metodo' => 'index']];
    
                $listButton = new \App\adms\Models\helper\AdmsButton();
                $this->data['button'] = $listButton->buttonPermission($button);
                var_dump($this->data['button']);
    
                $this->data['sidebarActive'] = "list-sits-users";*/
    
    
            
            $loadView = new \Core\ConfigView("adms/Views/confEmails/editConfEmails", $this->data);
            $loadView->loadView();
        }


        private function editConfEmail(): void
        {

            if (!empty($this->dataForm['SendEditConfEmail'])) {
                unset($this->dataForm['SendEditConfEmail']);
                $editConfEmail = new \App\adms\Models\AdmsEditConfEmails();
                $editConfEmail->update($this->dataForm);

                if($editConfEmail->getResult()){
                    $urlRedirect = URLADM . "view-conf-emails/index/" . $this->dataForm['id'];
                    header("Location: $urlRedirect");
                }else{
                    $this->data['form'] = $this->dataForm;
                    $this->viewEditConfEmail();
                }
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: E-mail não encontrado!</p>";
                $urlRedirect = URLADM . "list-sits-users/index";
                header("Location: $urlRedirect");
            }
        }
    }


?>