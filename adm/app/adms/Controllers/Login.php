<?php 

    namespace App\adms\Controllers;
    /**
     * Controller da página de Login
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class Login
    {
        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data = [];
  
        /** @var array $dataform Recebe os dados do Formulário */
        private array|null $dataform;

        /**
        * Instanciar a classe responsável em carregar a View e enviar os dados para a View
        *
        * @return void
        */
        public function index(): void
        {
            //Recebe os dados que vêm do formulário
            $this->dataform = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            //verifica se o butão submit foi clicado
            if(!empty($this->dataform['SandLogin'])){
                // var_dump($this->dataform);
                $valLogin = new \App\adms\Models\AdmsLogin();
                $valLogin->login($this->dataform);

                //Recebe os dados que vêm da AdmsLogin
                if($valLogin->getResult()){
                    $urlRedirect = URLADM . "dashboard/index";
                    header("Location: $urlRedirect");
                }else{
                    $this->data['form'] = $this->dataform;
                }

            }

            // $this->data = null;

            $loadView = new \Core\ConfigView("adms/Views/login/login", $this->data);
            $loadView->loadView();
        }
    }


?>