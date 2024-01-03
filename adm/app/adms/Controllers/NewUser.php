<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
     * Controller da página cadastrar usuário
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class NewUser
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
            if(!empty($this->dataForm["SendNewUser"])){
                
                //Destroi a posiçao do botao submit
                unset($this->dataForm["SendNewUser"]);

                //Envia os dados do formulário para a AdmsnewUser
                $createNewUser = new \App\adms\Models\AdmsNewUser();
                $createNewUser->create($this->dataForm);
                var_dump($createNewUser);

                //Recebe os dados que vêm da AdmsLogin
                if($createNewUser->getResult()){
                    $urlRedirect = URLADM ;
                    header("Location: $urlRedirect");
                }else{
                    // Mantém os dados no formulário se não for redirecinado
                    $this->data['form'] = $this->dataForm;
                    $this->viewNewUser();
                }
            }else{
                //Carrega a view
                $this->viewNewUser();
            }
        }
        private function viewNewUser() :void
        {
            $loadView = new \Core\ConfigView("adms/Views/login/newUser", $this->data);
            $loadView->loadViewLogin();
            
        }
    }


?>