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
class AdmsEditLevelsForms
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /** @var array|null $data Recebe as informações do formulário */
    private array|null $data;

    /** @var array|null $listRegistryAdd Recebe os campos com dados que já foram cadastrados com cores*/
    private array|null $listRegistryAdd;

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

    public function viewLevelsForms(): void
    {

        $viewLevelsForms = new \App\adms\Models\helper\AdmsRead();
        $viewLevelsForms->fullRead(
            "SELECT id, adms_access_level_id, adms_sits_user_id
                            FROM adms_levels_forms
                            ORDER BY id ASC
                            LIMIT :limit",
                            "limit=1"
        );

        $this->resultBd = $viewLevelsForms->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Página de configuração não encontrada!</p>";
            $this->result = false;
        }
    }

    public function update($data = null)
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
        

        $upLevelsForm = new \App\adms\Models\helper\AdmsUpdate();
        $upLevelsForm->exeUpdate("adms_levels_forms", $this->data, "WHERE id=:id", "id={$this->data['id']}");
        var_dump($this->data);

        if ($upLevelsForm->getResult()) {
            $_SESSION['msg'] = "<p class='alert-success'>Configuração editada com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Configuração não editada com sucesso!</p>";
            $this->result = false;
        }
    }

    public function listSelect(): array
    {
        $list = new \App\adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id sit_id, name name_sit
                        FROM adms_sits_users
                        ORDER BY name ASC");
        $registry['sit'] = $list->getResult();

        $list->fullRead("SELECT id lev_id, name name_lev
                        FROM adms_access_levels
                        WHERE order_level >=:order_level 
                        ORDER BY id ASC", "order_level=" . $_SESSION['order_level']
                        );
        $registry['lev'] = $list->getResult();

        $this->listRegistryAdd = ['sit' => $registry['sit'], 'lev' => $registry['lev']];

        return $this->listRegistryAdd;
    }

}