<?php

namespace App\adms\Models\helper;

use PDO;
use PDOException;

/**
 * Classe gernérica para apgar registro no banco de dados
 *
 * @author FRANKLIN <frsbatist@gmail.com>
 */
class AdmsDelete extends AdmsConn
{
    private string $table;

    private string|null $terms;

    private array $value = [];

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private string|null|bool $result;

    private object $delete;

    private string $query;

    private object $conn;

    function getResult(): string|null|bool
    {
        return $this->result;
    }

    public function exeDelete(string $table, string|null $terms = null, string|null $parseString = null): void
    {
        $this->table = $table;
        $this->terms = $terms;

        parse_str($parseString, $this->value);

        $this->query = "DELETE FROM {$this->table} {$this->terms}";
   
        $this->exeInstruction();
    }

    private function exeInstruction(): void
    {
        $this->connection();
        try {
            $this->delete->execute($this->value);
            $this->result = true;
        } catch (PDOException $err) {
            $this->result = false;
        }
    }

    /**
     * Esecuta a conexao com o banco de dados
     *
     * @return void
     */
    private function connection(): void
    {
        $this->conn = $this->connectDB();

        $this->delete = $this->conn->prepare($this->query);
    }
}
