<?php

namespace App\cpms\Models;

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
class CpmsListUsers
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
    public function listUsers(int $page = null): void
    {


        $this->page = (int) $page ? $page : 1;

        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-users/index');
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(usr.id) AS num_result FROM adms_users usr INNER JOIN adms_access_levels AS acl ON acl.id=usr.adms_access_level_id WHERE acl.order_level >:order_level ", "order_level={$_SESSION['order_level'] }");
        $this->resultPg = $pagination->getResult();

        $listUsers = new \App\adms\Models\helper\AdmsRead();
        $listUsers->fullRead("SELECT usr.id, usr.name AS name_usr, usr.email, usr.adms_sits_user_id,
                    sit.name AS name_sit,
                    col.color, acl.id AS id_level, acl.name AS name_level
                    FROM adms_users AS usr
                    INNER JOIN adms_sits_users AS sit ON sit.id=usr.adms_sits_user_id
                    INNER JOIN adms_color AS col ON col.id=sit.adms_color_id
                    INNER JOIN adms_access_levels AS acl ON acl.id=usr.adms_access_level_id
                    WHERE acl.order_level >:order_level 
                    ORDER BY usr.id DESC
                    LIMIT :limit OFFSET :offset", "order_level={$_SESSION['order_level']}&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listUsers->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Nenhum usuário encontrado!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo faz a pesquisa dos usuários na tabela adms_users e lista as informações na view
     * Recebe o paramentro "page" para que seja feita a paginação do resultado
     * Recebe o paramentro "search_name" para pesquisar o usuario atraves do nome
     * Recebe o paramentro "search_email" para pesquisar o usuario atraves do e-mail
     * @param integer|null $page
     * @param string|null $search_name
     * @param string|null $search_email
     * @return void
     */
    public function listSearchUsers(int $page = null, string|null $search_name, string|null $search_email): void
    {
        $this->page = (int) $page ? $page : 1;
        $this->searchName = trim($search_name);
        $this->searchEmail = trim($search_email);

        $this->searchNameValue = "%" . $this->searchName . "%";
        $this->searchEmailValue = "%" . $this->searchEmail . "%";

        if ((!empty($this->searchName)) and (!empty($this->searchEmail))) {
            $this->searchUserNameEmail();
        } elseif ((!empty($this->searchName)) and (empty($this->searchEmail))) {
            $this->searchUserName();
        } elseif ((empty($this->searchName)) and (!empty($this->searchEmail))) {
            $this->searchUserEmail();
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Consulta inválida!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo pesquisar pelo nome
     * @return void
     */
    public function searchUserName(): void
    {
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-users/index', "?search_name={$this->searchName}&search_email={$this->searchEmail}");
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(usr.id) AS num_result 
                            FROM adms_users usr
                            WHERE name LIKE :search_name", "search_name={$this->searchNameValue}");
        $this->resultPg = $pagination->getResult();

        $listSearchUserName = new \App\adms\Models\helper\AdmsRead();
        $listSearchUserName->fullRead("SELECT usr.id, usr.name AS name_usr, usr.email, usr.adms_sits_user_id,
                    sit.name AS name_sit,
                    col.color, acl.name AS name_level
                    FROM adms_users AS usr
                    INNER JOIN adms_sits_users AS sit ON sit.id=usr.adms_sits_user_id
                    INNER JOIN adms_color AS col ON col.id=sit.adms_color_id
                    INNER JOIN adms_access_levels AS acl ON acl.id=usr.adms_access_level_id
                    WHERE usr.name LIKE :search_name 
                    ORDER BY usr.id DESC
                    LIMIT :limit OFFSET :offset", "search_name={$this->searchNameValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listSearchUserName->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Nenhum usuário encontrado!</p>";
            $this->result = false;
        }
    }/**
     * Metodo pesquisar pelo e-mail
     * @return void
     */
    public function searchUserEmail(): void
    {
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-users/index', "?search_name={$this->searchName}&search_email={$this->searchEmail}");
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(usr.id) AS num_result 
                            FROM adms_users usr
                            WHERE email LIKE :search_email", "search_email={$this->searchEmailValue}");
        $this->resultPg = $pagination->getResult();

        $listShearchEmail = new \App\adms\Models\helper\AdmsRead();
        $listShearchEmail->fullRead("SELECT usr.id, usr.name AS name_usr, usr.email, usr.adms_sits_user_id,
                    sit.name AS name_sit,
                    col.color
                    FROM adms_users AS usr
                    INNER JOIN adms_sits_users AS sit ON sit.id=usr.adms_sits_user_id
                    INNER JOIN adms_color AS col ON col.id=sit.adms_color_id
                    WHERE usr.email LIKE :search_email
                    ORDER BY usr.id DESC
                    LIMIT :limit OFFSET :offset", "search_email={$this->searchEmailValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listShearchEmail->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Nenhum usuário encontrado!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo pesquisar pelo nome e e-mail
     * @return void
     */
    public function searchUserNameEmail(): void
    {
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-users/index', "?search_name={$this->searchName}&search_email={$this->searchEmail}");
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(usr.id) AS num_result 
                            FROM adms_users usr
                            WHERE name LIKE :search_name 
                            OR email LIKE :search_email", "search_name={$this->searchNameValue}&search_email={$this->searchEmailValue}");
        $this->resultPg = $pagination->getResult();

        $listSearchUserNameEmail = new \App\adms\Models\helper\AdmsRead();
        $listSearchUserNameEmail->fullRead("SELECT usr.id, usr.name AS name_usr, usr.email, usr.adms_sits_user_id,
                    sit.name AS name_sit,
                    col.color
                    FROM adms_users AS usr
                    INNER JOIN adms_sits_users AS sit ON sit.id=usr.adms_sits_user_id
                    INNER JOIN adms_color AS col ON col.id=sit.adms_color_id
                    WHERE usr.name LIKE :search_name 
                    OR usr.email LIKE :search_email
                    ORDER BY usr.id DESC
                    LIMIT :limit OFFSET :offset", "search_name={$this->searchNameValue}&search_email={$this->searchEmailValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listSearchUserNameEmail->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Nenhum usuário encontrado!</p>";
            $this->result = false;
        }
    }
}