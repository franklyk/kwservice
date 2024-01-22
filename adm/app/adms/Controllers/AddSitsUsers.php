<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
     * Controller da página cadastrar novo usuário
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class AddSitsUsers
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
            
            //Recebe os dados que vêm do formulário
            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            //verifica se o butão submit foi clicado
            if(!empty($this->dataForm["SendAddSitUser"])){
                // var_dump($this->dataForm);
                //Destroi a posiçao do botao submit
                unset($this->dataForm["SendAddSitUser"]);
                // var_dump($this->dataForm);


                //Envia os dados do formulário para a AdmsnewUser
                $createSitUser = new \App\adms\Models\AdmsAddSitsUsers();
                $createSitUser->create($this->dataForm);

                //Recebe os dados que vêm da AdmsLogin
                if($createSitUser->getResult()){
                    $urlRedirect = URLADM . "list_sits-users/index";
                    header("Location: $urlRedirect");
                }else{
                    // Mantém os dados no formulário se não for redirecinado
                    $this->data['form'] = $this->dataForm;
                    $this->viewAddSitUser();
                }
            }else{
                //Carrega a view
                $this->viewAddSitUser();
            }
        }
        private function viewAddSitUser() :void
        {
        
            /*$button = [
                'list_sits_users' => ['menu_controller' => 'list-sits-users', 'menu_metodo' => 'index'],
                'edit_sits_users' => ['menu_controller' => 'edit-sits-users', 'menu_metodo' => 'index'],
                'delete_sits_users' => ['menu_controller' => 'delete-sits-users', 'menu_metodo' => 'index']];
    
                $listButton = new \App\adms\Models\helper\AdmsButton();
                $this->data['button'] = $listButton->buttonPermission($button);
                var_dump($this->data['button']);
    
                $this->data['sidebarActive'] = "list-sits-users";*/
    
    
            $listSelect = new \App\adms\Models\AdmsAddSitsUsers();
            $this->data['select'] = $listSelect->listSelect();
            
            $loadView = new \Core\ConfigView("adms/Views/sitsUser/addSitsUser", $this->data);
            $loadView->loadView();
            
        }
    }


?>