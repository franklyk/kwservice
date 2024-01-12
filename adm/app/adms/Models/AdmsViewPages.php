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
class AdmsViewPages
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

    public function viewPages(int $id): void
    {
        $this->id = $id;

        $viewColor = new \App\adms\Models\helper\AdmsRead();
        $viewColor->fullRead(
            "SELECT pg.id, pg.controller, pg.metodo, pg.menu_controller, pg.menu_metodo, pg.name_page, pg.publish, pg.icon, pg.obs, pg.created, pg.modified,
            sit.name name_sit,
            tpg.type name_type,
            grpg.name name_grpg,
            col.color
            FROM adms_pages AS pg
            INNER JOIN adms_type_pgs AS tpg ON tpg.id=pg.adms_types_pgs_id
            INNER JOIN adms_sits_pgs AS sit ON sit.id=pg.adms_sits_pgs_id
            INNER JOIN adms_groups_pgs AS grpg ON grpg.id=pg.adms_groups_pgs_id
            INNER JOIN adms_color AS col ON col.id=sit.adms_color_id
            WHERE pg.id=:id
            LIMIT :limit",
            "id={$this->id}&limit=1");

/* INNER JOIN adms_color AS col ON col.id=sit.adms_color_id*/
        $this->resultBd = $viewColor->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro 006: Página não encontrada!</p>";
            $this->result = false;
        }
    }
}
