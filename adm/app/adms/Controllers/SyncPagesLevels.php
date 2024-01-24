<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
    * Controller da pagina de syncPagesLevels
    * 
    * @author Franklin (" KLYK ") <frsbatist@gmail.com>
    *
    * @return void
    */

    class SyncPagesLevels
    {
        /**Metodo SyncPagesLevels
         * 
         * Instanciar a classe responsavel por sincronizar o nível de acesso e a página
         **
         * @return void
         */
        public function index():void
        {
            
            $syncPagesLevels = new \App\adms\Models\AdmsSyncPagesLevels();
            $syncPagesLevels->syncPagesLevels();
            
            $urlRedirect = URLADM . "list-access-levels/index";
            header("Location: $urlRedirect");

        }
    }


?>
