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
    class AddUsers
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
            if(!empty($this->dataForm["SendAddUser"])){
                // var_dump($this->dataForm);
                //Destroi a posiçao do botao submit
                unset($this->dataForm["SendAddUser"]);

                //Envia os dados do formulário para a AdmsnewUser
                $createUser = new \App\adms\Models\AdmsAddUsers();
                $createUser->create($this->dataForm);

                //Recebe os dados que vêm da AdmsLogin
                if($createUser->getResult()){
                    $urlRedirect = URLADM . "list-users/index";
                    header("Location: $urlRedirect");
                }else{
                    // Mantém os dados no formulário se não for redirecinado
                    $this->data['form'] = $this->dataForm;
                    $this->viewAddUser();
                }
            }else{
                //Carrega a view
                $this->viewAddUser();
            }
        }
        private function viewAddUser() :void
        {
        
            $button = [
                'list_users' => ['menu_controller' => 'list-users', 'menu_metodo' => 'index']];
    
                $listButton = new \App\adms\Models\helper\AdmsButton();
                $this->data['button'] = $listButton->buttonPermission($button);

                $countUsers = new \App\adms\Models\helper\AdmsMenu();
                $this->data['menu'] = $countUsers->itemMenu();
    
                $this->data['sidebarActive'] = "list-users";
    
    
            $listSelect = new \App\adms\Models\AdmsAddUsers();
            $this->data['select'] = $listSelect->listSelect();
            
            $loadView = new \Core\ConfigView("adms/Views/users/addUser", $this->data);
            $loadView->loadView();
            
        }
    }


?>