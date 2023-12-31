<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
     * Controller da página editar senha do usuário
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class EditConfEmailsPassword
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
            
            if ((!empty($id)) and (empty($this->dataForm['SendEditConfEmailsPass']))) {
                $this->id = (int) $id;
                $viewConfEmailsPass = new \App\adms\Models\AdmsEditConfEmailsPassword();
                $viewConfEmailsPass->viewConfEmailsPassword($this->id);

                if($viewConfEmailsPass->getResult()){
                    
                    $this->data['form'] = $viewConfEmailsPass->getResultBd();
                    $this->viewEditConfEmailsPass();
                }else{
                    $urlRedirect = URLADM . "list-conf-emails/index";
                    header("Location: $urlRedirect");
                }
            } else {
                $this->editConfEmailsPassword();
            }
        }
        private function viewEditConfEmailsPass() :void
        {
            $loadView = new \Core\ConfigView("adms/Views/confEmails/editConfEmailPass", $this->data);
            $loadView->loadView();
            
        }


        private function editConfEmailsPassword(): void
        {

            if(!empty($this->dataForm['SendEditConfEmailsPass'])){
                unset($this->dataForm['SendEditConfEmailsPass']);
                $editUserPass = new \App\adms\Models\AdmsEditConfEmailsPassword();
                $editUserPass->update($this->dataForm);
                if($editUserPass->getResult()){
                    $urlRedirect = URLADM . "view-conf-emails/index/" . $this->dataForm['id'];
                    header("Location: $urlRedirect");
                }else{
                    $this->data['form'] = $this->dataForm;
                    $this->viewEditConfEmailsPass();
                }
            } else{
                $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Configuração não encontrada!</p><br>";
                $urlRedirect = URLADM . "list-conf-emails/index";
                header("Location: $urlRedirect");
            }
        }
    }


?>