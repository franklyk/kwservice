<?php 

    namespace App\adms\Models;

    use App\adms\Models\helper\AdmsConn;
    use PDO;

    /**
     * Pagina para cadastrar novo usuario
     */
    class AdmsNewUser extends AdmsConn
    {
        /** @var array|null $data Recebe os dados inseridos*/
        private array|null $data;
        /** @var array|null $conn Cria a conexao com o banco de dados */
        private object $conn;
        /** @var $resultadoBD Recebe o valor retornado do banco de dados*/
        private $resultBD;
        /** @var array|null $result Recebe o valor da operaçao*/
        private $result;

        function getResult(){
            return $this->result;
        }

        public function create(array $data = null)
        {
            $this->data = $data;
            // var_dump($this->data);

            $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
            $valEmptyField->valField($this->data);
            if($valEmptyField->getResult()){
                //iNSTANCIAR O MÉTOOD QUANDO A CLASSE É ABSTRATA. A CLASSE ADMSLOGIN É FILHA DA CLASSE ADMSCONN.
                $this->valInput();
               
            }else{
                $this->result = false;  
            }
        }

        private function valInput(): void
        {
            $valEmail = new \App\adms\Models\helper\AdmsValEmail();
            $valEmail->validateEmail($this->data['email']);

            $valEmailSingle = new \App\adms\Models\helper\AdmsValEmailSingle();
            $valEmailSingle->validateEmailSingle($this->data['email']);

            if($valEmail->getResult() and ($valEmailSingle->getResult())){
                $this->add();
            }else{
                $this->result = false;
            }
        }
        private function add(): void
        {
            $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);

            $this->data['user'] = $this->data['email'];
            $this->data['created'] = date("Y-m-d H:i:s");

            // var_dump($this->data);
            //Instancia a classe AdmsCreate
            $createUser = new \App\adms\Models\helper\AdmsCreate();
            $createUser->exeCreate("adms_users", $this->data);
            //Verifica se os dados foram inseridos e emite uma mensagem
            if($createUser->getResult()){
                $_SESSION['msg'] = "<p style= 'color:#0f0;'>Usuário cadastrado com sucesso!</p>";
                $this->result = true;
            }else{
                $_SESSION['msg'] = "<p style= 'color:#f00;'>Usuário não cadastrado com sucesso!</p>";
                $this->result = false;  
            }
        }
    }
?>