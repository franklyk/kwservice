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
class AdmsListUsers
{
    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result;

    /** @var array|null $resultBD Recebe os valores retornados do banco de dados*/
    private array|null $resultBd;

    /** @var int $page Recebe o numero da pagina atual*/
    private int $page;

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
     * @return array|null
     */
    function getResultPg(): string|null
    {
        return $this->resultPg;
        
    }

    public function listUsers(int $page = null): void
    {

        $this->page = (int) $page ? $page : 1;
        // var_dump($this->page);

        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-users/index');
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(usr.id) AS num_result FROM adms_users AS usr");
        $this->resultPg = $pagination->getResult();
        // var_dump($this->resultPg);
        $listUsers = new \App\adms\Models\helper\AdmsRead();
        $listUsers->fullRead("SELECT usr.id, usr.name AS name_usr, usr.email, usr.adms_sits_user_id,
                            sit.name AS name_sit, col.color
                            FROM adms_users AS usr
                            INNER JOIN adms_sits_users AS sit ON sit.id=usr.adms_sits_user_id
                            INNER JOIN adms_color AS col ON col.id=sit.adms_color_id
                            ORDER BY usr.id DESC
                            LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listUsers->getResult();

        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style= 'color: #640000;'>Erro: Nenhum usuário encontrado!</p>";
            $this->result = false;
       }

    }
    
}
