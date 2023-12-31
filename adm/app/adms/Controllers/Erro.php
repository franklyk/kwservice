<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
    * Controller da página de Erro
    * 
    * @author Franklin (" KLYK ") <frsbatist@gmail.com>
    *
    * @return void
    */

    class Erro
    {
        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data;

        /**
         * Instanciar a classe responsável em carregar a View e enviar os dados para a View
         *
         * @return void
         */
        public function index():void
        {

            $this->data = "<p style='color:#f00;'>Página não encontrada!</p>";
            $loadView = new \Core\ConfigView("adms/Views/erro/erro", $this->data);
            $loadView->loadViewLogin();
        }
    }


?>