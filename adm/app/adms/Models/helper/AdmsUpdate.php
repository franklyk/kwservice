<?php

namespace App\adms\Models\helper;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}


use PDO;
use PDOException;

/**
 * Classe gernérica para editar registro no banco de dados
 *
 * @author FRANKLIN <frsbatist@gmail.com>
 */
class AdmsUpdate extends AdmsConn
{
    private string $table;

    private string|null $terms;

    private array $data;

    private array $value = [];

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private string|null|bool $result;

    private object $update;

    private string $query;

    private object $conn;

    function getResult(): string|null|bool
    {
        return $this->result;
    }

    public function exeUpdate(string $table, array $data, string|null $terms = null, string|null $parseString = null): void
    {
        $this->table = $table;
        $this->data = $data;
        $this->terms = $terms;
        // var_dump($this->table);
        // var_dump($this->data);
        // var_dump($this->terms);
        // var_dump($parseString);

        parse_str($parseString, $this->value);

        // var_dump($this->value);
        $this->exeReplaceValues();
    }

    private function exeReplaceValues(): void
    {
        foreach ($this->data as $key => $value) {
            // var_dump($key);
            $values[] = $key . "=:" . $key;
        }
        // var_dump($values);

        $values = implode(', ', $values);

        // var_dump($values);


        $this->query = "UPDATE {$this->table} SET {$values} {$this->terms}";

        // var_dump($this->query);

        $this->exeInstruction();
    }

    private function exeInstruction(): void
    {
        $this->connection();
        try {
            $this->update->execute(array_merge($this->data, $this->value));
            $this->result = true;
        } catch (PDOException $err) {
            $this->result = null;
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

        $this->update = $this->conn->prepare($this->query);
    }
}
