<?php

namespace App\adms\Models;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}
/**
 * Listar os usuários do banco de dados
 *
 * @author Franklin
 */
class AdmsListAccessLevels
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var int $page Recebe o número página */
    private int $page;

    /** @var int $page Recebe a quantidade de registros que deve retornar do banco de dados */
    private int $limitResult = 40;

    /** @var string|null $page Recebe a páginação */
    private string|null $resultPg;

    /** @var string|null $searchName Recebe o nome do usuario */
    private string|null $searchName;

    /** @var string|null $searchEmail Recebe o email do usuario */
    private string|null $searchEmail;

    /** @var string|null $searchNameValue Recebe o nome do usuario */
    private string|null $searchNameValue;

    /** @var string|null $searchEmailValue Recebe o e-mail do usuario */
    private string|null $searchEmailValue;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /**
     * @return bool Retorna os registros do BD
     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    /**
     * @return bool Retorna a paginação
     */
    function getResultPg(): string|null
    {
        return $this->resultPg;
    }

    /**
     * Metodo faz a pesquisa dos usuários na tabela adms_users e lista as informações na view
     * Recebe o paramentro "page" para que seja feita a paginação do resultado
     * @param integer|null $page
     * @return void
     */
    public function listAccess(int $page = null): void
    {
        $this->page = (int) $page ? $page : 1;

        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-access-levels/index');
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(acs.id) AS num_result FROM adms_access_levels acs");
        $this->resultPg = $pagination->getResult();

        $listAccess = new \App\adms\Models\helper\AdmsRead();
        $listAccess->fullRead("SELECT id, name, order_level
                    FROM adms_access_levels
                    ORDER BY id ASC
                    LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listAccess->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Nenhum acesso encontrado!</p>";
            $this->result = false;
        }
    }

}