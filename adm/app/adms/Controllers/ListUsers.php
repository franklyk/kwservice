<?php 

    

    namespace App\adms\Controllers;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    

    /**
     * Página para Listar Usuários
     */
    class ListUsers
    
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

            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            
            

            if(!empty($this->dataForm['SendSearchUser'])){
                $listSearchUsers = new \App\adms\Models\AdmsListUsers();
                $listSearchUsers->listSearchUsers($this->page, $this->dataForm['search_name'], $this->dataForm['search_email']);
                
                if($listSearchUsers->getResult()){

                    $this->data['listUsers'] = $listSearchUsers->getResultBd();
                    $this->data['pagination'] = $listSearchUsers->getResultPg();
                }else{
                    $this->data['listUsers'] = [];

                    $this->data['pagination'] = "";
                }
            }else{
                $listUsers = new \App\adms\Models\AdmsListUsers();
                $listUsers->listUsers($this->page);

    
                if($listUsers->getResult()){
    
                    $this->data['listUsers'] = $listUsers->getResultBd();
                    $this->data['pagination'] = $listUsers->getResultPg();
    
                }else{
                    $this->data['listUsers'] = [];
                    $this->data['pagination'] = "";

                }
            }

            $button = [
            'add_users' => ['menu_controller' => 'add-users', 'menu_metodo' => 'index'],
            'view_users' => ['menu_controller' => 'view-users', 'menu_metodo' => 'index'],
            'edit_users' => ['menu_controller' => 'edit-users', 'menu_metodo' => 'index'],
            'delete_users' => ['menu_controller' => 'delete-users', 'menu_metodo' => 'index']];

            $listButton = new \App\adms\Models\helper\AdmsButton();
            $this->data['button'] = $listButton->buttonPermission($button);

            $this->data['sidebarActive'] = "list-users"; 

            // $this->data['sidebarButton'] = "list-users";

            $loadView = new \Core\ConfigView("adms/Views/users/listUsers", $this->data);
            $loadView->loadView();
        }
    }


?>