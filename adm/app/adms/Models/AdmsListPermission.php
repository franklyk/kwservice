<?php

namespace App\adms\Models;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}
/**
 * Listar as permissões do nível de acesso do banco de dados
 *
 * @author Franklin
 */
class AdmsListPermission
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var array|null $resultBdLevel Recebe o registro do banco de dados refernte ao nível de acesso*/
    private array|null $resultBdLevel;

    /** @var int $page Recebe o número página */
    private int $page;

    /** @var int $level Recebe o id do nível de acesso*/
    private int $level;

    /** @var int $page Recebe a quantidade de registros que deve retornar do banco de dados */
    private int $limitResult = 40;

    /** @var string|null $page Recebe a páginação */
    private string|null $resultPg;

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
     * @return bool Retorna os registros do BD
     */
    function getResultBdLevel(): array|null
    {
        return $this->resultBdLevel;
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
    public function listPermission(int $page = null, int $level = null): void
    {
        $this->page = (int) $page ? $page : 1;
        $this->level = (int) $level;

        if($this->viewAccessLevels()){
            $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-permission/index', "?level={$this->level}");
            $pagination->condition($this->page, $this->limitResult);
            $pagination->pagination("SELECT COUNT(id) AS num_result 
                                        FROM adms_levels_pages 
                                        WHERE adms_access_level_id =:adms_access_level_id", 
                                        "adms_access_level_id={$this->level}");
            $this->resultPg = $pagination->getResult();

            $listPermission = new \App\adms\Models\helper\AdmsRead();
            $listPermission->fullRead("SELECT lev_pag.id, lev_pag.permission, lev_pag.order_level_page, lev_pag.adms_access_level_id, lev_pag.adms_page_id, pgs.name_page
                        FROM adms_levels_pages AS lev_pag
                        LEFT JOIN adms_pages AS pgs ON pgs.id=lev_pag.adms_page_id
                        WHERE lev_pag.adms_access_level_id =:adms_access_level_id
                        ORDER BY lev_pag.order_level_page ASC
                        LIMIT :limit OFFSET :offset", "adms_access_level_id={$this->level}&limit={$this->limitResult}&offset={$pagination->getOffset()}");

            $this->resultBd = $listPermission->getResult();
            if ($this->resultBd) {
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Nenhuma permissão encontrada para o nível de acesso !</p>";
                $this->result = false;
            }
        }else{
            // $_SESSION['msg'] = "<p class='alert-danger'>Erro: Nenhuma permissão encontrada para o nível de acesso !</p>";
                $this->result = false;
        }
        
        
    }

    private function viewAccessLevels(): bool
    {

        $viewAccessLevels = new \App\adms\Models\helper\AdmsRead();
        $viewAccessLevels->fullRead(
                            "SELECT name 
                            FROM adms_access_levels
                            WHERE id=:id
                            LIMIT :limit",
            "id={$this->level}&limit=1");

        $this->resultBdLevel = $viewAccessLevels->getResult();
        if ($this->resultBdLevel) {
            return true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro 006: Nível de acesso não encontrado!</p>";
            return false;
        }
    }

}