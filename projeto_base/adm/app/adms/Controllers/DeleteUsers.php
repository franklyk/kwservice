<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
     * Controller da página apagar usuário
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class DeleteUsers
    {
        
        /** @var array|string|null $id Recebe o id do registro */
        private int|string|null $id;
        
        /** @var array|string|null $deleteId Recebe o id do registro */
        private int|string|null $deleteId;

        /**
        * Instanciar a classe responsável em carregar a View e enviar os dados para a View
        *
        * @return void
        */
        public function index(int|string|null $id = null): void
        {
            

            $this->id = (int) $id;
            var_dump($this->id);
            
            if (!empty($this->id)){
                $deleteUser = new \App\adms\Models\AdmsDeleteUsers();
                $deleteUser->deleteUser($this->id);
                
            } else {
                $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Necessário selecionar um usuário!</p><br>";
            }
        }
       
    }


?>