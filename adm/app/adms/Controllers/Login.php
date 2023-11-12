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
            $this->dataform = filter_input_array(INPUT_POST, FILTER_DEFAULT);


            if(!empty($this->dataform['SandLogin'])){
                $valLogin = new \App\adms\Models\AdmsLogin();
                $valLogin->login($this->dataform);
                $this->data['form'] = $this->dataform;

            }


            // $this->data = null;

         $loadView = new \Core\ConfigView("adms/Views/login/login", $this->data);
         $loadView->loadView();
        }
    }


?>