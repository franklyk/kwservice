<?php 

    namespace App\adms\Models\helper;

    class AdmsCreate extends AdmsConn
    {
        private string $table;
        private array $data;
        private string $result;
        private object $insert;
        private string $query;
        private object $conn;

        function getResult(): string
        {
            return $this->result;
        }
        public function exeCreate(string $table, array $data):void
        {
            $this->table = $table;
            $this->data = $data;
            //var_dump($this->table);
            //var_dump($this->data);
        }
    }

?>