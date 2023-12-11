<?php 

    namespace App\adms\Controllers;
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
            if (!empty($id)) {
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
                $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuário não encontrado!</p><br>";
    
                $urlRedirect = URLADM . "list-users/index";
                header("Location: $urlRedirect");
            }
        }
        private function viewEditUser() :void
        {
            $loadView = new \Core\ConfigView("adms/Views/users/editUser", $this->data);
            $loadView->loadView();
            
        }
    }


?>