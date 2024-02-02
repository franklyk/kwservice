<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
     * Controller da Página de Login
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
            if(!empty($this->dataform['SendLogin'])){
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
            $loadView->loadViewLogin();
        }
    }


?>