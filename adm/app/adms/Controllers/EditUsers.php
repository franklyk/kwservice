<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
     * Controller da página editar usuário
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class EditUsers
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
            
            if ((!empty($id)) and (empty($this->dataForm['SendEditUser']))) {
                $this->id = (int) $id;
                $viewUser = new \App\adms\Models\AdmsEditUsers();
                $viewUser->viewUser($this->id);

                if($viewUser->getResult()){
                    
                    $this->data['form'] = $viewUser->getResultBd();
                    $this->viewEditUser();
                }else{
                    $urlRedirect = URLADM . "list-users/index";
                    header("Location: $urlRedirect");
                }
            } else {
                /*$_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuário não encontrado!</p><br>";
                $urlRedirect = URLADM . "list-users/index";
                header("Location: $urlRedirect");*/
                $this->editUser();
            }
        }
        private function viewEditUser() :void
        {
            $listSelect = new \App\adms\Models\AdmsEditUsers();
            $this->data['select'] = $listSelect->listSelect();
            
            $loadView = new \Core\ConfigView("adms/Views/users/editUser", $this->data);
            $loadView->loadView();
            
        }


        private function editUser(): void
        {

            if(!empty($this->dataForm['SendEditUser'])){
                unset($this->dataForm['SendEditUser']);
                $editUser = new \App\adms\Models\AdmsEditUsers();
                $editUser->update($this->dataForm);
                if($editUser->getResult()){
                    $urlRedirect = URLADM . "view-users/index/" . $this->dataForm['id'];
                    header("Location: $urlRedirect");
                }else{
                    $this->data['form'] = $this->dataForm;
                    $this->viewEditUser();
                }
            } else{
                $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuário não encontrado!</p><br>";
                $urlRedirect = URLADM . "list-users/index";
                header("Location: $urlRedirect");
            }
        }
    }


?>