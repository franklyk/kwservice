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
class AdmsViewLevelsForms
{
    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBD Recebe o valor retornado do banco de dados*/
    private array|null $resultBd;

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

    public function viewLevelsForm(): void
    {

        $viewLevelsForm = new \App\adms\Models\helper\AdmsRead();
        $viewLevelsForm->fullRead(
                            "SELECT lev_frm.id,
                            acl.name name_access,
                            sit.name name_sit,
                            lev_frm.created, lev_frm.modified,
                            col.color
                            FROM adms_levels_forms AS lev_frm
                            INNER JOIN adms_access_levels AS acl ON acl.id=lev_frm.adms_access_level_id
                            INNER JOIN adms_sits_users AS sit ON sit.id=lev_frm.adms_sits_user_id
                            INNER JOIN adms_color AS col ON col.id=sit.adms_color_id
                            LIMIT :limit",
            "limit=1");

        $this->resultBd = $viewLevelsForm->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro 006: Nível de acesso não encontrado!</p>";
            $this->result = false;
        }
    }
}
