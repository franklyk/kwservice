<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
    * Controller da pagina de Dashboard
    * 
    * @author Franklin (" KLYK ") <frsbatist@gmail.com>
    *
    * @return void
    */

    class Dashboard
    {
        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data;

        /**
         * Instanciar a classe responsvel em carregar a View e enviar os dados para a View
         *
         * @return void
         */
        public function index():void
        {

            $this->data = " Bem Vindo ";
            $loadView = new \Core\ConfigView("adms/Views/dashboard/dashboard", $this->data);
            $loadView->loadView();
        }
    }


?>