<?php 

    namespace App\adms\Models\helper;

    class AdmsValEmptyField
    {
        private array|null $data;
        private object $conn;
        /** @var $resultadoBD Recebe o valor retornado do banco de dados*/
        private $resultBD;
        private bool $result;

        function getResult(){
            return $this->result;
        }

        public function valField(array $data = null)
        {
            $this->data = $data;
            $this->data = array_map('strip_tags', $this->data);
            $this->data = array_map('trim', $this->data);

            if(in_array('', $this->data)){
                $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Necessário preencher todos os campos</p> <br>";
                return $this->result = false;
            }else{
                return $this->result = true;
            }
        }

    }

?>