<?php 

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    /**
     * Controller da página Menu
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    class EditPrintMenu
    {

        /** @var array|string|null $id Recebe o id do registro */
        private int|string|null $id;

        /** @var array|string|null $level Recebe o nivel de acesso */
        private int|string|null $level;

        /** @var array|string|null $page Recebe a pagina atual */
        private int|string|null $pag;

        /**
        * Instanciar a classe responsável em carregar a View e enviar os dados para a View
        *
        * @return void
        */
        public function index(int|string|null $id = null): void
        {
            $this->id = $id;

            $this->level = filter_input(INPUT_GET, "level", FILTER_SANITIZE_NUMBER_INT);

            $this->pag = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);

            if((!empty($this->id)) and (!empty($this->level)) and (!empty($this->pag))){
                $editPermission = new \App\adms\Models\AdmsEditPrintMenu();
                $editPermission->editPrintMenu($this->id);

                $urlRedirect = URLADM . "list-permission/index/{$this->pag}?level={$this->level}";
                header("Location: $urlRedirect");
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Necessário selecionar o ítem de menu para liberar a permissão!</p><br>";
                
                $urlRedirect = URLADM . "list-permission-levels/index";
                header("Location: $urlRedirect");
            }
        }
    }


?>