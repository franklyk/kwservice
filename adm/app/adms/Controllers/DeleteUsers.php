<?php 

    namespace App\adms\Controllers;
    /**
     * Controller da página apagar usuário
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class DeleteUsers
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
                $deleteUser = new \App\adms\Models\AdmsDeleteUsers();
                $deleteUser->deleteUser($this->id);
                
            } else {
                $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Necessário selecionar um usuário!</p><br>";
            }
        }
       
    }


?>