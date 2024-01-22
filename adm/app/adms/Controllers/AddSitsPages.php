<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
     * Controller da página cadastrar nova situação de página
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class AddSitsPages
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
            if(!empty($this->dataForm["SendAddSitPages"])){
                // var_dump($this->dataForm);
                //Destroi a posiçao do botao submit
                unset($this->dataForm["SendAddSitPages"]);
                // var_dump($this->dataForm);


                //Envia os dados do formulário para a AdmsnewUser
                $createSitPages = new \App\adms\Models\AdmsAddSitsPages();
                $createSitPages->create($this->dataForm);

                //Recebe os dados que vêm da AdmsLogin
                if($createSitPages->getResult()){
                    $urlRedirect = URLADM . "list_sits-pages/index";
                    header("Location: $urlRedirect");
                }else{
                    // Mantém os dados no formulário se não for redirecinado
                    $this->data['form'] = $this->dataForm;
                    $this->viewAddSitPages();
                }
            }else{
                //Carrega a view
                $this->viewAddSitPages();
            }
        }
        private function viewAddSitPages() :void
        {
        
            /*$button = [
                'list_sits_users' => ['menu_controller' => 'list-sits-users', 'menu_metodo' => 'index'],
                'edit_sits_users' => ['menu_controller' => 'edit-sits-users', 'menu_metodo' => 'index'],
                'delete_sits_users' => ['menu_controller' => 'delete-sits-users', 'menu_metodo' => 'index']];
    
                $listButton = new \App\adms\Models\helper\AdmsButton();
                $this->data['button'] = $listButton->buttonPermission($button);
                var_dump($this->data['button']);
    
                $this->data['sidebarActive'] = "list-sits-users";*/
    
    
            $listSelect = new \App\adms\Models\AdmsAddSitsPages();
            $this->data['select'] = $listSelect->listSelect();
            
            $loadView = new \Core\ConfigView("adms/Views/sitsPages/addSitsPages", $this->data);
            $loadView->loadView();
            
        }
    }


?>