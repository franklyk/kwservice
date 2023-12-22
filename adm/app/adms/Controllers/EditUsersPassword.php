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
    class EditUsersPassword
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
            
            if ((!empty($id)) and (empty($this->dataForm['SendEditUserPass']))) {
                $this->id = (int) $id;
                $viewUserPass = new \App\adms\Models\AdmsEditUsersPassword();
                $viewUserPass->viewUser($this->id);

                if($viewUserPass->getResult()){
                    
                    $this->data['form'] = $viewUserPass->getResultBd();
                    $this->viewEditUserPass();
                }else{
                    $urlRedirect = URLADM . "list-users/index";
                    header("Location: $urlRedirect");
                }
            } else {
                $this->editUserPass();
            }
        }
        private function viewEditUserPass() :void
        {
            $loadView = new \Core\ConfigView("adms/Views/users/editUserPass", $this->data);
            $loadView->loadView();
            
        }


        private function editUserPass(): void
        {

            if(!empty($this->dataForm['SendEditUserPass'])){
                unset($this->dataForm['SendEditUserPass']);
                $editUserPass = new \App\adms\Models\AdmsEditUsersPassword();
                $editUserPass->update($this->dataForm);
                if($editUserPass->getResult()){
                    $urlRedirect = URLADM . "view-users/index/" . $this->dataForm['id'];
                    header("Location: $urlRedirect");
                }else{
                    $this->data['form'] = $this->dataForm;
                    $this->viewEditUserPass();
                }
            } else{
                $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuário não encontrado!</p><br>";
                $urlRedirect = URLADM . "list-users/index";
                header("Location: $urlRedirect");
            }
        }
    }


?>