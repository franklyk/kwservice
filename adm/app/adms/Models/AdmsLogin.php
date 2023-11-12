<?php 

    namespace App\adms\Models;

use App\adms\Models\helper\AdmsConn;

    class AdmsLogin extends AdmsConn
    {
        private array|null $data;

        public function login(array $data = null)
        {
            $this->data = $data;
            var_dump($this->data);

            //iNSTANCIAR A CLASSE QUANDO É PUBLICA 

            // $connect = new \App\adms\Models\helper\AdmsConn();
            // $conn = $connect->connectDB();
            // var_dump($conn);

            //iNSTANCIAR O MÉTOOD QUANDO A CLASSE É ABSTRATA. A CLASSE ADMSLOGIN É FILHA DA CLASSE ADMSCONN.
            
            $conn = $this->connectDB();
            var_dump($conn);
        }
    }

?>