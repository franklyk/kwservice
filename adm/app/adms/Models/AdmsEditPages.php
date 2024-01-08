<?php

namespace App\adms\Models;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}


/**
 * Editar usuários no banco de dados
 *
 * @author Franklin
 */
class AdmsEditPages
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /** @var array|null $data Recebe as informações do formulário */
    private array|null $data;

    /** @var array|null $listRegistryEdit Recebe os campos com dados que serão ezibidos no campo select*/
    private array|null $listRegistryEdit;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /**
     * @return bool Retorna os detalhes do registro
     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    public function viewPages(int $id): void
    {
        $this->id = $id;

            $viewPages = new \App\adms\Models\helper\AdmsRead();
            $viewPages->fullRead("SELECT pg.id, pg.controller, pg.metodo, pg.menu_controller, pg.menu_metodo, pg.name_page, pg.publish, pg.icon, pg.obs, pg.adms_sits_pgs_id, pg.adms_types_pgs_id, pg.adms_groups_pgs_id,
            tpg.type type_tpg, tpg.name name_tpg,
            sit.name name_sit, grpg.name name_grpg
            FROM adms_pages AS pg
            LEFT JOIN adms_type_pgs AS tpg ON tpg.id=pg.adms_types_pgs_id
            LEFT JOIN adms_sits_pgs AS sit ON sit.id=pg.adms_sits_pgs_id
            LEFT JOIN adms_groups_pgs AS grpg ON grpg.id=pg.adms_groups_pgs_id
            WHERE pg.id=:id
            LIMIT :limit", "id={$this->id}&limit=1");       

            $this->resultBd = $viewPages->getResult();
            if ($this->resultBd) {
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Página não encontrada!</p>";
                $this->result = false;
            }
    }

    public function update(array $data = null): void
    {
        $this->data = $data;

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        if ($valEmptyField->getResult()) {
            $this->edit();
        } else {
            $this->result = false;
        }
    }

    private function edit(): void
    {
        $this->data['modified'] = date("Y-m-d H:i:s");
        

        $upColor = new \App\adms\Models\helper\AdmsUpdate();
        $upColor->exeUpdate("adms_color", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if ($upColor->getResult()) {
            $_SESSION['msg'] = "<p class='alert-success'>Página editada com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Página não editada com sucesso!</p>";
            $this->result = false;
        }
    }

    public function listSelect(): array
    {
        $list = new \App\adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id id_sit, name name_sit FROM adms_sits_pgs ORDER BY name ASC");
        $registry['sit_page'] = $list->getResult();

        $list->fullRead("SELECT id id_type, type, name name_type FROM adms_type_pgs ORDER BY name ASC");
        $registry['type_page'] = $list->getResult();

        $list->fullRead("SELECT id id_group, name name_group FROM adms_groups_pgs ORDER BY name ASC");
        $registry['group_page'] = $list->getResult();

        $this->listRegistryEdit = ['sit_page' => $registry['sit_page'], 'type_page' => $registry['type_page'], 'group_page' => $registry['group_page']];

        return $this->listRegistryEdit;
        

    }

}