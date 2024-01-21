<?php 

    namespace App\adms\Models;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    

    class AdmsLogin
    {
        private array|null $data;
        /** @var $resultBD Recebe o valor retornado do banco de dados*/
        private $resultBd;
        /** @var  $result Recebe true quando o processo for executado com sucesso e false quando ouver erro*/
        private $result;

        function getResult(){
            return $this->result;
        }

        public function login(array $data = null)
        {
            $this->data = $data;
            // var_dump($this->data);

            $viewUser = new \App\adms\Models\helper\AdmsRead();

            //Retorna somente as colunas indicadas
            $viewUser->fullRead("SELECT usr.id, usr.name, usr.nickname, usr.email, usr.password, usr.image, usr.adms_sits_user_id, usr.adms_access_level_id, acl.order_level
            FROM adms_users AS usr
            INNER JOIN adms_access_levels AS acl ON acl.id=usr.adms_access_level_id
            WHERE usr.user = :user OR usr.email = :email 
            LIMIT :limit", 
            "user={$this->data['user']}&email={$this->data['user']}&limit=1");
            // var_dump($viewUser);


            $this->resultBd = $viewUser->getResult();
            if($this->resultBd){
                $this->valEmailPerm();
                $this->permissPages();

            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuario e/ou Senha incoretos!</p>";
                $this->result = false;
            }
        }

        private function valEmailPerm(): void
        {
            if($this->resultBd[0]['adms_sits_user_id'] == 1){
                $this->valPassword();
            }elseif($this->resultBd[0]['adms_sits_user_id'] == 3){
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Necessário confirmar o e-mail! <a href='".URLADM." new-conf-email/index'>Clique aqui </a>para receber um novo link!</p>";
                $this->result = false;
            }elseif($this->resultBd[0]['adms_sits_user_id'] == 5){
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: E-mail descadastrado entre em contato com a empresa!</p>";
                $this->result = false;
            }elseif($this->resultBd[0]['adms_sits_user_id'] == 2){
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: E-mail inativo entre em contato com a empresa!</p>";
                $this->result = false;
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: E-mail inativo entre em contato com a empresa A!</p>";
                $this->result = false;
            }
        }

        private function valPassword()
        {
            if(password_verify($this->data['password'], $this->resultBd[0]['password'])){
                $_SESSION['user_id'] = $this->resultBd[0]['id'];
                $_SESSION['user_name'] = $this->resultBd[0]['name'];
                $_SESSION['user_nickname'] = $this->resultBd[0]['nickname'];
                $_SESSION['user_email'] = $this->resultBd[0]['email'];
                $_SESSION['user_image'] = $this->resultBd[0]['image'];
                $_SESSION['adms_access_level_id'] = $this->resultBd[0]['adms_access_level_id'];
                $_SESSION['order_level'] = $this->resultBd[0]['order_level'];
                
                $this->result = true;
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuario e/ou Senha incoretos!</p>";
                $this->result = false;
            }

            
        }

        private function permissPages(){
            
            $viewPermission = new \App\adms\Models\helper\AdmsRead();
            $viewPermission->fullRead("SELECT pgs.name_page, pgs.menu_controller
                                    FROM adms_pages AS pgs
                                    INNER JOIN adms_levels_pages AS lev_pgs ON lev_pgs.adms_page_id=pgs.id
                                    INNER JOIN adms_access_levels AS acl ON acl.id=lev_pgs.adms_access_level_id
                                    INNER JOIN adms_users AS usr ON usr.adms_access_level_id=acl.id
                                    INNER JOIN adms_groups_pgs AS grps ON grps.id=pgs.adms_groups_pgs_id
                                    WHERE acl.id=lev_pgs.adms_access_level_id 
                                    AND lev_pgs.permission=1
                                    AND usr.adms_access_level_id=:adms_access_level_id
                                    AND usr.id=:id
                                    AND pgs.adms_groups_pgs_id=:adms_groups_pgs_id
                                    AND pgs.name_page !='Permissões'
                                    ORDER BY lev_pgs.order_level_page ASC",
                                    "adms_access_level_id={$this->resultBd[0]['adms_access_level_id']}&id={$this->resultBd[0]['id']}&adms_groups_pgs_id=1
                                        ");
            if($viewPermission->getResult()){
                $_SESSION['loger'] = $viewPermission->getResult();
            }else{
                $_SESSION['loger'] = [];
            }
            
        }
        
    }

?>