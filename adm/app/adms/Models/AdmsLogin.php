<?php 

    namespace App\adms\Models;

    class AdmsLogin
    {
        private array|null $data;
        /** @var $resultBD Recebe o valor retornado do banco de dados*/
        private $resultBD;
        private $result;

        function getResult(){
            return $this->result;
        }

        public function login(array $data = null)
        {
            $this->data = $data;
            // var_dump($this->data);


            $viewUser = new \App\adms\Models\helper\AdmsRead();
            //Retorna todas as colunas 
            // $viewUser->exeRead("adms_users", "WHERE user = :user LIMIT :limit", "user={$this->data['user']} & limit=1");

            //Retorna somente as colunas indicadas
            $viewUser->fullRead("SELECT id, name, nickname, email, password, image FROM adms_users WHERE user = :user LIMIT :limit", "user={$this->data['user']}&limit=1");
            var_dump($viewUser);


            $this->resultBD = $viewUser->getResult();
            if($this->resultBD){
                $this->valPassword();
            }else{
                $_SESSION['msg'] = "<p style= 'color: #f00;'>Erro: Usuario e/ou Senha incoretos!</p>";
                $this->result = false;
            }
        }
        private function valPassword()
        {
            if(password_verify($this->data['password'], $this->resultBD[0]['password'])){
                $_SESSION['user_id'] = $this->resultBD[0]['id'];
                $_SESSION['user_name'] = $this->resultBD[0]['name'];
                $_SESSION['user_nickname'] = $this->resultBD[0]['nickname'];
                $_SESSION['user_email'] = $this->resultBD[0]['email'];
                $_SESSION['user_image'] = $this->resultBD[0]['image'];
                $this->result = true;
            }else{
                $_SESSION['msg'] = "<p style= 'color: #f00;'>Erro: Usuario e/ou Senha incoretos!</p>";
                $this->result = false;
            }
        }
    }

?>