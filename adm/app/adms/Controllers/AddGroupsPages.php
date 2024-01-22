<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
     * Controller da página cadastrar grupos de páginas
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class AddGroupsPages
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
            if(!empty($this->dataForm["SendAddGroupPages"])){
                // var_dump($this->dataForm);
                //Destroi a posiçao do botao submit
                unset($this->dataForm["SendAddGroupPages"]);


                //Envia os dados do formulário para a AdmsnewUser
                $createGroupPages = new \App\adms\Models\AdmsAddGroupsPages();
                $createGroupPages->create($this->dataForm);

                //Recebe os dados que vêm da AdmsLogin
                if($createGroupPages->getResult()){
                    $urlRedirect = URLADM . "list-groups-pages/index";
                    header("Location: $urlRedirect");
                }else{
                    // Mantém os dados no formulário se não for redirecinado
                    $this->data['form'] = $this->dataForm;
                    var_dump($this->data['form']);
                    $this->viewAddGroupsPages();
                }
            }else{
                //Carrega a view
                $this->viewAddGroupsPages();
            }
        }
        private function viewAddGroupsPages() :void
        {
        
            /*$button = [
                'list_sits_users' => ['menu_controller' => 'list-sits-users', 'menu_metodo' => 'index'],
                'edit_sits_users' => ['menu_controller' => 'edit-sits-users', 'menu_metodo' => 'index'],
                'delete_sits_users' => ['menu_controller' => 'delete-sits-users', 'menu_metodo' => 'index']];
    
                $listButton = new \App\adms\Models\helper\AdmsButton();
                $this->data['button'] = $listButton->buttonPermission($button);
                var_dump($this->data['button']);
    
                $this->data['sidebarActive'] = "list-sits-users";*/
    
    
            $loadView = new \Core\ConfigView("adms/Views/groupsPages/addGroupsPages", $this->data);
            $loadView->loadView();
            
        }
    }


?>