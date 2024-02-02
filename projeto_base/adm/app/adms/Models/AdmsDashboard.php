<?php

namespace App\adms\Models;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}


/**
 * Pagina inicial do sistema administrativo "dashboard"
 *
 * @author Franklin
 */
class AdmsDashboard
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /**
     * @return bool Retorna os dados
     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    /**
     * Metodo retornar dados para o dashboard
     * Retorna FALSE se houver algum erro
     * @param integer $id
     * @return void
     */
    public function countUsers(): void
    {
        // var_dump($_SESSION['logado']);

        $countUsers = new \App\adms\Models\helper\AdmsRead();
        $countUsers->fullRead("SELECT COUNT(id) AS qnt_users
                            FROM adms_users");

        $this->resultBd = $countUsers->getResult();        
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Nenhum usuário encontrado!</p>";
            $this->result = false;
        }
    }
}