<?php 

    

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    

    /**
     * Página para Listar Grupos de Páginas
     */
    class ListGroupsPages
    
    {
        
        /** @var bool $result*/
        private bool $result;

        /** @var array|string|null $data Recebe os dados que serão enviados para a VIEW */
        private array|string|null $data;

        /** @var string|int|null $page Recebe o número da página que o usuário está */
        private string|int|null $page;
  
        /** @var array $dataform Recebe os dados do Formulário */
        private array|null $dataForm;
        
        function getResult(): bool
        {
            return $this->result;
            var_dump($this->result);
        }
        public function index(string|int|null $page = null)
        {

            $this->page = (int) $page ? $page : 1;            
            
            $listGroupsPages = new \App\adms\Models\AdmsListGroupsPages();
            $listGroupsPages->listGroupsPages($this->page);

            if($listGroupsPages->getResult()){
    
                $this->data['listGroupsPages'] = $listGroupsPages->getResultBd();
                $this->data['pagination'] = $listGroupsPages->getResultPg();
                
            }else{
                $this->data['listGroupsPages'] = [];
            }
            $this->data['pag'] = $this->page;
            $this->data['sidebarActive'] = "list-groups-pages"; 

            $this->data['sidebarButton'] = "list-groups-pages"; 

            $loadView = new \Core\ConfigView("adms/Views/groupsPages/listGroupsPages", $this->data);
            $loadView->loadView();
        }
    }


?>