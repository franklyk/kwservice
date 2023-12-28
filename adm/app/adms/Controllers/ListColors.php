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
    class ListColors
    
    {
        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data;

        /** @var string|int|null $page Recebe o número da página que o usuário está */
        private string|int|null $page;
        
        public function index(string|int|null $page = null)
        {
            $this->page = (int) $page ? $page : 1;
            // var_dump($this->page);
            
            $listColors = new \App\adms\Models\AdmsListColors();
            $listColors->listColors($this->page);

            if($listColors->getResult()){

                $this->data['listColors'] = $listColors->getResultBd();
                $this->data['pagination'] = $listColors->getResultPg();
                // var_dump($this->data['pagination']);

            }else{
                $this->data['listColors'] = [];
            }
            // var_dump($this->data);

            $loadView = new \Core\ConfigView("adms/Views/colors/listColors", $this->data);
            $loadView->loadView();
        }
    }


?>