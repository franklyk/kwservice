<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
     * Controller da página cadastrar Nível de Acesso
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class AddItemMenu
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
            if(!empty($this->dataForm["SendAddItemMenu"])){
                //Destroi a posiçao do botao submit
                unset($this->dataForm["SendAddItemMenu"]);
                //Envia os dados do formulário para a AdmsnewUser
                $createItemMenu = new \App\adms\Models\AdmsAddItemMenu();
                $createItemMenu->create($this->dataForm);

                //Recebe os dados que vêm da AdmsLogin
                if($createItemMenu->getResult()){
                    $urlRedirect = URLADM . "list-item-menu/index";
                    header("Location: $urlRedirect");
                }else{
                    // Mantém os dados no formulário se não for redirecinado
                    $this->data['form'] = $this->dataForm;
                    $this->viewAddAccessLevels();
                }
            }else{
                //Carrega a view
                $this->viewAddAccessLevels();
            }
        }
        private function viewAddAccessLevels() :void
        {
        
            $button = [
                'list_item_menu' => ['menu_controller' => 'list-item-menu', 'menu_metodo' => 'index']];
    
                $listButton = new \App\adms\Models\helper\AdmsButton();
                $this->data['button'] = $listButton->buttonPermission($button);
                // var_dump($this->data['button']); 

                $countUsers = new \App\adms\Models\helper\AdmsMenu();
                $this->data['menu'] = $countUsers->itemMenu();
    
                $this->data['sidebarActive'] = "list-item-menu";
    
    
            $loadView = new \Core\ConfigView("adms/Views/itemMenu/addItemMenu", $this->data);
            $loadView->loadView();
            
        }
    }


?>