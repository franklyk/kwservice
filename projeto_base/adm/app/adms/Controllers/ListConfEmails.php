<?php 

    

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    

    /**
     * Página para Listar Configurações de E-mail
     */
    class ListConfEmails
    
    {
        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data;

        /** @var string|int|null $page Recebe o número da página que o usuário está */
        private string|int|null $page;
        
        public function index(string|int|null $page = null)
        {
            $this->page = (int) $page ? $page : 1;
            // var_dump($this->page);
            
            $listConfEmails = new \App\adms\Models\AdmsListConfEmails();
            $listConfEmails->listConfEmails($this->page);

            if($listConfEmails->getResult()){

                $this->data['listConfEmails'] = $listConfEmails->getResultBd();
                $this->data['pagination'] = $listConfEmails->getResultPg();
                // var_dump($this->data['pagination']);

            }else{
                $this->data['listConfEmails'] = [];
            }

        
            $button = [
                'add_conf_emails' => ['menu_controller' => 'add-conf-emails', 'menu_metodo' => 'index'],
                'view_conf_emails' => ['menu_controller' => 'view-conf-emails', 'menu_metodo' => 'index'],
                'edit_conf_emails' => ['menu_controller' => 'edit-conf-emails', 'menu_metodo' => 'index'],
                'delete_conf_emails' => ['menu_controller' => 'delete-conf-emails', 'menu_metodo' => 'index']];
    
                $listButton = new \App\adms\Models\helper\AdmsButton();
                $this->data['button'] = $listButton->buttonPermission($button);

                $countUsers = new \App\adms\Models\helper\AdmsMenu();
                $this->data['menu'] = $countUsers->itemMenu();
    
            $this->data['sidebarActive'] = "list-conf-emails";
    
            // var_dump($this->data);

            $loadView = new \Core\ConfigView("adms/Views/confEmails/listConfEmails", $this->data);
            $loadView->loadView();
        }
    }
?>