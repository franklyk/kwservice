<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
    * Controller da página de sair
    * 
    * @author Franklin (" KLYK ") <frsbatist@gmail.com>
    *
    * @return void
    */

    class Logout
    {

        /**
         * Destruir as sessões do usuario logado
         *
         * @return void
         */
        public function index():void
        {
            unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_nickname'], $_SESSION['user_email'], $_SESSION['user_image']);

            $_SESSION['msg'] = "<p style='color:#0f0;'>Logout realizado com sucesso!</p><br>";

            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }


?>