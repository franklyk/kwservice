<?php 

    namespace App\adms\Models\helper;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    

    class AdmsValEmailSingle
    {
        private string $email;
        private bool|null $edit;
        private int|null $id;
        private bool $result;
        private array|null $resultBD;

        function getResult(): bool
        {
            return $this->result;
        }
        public function validateEmailSingle(string $email, bool|null $edit = null, int|null $id = null): void
        {
            $this->email = $email;
            $this->edit = $edit;
            $this->id = $id;

            $valEmailSingle = new \App\adms\Models\helper\AdmsRead();
            if(($this->edit == true) and (!empty($id))){
                $valEmailSingle->fullRead("SELECT id FROM adms_users WHERE (email =:email OR user =:user) AND id <>:id LIMIT :limit", "email={$this->email}&user={$this->email}&id={$this->id}&limit=1");
            }else{
                $valEmailSingle->fullRead("SELECT id FROM adms_users WHERE email =:email LIMIT :limit", "email={$this->email}&limit=1");
            }
            $this->resultBD = $valEmailSingle->getResult();
            if(!$this->resultBD){
                $this->result = true;
            }else{
                $_SESSION['msg'] = "<p style= 'color:#f00;'>Erro: Este email já esta cadastrado!</p>";
                $this->result = false; 
            }
        }
    }

?>