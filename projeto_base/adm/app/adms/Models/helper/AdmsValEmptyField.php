<?php 

    namespace App\adms\Models\helper;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    

    class AdmsValEmptyField
    {
        private array|null $data;
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