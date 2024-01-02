<?php 

    

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    

    /**
     * Página para listar usuários
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

            $this->data['sidebarActive'] = 'list-conf-emails';

            // var_dump($this->data);

            $loadView = new \Core\ConfigView("adms/Views/confEmails/listConfEmails", $this->data);
            $loadView->loadView();
        }
    }
?>