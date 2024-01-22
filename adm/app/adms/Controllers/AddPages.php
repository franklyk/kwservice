<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
     * Controller da página cadastrar páginas
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class AddPages
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
            if(!empty($this->dataForm["SendAddPages"])){
                // var_dump($this->dataForm);
                //Destroi a posiçao do botao submit
                unset($this->dataForm["SendAddPages"]);
                var_dump($this->dataForm);


                //Envia os dados do formulário para a AdmsnewUser
                $createColor = new \App\adms\Models\AdmsAddPages();
                $createColor->create($this->dataForm);

                //Recebe os dados que vêm da AdmsLogin
                if($createColor->getResult()){
                    $urlRedirect = URLADM . "list-pages/index";
                    header("Location: $urlRedirect");
                }else{
                    // Mantém os dados no formulário se não for redirecinado
                    $this->data['form'] = $this->dataForm;
                    $this->viewAddPages();
                }
            }else{
                //Carrega a view
                $this->viewAddPages();
            }
        }
        private function viewAddPages() :void
        {
        
            $button = [
                'list_pages' => ['menu_controller' => 'list-pages', 'menu_metodo' => 'index']];
    
                $listButton = new \App\adms\Models\helper\AdmsButton();
                $this->data['button'] = $listButton->buttonPermission($button);
    
                $this->data['sidebarActive'] = "list-pages";
    
    
            $listSelect = new \App\adms\Models\AdmsAddPages();
            $this->data['select'] = $listSelect->listSelect();
            
            $loadView = new \Core\ConfigView("adms/Views/pages/addPages", $this->data);
            $loadView->loadView();
            
        }
    }


?>