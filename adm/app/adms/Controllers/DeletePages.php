<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
     * Controller da página apagar páginas
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class DeletePages
    {
        
        /** @var array|string|null $id Recebe o id do registro */
        private int|string|null $id;

        /**
        * Instanciar a classe responsável em carregar a View e enviar os dados para a View
        *
        * @return void
        */
        public function index(int|string|null $id = null): void
        {
            
            if (!empty($id)){
                $this->id = (int) $id;

                $deleteUser = new \App\adms\Models\AdmsDeletePages();
                $deleteUser->deletePages($this->id);
                
            } else {
                $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Necessário selecionar uma cor!</p><br>";
            }
        }
       
    }


?>