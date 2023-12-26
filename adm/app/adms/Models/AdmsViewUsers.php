<?php

namespace App\adms\Models;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}


/**
 * Visualizar o usuário no banco de dados
 *
 * @author Franklin
 */
class AdmsViewUsers
{
    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBD Recebe o valor retornado do banco de dados*/
    private array|null $resultBd;

    /** @var array|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /**
     * Undocumented function
     *
     * @return array|null
     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    public function viewUser(int $id): void
    {
        $this->id = $id;

        $viewUser = new \App\adms\Models\helper\AdmsRead();
        $viewUser->fullRead("SELECT usr.id, usr.name AS name_user, usr.nickname, usr.email, usr.user, usr.image, usr.created, usr.modified, 
                                                    sit.name AS name_sit,
                                                    col.color
                                                    FROM adms_users AS usr 
                                                    INNER JOIN adms_sits_users AS sit ON sit.id=usr.adms_sits_user_id 
                                                    INNER JOIN adms_color AS col ON col.id=sit.adms_color_id 
                                                    WHERE usr.id=:id 
                                                    LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewUser->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style= 'color: #640000;'>Erro 006: Usuário não encontrado!</p>";
            $this->result = false;
        }
    }
}
