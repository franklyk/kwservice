<?php 

    namespace App\adms\Models\helper;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    

    class AdmsValUserSingleLogin
    {
        private string $user;
        private bool|null $edit;
        private int|null $id;
        private bool $result;
        private array|null $resultBD;

        function getResult(): bool
        {
            return $this->result;
        }
        public function validateUserSingleLogin(string $user, bool|null $edit = null, int|null $id = null): void
        {
            $this->user = $user;
            $this->edit = $edit;
            $this->id = $id;

            $valUserSingle = new \App\adms\Models\helper\AdmsRead();
            if(($this->edit == true) and (!empty($id))){
                $valUserSingle->fullRead("SELECT id FROM adms_users WHERE user =:user id <>:id LIMIT :limit", "email={$this->user}&id={$this->id}&limit=1");
            }else{
                $valUserSingle->fullRead("SELECT id FROM adms_users WHERE user =:email LIMIT :limit", "email={$this->user}&limit=1");
            }
            $this->resultBD = $valUserSingle->getResult();
            if(!$this->resultBD){
                $this->result = true;
            }else{
                $_SESSION['msg'] = "<p style= 'color:#f00;'>Erro: Este email já esta cadastrado!</p>";
                $this->result = false; 
            }
        }
    }

?>