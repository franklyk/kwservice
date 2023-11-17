<?php 

    namespace App\adms\Models\helper;

use PDOException;
    /**
     * Create genérico para insersao no banco de dados
     */
    class AdmsCreate extends AdmsConn
    {
        /** @var string  $table Recebe o nome da taela que vai receber os dados inseridos*/
        private string $table;
        /** @var array $data Recebe os daos a seme inseridos na tabela */
        private array $data;
        /** @var string  $result Recebe o resultado da operaçao*/
        private string|null $result;
        /** @var object $insert Recebe a query para inserir os dados*/
        private object $insert;
        /** @var string $query Recebe a query para inserir os dados*/
        private string $query;
        /** @var object $conn Recebe a conexao com o banco de dados*/
        private object $conn;

        /**
         * Metodo para receber o resultado da operacao
         *
         * @return string
         */
        function getResult(): string
        {
            return $this->result;
        }
        /**
         * Insere os dados na tabela
         *
         * @param string $table
         * @param array $data
         * @return void
         */
        public function exeCreate(string $table, array $data):void
        {
            $this->table = $table;
            $this->data = $data;
            // var_dump($this->table);
            // var_dump($this->data);
            $this->exeReplaceValues();
        }
        /**
         * Formata os dados a serem inseridos na tabela
         * Formata a query para inserir os dados
         *
         * @return void
         */
        private function exeReplaceValues():void
        {
            $coluns = implode(', ', array_keys($this->data));
            // var_dump($coluns);
            $values = ':' . implode(', :', array_keys($this->data));
            // var_dump($values);

            $this->query = "INSERT INTO {$this->table} ($coluns) VALUES ($values)";
            // var_dump($this->query);
            $this->exeInstruction();

        }
        /**
         * Executa a instrucao de insersao dos dados
         *
         * @return void
         */
        private function exeInstruction():void
        {
            $this->connection();
            try{
                $this->insert->execute($this->data);
                //Verifica o ultimo ID que foi inserido na tabela
                $this->result = $this->conn->lastInsertId();
            }catch(PDOException $err){
                $this->result =null;
            }
        }
        /**
         * Esecuta a conexao com o banco de dados
         *
         * @return void
         */
        private function connection():void
        {
            $this->conn = $this->connectDB();
            
            $this->insert = $this->conn->prepare($this->query);

        }
    }

?>