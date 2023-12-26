<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
     * Controller da página editar situação 
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class EditSitsUsers
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


            if ((!empty($id)) and (empty($this->dataForm['SendEditSitUser']))) {
                $this->id = (int) $id;
                $viewSitUser = new \App\adms\Models\AdmsEditSitsUsers();
                $viewSitUser->viewSitUser($this->id);

                if ($viewSitUser->getResult()) {
                    $this->data['form'] = $viewSitUser->getResultBd();
                    $this->viewEditSitUser();

                } else {

                    $urlRedirect = URLADM . "list-sits-users/index";
                    header("Location: $urlRedirect");
                }
            } else {
                $this->editSitUser();
            }
        
        }
        private function viewEditSitUser() :void
        {
            $listSelect = new \App\adms\Models\AdmsEditSitsUsers();
            $this->data['select'] = $listSelect->listSelect();
            
            $loadView = new \Core\ConfigView("adms/Views/sitsUser/editSitsUsers", $this->data);
            $loadView->loadView();
        }


        private function editSitUser(): void
        {

            if (!empty($this->dataForm['SendEditSitUser'])) {
                unset($this->dataForm['SendEditSitUser']);
                $editSitUser = new \App\adms\Models\AdmsEditSitsUsers();
                $editSitUser->update($this->dataForm);

                if($editSitUser->getResult()){
                    $urlRedirect = URLADM . "view-sits-users/index/" . $this->dataForm['id'];
                    header("Location: $urlRedirect");
                }else{
                    $this->data['form'] = $this->dataForm;
                    $this->viewEditSitUser();
                }
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Situação não encontrada!</p>";
                $urlRedirect = URLADM . "list-sits-users/index";
                header("Location: $urlRedirect");
            }
            
                
            
        }
    }


?>