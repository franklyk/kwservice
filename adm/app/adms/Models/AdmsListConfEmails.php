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
class AdmsListConfEmails
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

    public function listConfEmails($page): void
    {
        $this->page = $page ? $page : 1;

        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-conf-emails/index');
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) AS num_result FROM adms_confs_emails");
        $this->resultPg = $pagination->getResult();

        $listSitsUsers = new \App\adms\Models\helper\AdmsRead();
        $listSitsUsers->fullRead("SELECT id, name, title, email FROM adms_confs_emails ORDER BY id DESC LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listSitsUsers->getResult();
        // var_dump($this->resultBd);
        if($this->resultBd){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert-success'>Erro: Nenhum email encontrado!</p>";
            $this->result = false;
       }

    }
    
}
