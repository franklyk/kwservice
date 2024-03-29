<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
     * Controller da página editar imagem do usuário
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class EditUsersImage
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
            
            if ((!empty($id)) and (empty($this->dataForm['SendEditUserImage']))) {
                $this->id = (int) $id;
                $viewUser = new \App\adms\Models\AdmsEditUsersImage();
                $viewUser->viewUser($this->id);

                if($viewUser->getResult()){
                    
                    $this->data['form'] = $viewUser->getResultBd();
                    $this->viewEditUserImage();
                }else{
                    $urlRedirect = URLADM . "list-users/index";
                    header("Location: $urlRedirect");
                }
            } else {
                $this->editUserImage();
            }
        }
        private function viewEditUserImage() :void
        {
        
            $button = [
                'list_users' => ['menu_controller' => 'list-users', 'menu_metodo' => 'index'],
                'view_users' => ['menu_controller' => 'view-users', 'menu_metodo' => 'index']];
    
                $listButton = new \App\adms\Models\helper\AdmsButton();
                $this->data['button'] = $listButton->buttonPermission($button);

                $countUsers = new \App\adms\Models\helper\AdmsMenu();
                $this->data['menu'] = $countUsers->itemMenu();
    
                $this->data['sidebarActive'] = "list-users";
    
    
            $loadView = new \Core\ConfigView("adms/Views/users/editUserImage", $this->data);
            $loadView->loadView();
            
        }


        private function editUserImage(): void
        {

            if(!empty($this->dataForm['SendEditUserImage'])){
                unset($this->dataForm['SendEditUserImage']);

                $this->dataForm['new_image'] = $_FILES['new_image'] ? $_FILES['new_image'] : null ;

                $editUserImage = new \App\adms\Models\AdmsEditUsersImage();
                $editUserImage->update($this->dataForm);
                if($editUserImage->getResult()){
                    $urlRedirect = URLADM . "view-users/index/" . $this->dataForm['id'];
                    header("Location: $urlRedirect");
                }else{
                    $this->data['form'] = $this->dataForm;
                    $this->viewEditUserImage();
                }
            } else{
                $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuário não encontrado!</p><br>";
                $urlRedirect = URLADM . "list-users/index";
                header("Location: $urlRedirect");
            }
        }
    }


?>