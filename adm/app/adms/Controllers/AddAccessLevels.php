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
    class AddAccessLevels
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
            if(!empty($this->dataForm["SendAddAccessLevels"])){
                //Destroi a posiçao do botao submit
                unset($this->dataForm["SendAddAccessLevels"]);
                //Envia os dados do formulário para a AdmsnewUser
                $createAccessLevels = new \App\adms\Models\AdmsAddAccessLevels();
                $createAccessLevels->create($this->dataForm);

                //Recebe os dados que vêm da AdmsLogin
                if($createAccessLevels->getResult()){
                    $urlRedirect = URLADM . "list-access-levels/index";
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
                'list_access_levels' => ['menu_controller' => 'list-access-levels', 'menu_metodo' => 'index']];
    
                $listButton = new \App\adms\Models\helper\AdmsButton();
                $this->data['button'] = $listButton->buttonPermission($button);
    
                $this->data['sidebarActive'] = "list-access-levels";
    
    
            $loadView = new \Core\ConfigView("adms/Views/accessLevels/addAccessLevels", $this->data);
            $loadView->loadView();
            
        }
    }


?>