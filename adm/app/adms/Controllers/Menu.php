<?php 



    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    

    /**
     * Menu
     */
    class Menu
    
    {

        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private $data;
        private $user;

        
        public function index($data)
        {
            var_dump($_SESSION['logado']);

            $this->data = $data;
            
            $listMenu = new \App\adms\Models\AdmsMenu();
            $listMenu->listMenu($this->data);
            $loadView = new \Core\ConfigView("adms/Views/include/menu", $this->data);
            $loadView->loadView();
            
        }
    }


?>