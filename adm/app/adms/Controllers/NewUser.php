<?php 

    namespace App\adms\Controllers;
    /**
     * Cadastrar Novo usuario
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class NewUser
    {
        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data = [];
  
        /** @var array $dataform Recebe os dados do Formulário */
        private array|null $formData;

        /**
        * Instanciar a classe responsável em carregar a View e enviar os dados para a View
        *
        * @return void
        */
        public function index(): void
        {
            //Recebe os dados que vêm do formulário
            $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);


            //verifica se o butão submit foi clicado
            if(!empty($this->formData["SandNewUser"])){
                // var_dump($this->formData);
                $createNewUser = new \App\adms\Models\AdmsNewUser();
                $createNewUser->create($this->formData);

                //Recebe os dados que vêm da AdmsLogin
                if($createNewUser->getResult()){
                    $urlRedirect = URLADM ;
                    header("Location: $urlRedirect");
                }else{
                    // Mantém os dados no formulário se não for redirecinado
                    $this->data['form'] = $this->formData;
                    $this->viewNewUser();
                }
            }else{
                //Carrega a view
                $this->viewNewUser();
            }


            // $this->data = null;

        }
        private function viewNewUser() :void
        {
            $loadView = new \Core\ConfigView("adms/Views/login/newUser", $this->data);
            $loadView->loadView();
            
        }
    }


?>