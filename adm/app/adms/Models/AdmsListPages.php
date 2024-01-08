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
class AdmsListPages
{
    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result;

    /** @var array|null $resultBD Recebe os valores retornados do banco de dados*/
    private array|null $resultBd;

    /** @var int $page Recebe o numero da pagina atual*/
    private $page;

    /** @var int $page Recebe a quantidade de registros que devem retornar do banco de dados*/
    private int $limitResult = 40;

    /** @var string|null $page Recebe a paginação */
    private string|null $resultPg;
   
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
    
    /**
     * Retorna os dados da página atual
     *
     * @return string|null 
     */
    function getResultPg(): string|null 
    {
        return $this->resultPg;
    }

    public function listPages($page): void
    {
        $this->page = $page ? $page : 1;

        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-pages/index');
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(pgs.id) AS num_result FROM adms_pages AS pgs");
        $this->resultPg = $pagination->getResult();

        $listPages = new \App\adms\Models\helper\AdmsRead();
        $listPages->fullRead("SELECT pg.id, pg.name_page,
                        tpg.type type_tpg, tpg.name name_tpg,
                        sit.name name_sit,
                        col.color
                        FROM adms_pages AS pg
                        INNER JOIN adms_type_pgs AS tpg ON tpg.id=pg.adms_types_pgs_id
                        INNER JOIN adms_sits_pgs AS sit ON sit.id=pg.adms_sits_pgs_id
                        INNER JOIN adms_color AS col ON col.id=sit.adms_color_id
                        ORDER BY pg.id DESC
                        LIMIT :limit
                        OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");                          
        $this->resultBd = $listPages->getResult();
        if($this->resultBd){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert-success'>Erro: Nenhum usuário encontrado!</p>";
            $this->result = false;
       }

    }
    
}
