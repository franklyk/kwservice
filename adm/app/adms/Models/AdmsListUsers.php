<?php

namespace App\adms\Models;

/**
 * Listar os usuários do banco de dados
 *
 * @author Franklin
 */
class AdmsListUsers
{
    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result;

    /** @var array|null $resultBD Recebe os valores retornados do banco de dados*/
    private array|null $resultBd;
   
    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }
    
    /**
     * Retorna os registros vindos do banco de dados
     *
     * @return array|null
     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    public function listUsers(): void
    {
        $listUsers = new \App\adms\Models\helper\AdmsRead();
        $listUsers->fullRead("SELECT id, name, email FROM adms_users ORDER BY id DESC");

        $this->resultBd = $listUsers->getResult();

        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style= 'color: #f00;'>Erro: Nenhum usuário encontrado!</p>";
            $this->result = false;
       }

    }
    
}
