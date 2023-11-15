<?php 

    namespace App\adms\Models;

    use App\adms\Models\helper\AdmsConn;
    use PDO;

    class AdmsLogin extends AdmsConn
    {
        private array|null $data;
        private object $conn;
        /** @var $resultadoBD Recebe o valor retornado do banco de dados*/
        private $resultBD;
        private $result;

        function getResult(){
            return $this->result;
        }

        public function login(array $data = null)
        {
            $this->data = $data;
            // var_dump($this->data);

            //iNSTANCIAR O MÉTOOD QUANDO A CLASSE É ABSTRATA. A CLASSE ADMSLOGIN É FILHA DA CLASSE ADMSCONN.
            
            $this->conn = $this->connectDB();


            $query_val_login = "SELECT id, name, nickname, email, password, image FROM adms_users WHERE user=:user LIMIT 1";
            $result_val_login = $this->conn->prepare($query_val_login);
            $result_val_login->bindParam(':user', $this->data['user'], PDO::PARAM_STR);
            $result_val_login->execute();

            $this->resultBD = $result_val_login->fetch();
            if($this->resultBD){
                // var_dump($this->resultBD);
                $this->valPassword();
            }else{
                // $_SESSION['msg'] = "<p style= 'color: #f00;'>Erro: Usuário não encontrado!</p>";
                $_SESSION['msg'] = "<p style= 'color: #f00;'>Erro: Usuario e/ou Senha incoretos!</p>";
                $this->result = false;
                // echo $_SESSION['msg'];
            }
        }
        private function valPassword()
        {
            if(password_verify($this->data['password'], $this->resultBD['password'])){
                // $_SESSION['msg'] = "<p style= 'color: #0f0;'>Login realizado com sucesso!</p>";
                $_SESSION['user_id'] = $this->resultBD['id'];
                $_SESSION['user_name'] = $this->resultBD['name'];
                $_SESSION['user_nickname'] = $this->resultBD['nickname'];
                $_SESSION['user_email'] = $this->resultBD['email'];
                $_SESSION['user_image'] = $this->resultBD['image'];
                $this->result = true;
                // echo $_SESSION['msg'];
            }else{
                // $_SESSION['msg'] = "<p style= 'color: #f00;'>Erro: Senha incorreta!</p>";
                $_SESSION['msg'] = "<p style= 'color: #f00;'>Erro: Usuario e/ou Senha incoretos!</p>";
                $this->result = false;
                // echo $_SESSION['msg'];
            }
        }
    }

?>