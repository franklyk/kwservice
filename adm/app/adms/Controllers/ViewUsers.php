<?php 

    

    namespace App\adms\Controllers;


    class ViewUsers
    {
        
        public function index()
        {
            echo "Pagina visualizar usuarios <br>";
            $loadView = new \Core\ConfigView("adms/Views/users/viewUser");
            $loadView->loadView();
        }
    }


?>